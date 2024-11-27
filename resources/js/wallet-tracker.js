import { Connection, PublicKey } from '@solana/web3.js';
import axios from 'axios';

const SOLANA_RPC_URL = 'https://api.mainnet-beta.solana.com';
const LARAVEL_SAVE_URL = 'http://friday.test/api/wallet_portfolio/save';
const LARAVEL_TOKEN_CREATE_URL = 'http://friday.test/api/tokens/create';

const connection = new Connection(SOLANA_RPC_URL);

const fetchTokenAccounts = async (wallet) => {
    try {
        console.log(`Fetching token accounts for wallet: ${wallet.nickname} (${wallet.address})`);
        const walletPubkey = new PublicKey(wallet.address);
        const tokenAccounts = await connection.getParsedTokenAccountsByOwner(walletPubkey, {
            programId: new PublicKey('TokenkegQfeZyiNwAJbNbGKPFXCWuBvf9Ss623VQ5DA'),
        });

        if (!tokenAccounts.value.length) {
            console.warn(`No token accounts found for wallet: ${wallet.nickname}`);
            return;
        }

        let portfolio = [];

        for (const tokenAccount of tokenAccounts.value) {
            const accountInfo = tokenAccount.account.data.parsed.info;
            const balance = parseFloat(accountInfo.tokenAmount.uiAmountString);

            if (balance > 0) {
                const tokenAddress = tokenAccount.pubkey.toBase58();
                portfolio.push({
                    token_address: tokenAddress,
                    token_balance: balance,
                });
            }
        }

        if (portfolio.length === 0) {
            console.warn(`No tokens with balance > 0 found for wallet: ${wallet.nickname}`);
            return;
        }

        // Sort by balance and take top 10
        portfolio = portfolio.sort((a, b) => b.token_balance - a.token_balance).slice(0, 10);

        for (const holding of portfolio) {
            try {
                const tokenInfo = await axios.get(`http://friday.test/api/tokens/${holding.token_address}`);
                holding.token_name = tokenInfo.data.name || 'Unknown';
                holding.price = tokenInfo.data.price || 0;
                holding.value = holding.token_balance * holding.price;
            } catch (tokenError) {
                console.error(`Error fetching token info for ${holding.token_address}: ${tokenError.message}`);
                holding.token_name = 'Unknown';
                holding.price = 0;
                holding.value = 0;
            }
        }

        // Send portfolio to backend
        const response = await axios.post(LARAVEL_SAVE_URL, { portfolio });
        console.log(`Portfolio snapshot saved for wallet: ${wallet.nickname}`, response.data);
    } catch (error) {
        console.error(`Error fetching token accounts for ${wallet.nickname}:`, error.message);
    }
};

const fetchTrackedWallets = async () => {
    try {
        console.log('Fetching tracked wallets...');
        const response = await axios.get('http://friday.test/api/wallets/tracked');
        console.log(`Found ${response.data.length} tracked wallets.`);
        return response.data;
    } catch (error) {
        console.error('Error fetching tracked wallets:', error.message);
        return [];
    }
};

const monitorWallets = async () => {
    console.log('Starting wallet monitoring...');
    const wallets = await fetchTrackedWallets();
    for (const wallet of wallets) {
        await fetchTokenAccounts(wallet);
    }
};

setInterval(monitorWallets, 50000); // Take snapshots every hour
