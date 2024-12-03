<nav class="navbar navbar-expand-lg bg-none" style="box-shadow: none; background-image: none;">
    <div class="container-fluid text-white">
        <!-- Left Navigation -->
        <ul class="navbar-nav me-auto">
            <div class="btn-group">
                <a href="/" class="btn btn-outline-tertiary fs-6 fw-bold text-white {{ request()->is('/') ? 'active' : '' }}">
                    Play <img src="{{ asset('images/favicon/favicon-32x32.png') }}" height="22px">
                </a>

                <a href="{{ route('leaderboard') }}" class="btn btn-outline-tertiary fs-6 fw-bold text-white {{ request()->is('leaderboard') ? 'active' : '' }}">
                    Leaderboard
                </a>
            </div>
        </ul>

        <!-- Right Icons -->
        <div class="d-flex align-items-center ms-auto list-unstyled">
            <a href="https://twitter.com/heintriss" title="X" class="me-3 text-decoration-none text-white" target="_blank">
                <span class="small">Created by</span> <i class="fa-brands fa-x-twitter fs-5 text-white"></i>
            </a>

            <!-- Phantom Wallet Button -->
            <button id="wallet-button" class="btn btn-outline-primary text-white">
                <img src="{{ asset('images/phantom.png') }}" alt="Phantom Wallet" height="24px" />
                <span id="wallet-button-text">Connect Wallet</span>
            </button>
        </div>

    </div>
</nav>
@push('scripts')
    <script>
        $(document).ready(function () {
            // Check if Phantom Wallet is installed
            const isPhantomInstalled = window.solana && window.solana.isPhantom;
            const walletButton = document.getElementById('wallet-button');
            const walletButtonText = document.getElementById('wallet-button-text');
            const walletStatus = document.getElementById('wallet-status');

            function updateWalletButton() {
                if (window.walletPublicKey) {
                    walletButtonText.textContent = 'Disconnect Wallet';
                } else {
                    walletButtonText.textContent = 'Connect Wallet';
                }
            }

            async function connectWallet() {
                try {
                    // Connect to wallet
                    const resp = await window.solana.connect();
                    window.walletPublicKey = resp.publicKey.toString();
                    $('#wallet-status').text('Connected Wallet: ' + window.walletPublicKey);
                    updateWalletButton();
                } catch (err) {
                    console.error('Wallet connection failed:', err);
                }
            }

            async function disconnectWallet() {
                try {
                    await window.solana.disconnect();
                    window.walletPublicKey = null;
                    $('#wallet-status').text('');
                    updateWalletButton();
                } catch (err) {
                    console.error('Wallet disconnection failed:', err);
                }
            }

            if (isPhantomInstalled) {
                // Update the button on page load
                updateWalletButton();

                // Handle wallet button click
                walletButton.addEventListener('click', async () => {
                    if (walletPublicKey) {
                        // Disconnect wallet
                        await disconnectWallet();
                    } else {
                        // Connect wallet
                        await connectWallet();
                    }
                });
            } else {
                // Phantom is not installed
                walletButtonText.textContent = 'Install Phantom';
                walletButton.onclick = () => {
                    window.open('https://phantom.app/', '_blank');
                };
            }
        });
    </script>
@endpush

