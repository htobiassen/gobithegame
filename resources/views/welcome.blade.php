@extends('layouts.web')
@section('head')
@endsection
@section('content')
    @include('web.partials.navbar')
    <div class="container p-0 p-md-2 pb-3 mb-5">
        <!-- Start Screen Overlay -->
        <div class="card card-body mt-1 mt-md-3 bg-tertiary p-1 p-md-3">

            <div class="row">
                <!-- Map Section -->
                <div class="col-md-12 position-relative">
                    <div class="map-section rounded border border-1 border-primary">
                        <!-- Score Display -->
                        <div class="score-display bg-primary p-1 rounded">
                            🏆 Score: <span id="score-count">0</span>
                        </div>

                        <!-- Start Screen Overlay -->
                        <div id="start-screen" class="overlay">
                            <div class="overlay-content">
                                <h2 id="game-over-message">Welcome to the Game!</h2>
                                <div class="mb-3">
                                    <button id="start-game-free" class="btn btn-tertiary btn-lg me-2">Play Free</button>
                                    <button id="start-game-paid" class="btn btn-primary btn-sm" disabled>
                                        Compete for $GOBI
                                        <span class="small d-block">Coming soon!</span>
                                    </button>
                                </div>
                                <div id="wallet-status" class="mb-3"></div>
                            </div>
                        </div>

                        <!-- Game Elements -->
                        <div id="forest" class="map-item forest"></div>
                        <div id="mine" class="map-item mine"></div>
                        <div id="rocket" class="map-item rocket"><img class="img-rocket" src="../../images/game_assets/rocket.webp"></div>
                        <!-- Goblins will be dynamically added here -->

                        <!-- Message Container -->
                        <div id="message-container" class="message-container"></div>

                        <!-- Control Buttons -->
                        <div class="control-btns-display">
                            <button id="pause-game" class="btn btn-sm btn-secondary p-1" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" height="19px" viewBox="0 -960 960 960" width="19px" fill="#FFFFFF"><path d="M520-200v-560h240v560H520Zm-320 0v-560h240v560H200Zm400-80h80v-400h-80v400Zm-320 0h80v-400h-80v400Zm0-400v400-400Zm320 0v400-400Z"/></svg>
                            </button>
                            <button id="resume-game" class="btn btn-sm btn-secondary p-1" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" height="19px" viewBox="0 -960 960 960" width="19px" fill="#FFFFFF"><path d="M320-200v-560l440 280-440 280Zm80-280Zm0 134 210-134-210-134v268Z"/></svg>
                            </button>
                        </div>

                        <!-- Resources Display -->
                        <div class="resources-display bg-primary p-1 rounded">
                            💰 <span id="gold-count">0</span> &nbsp;&nbsp; 🌲 <span id="lumber-count">0</span>
                        </div>
                    </div>

                    <div class="upgrades-menu">
                        <!-- Lumber Goblin Upgrades -->
                        <div class="upgrade-item">
                            <div class="upgrade-header">
                                🌲 Lumber Gobis (<span id="lumber-goblin-count">1</span>/<span id="lumber-max-goblins">3</span>)
                            </div>
                            <div class="upgrade-controls">
                                <button id="buy-lumber-goblin" class="btn btn-sm btn-fourthiary">
                                    Buy <span id="lumber-goblin-cost">20</span> 💰
                                </button>
                                <button id="upgrade-lumber-speed" class="btn btn-sm btn-fourthiary">
                                    Speed (<span id="lumber-speed-level">1</span>) <span id="lumber-speed-cost">5</span>💰
                                </button>
                                <button id="upgrade-lumber-carry" class="btn btn-sm btn-fourthiary">
                                    Carry (<span id="lumber-carry-level">1</span>) <span id="lumber-carry-cost">5</span>💰
                                </button>
                                <button id="upgrade-lumber-resistance" class="btn btn-sm btn-fourthiary">
                                    Resist (<span id="lumber-resistance-level">1</span>) <span id="lumber-resistance-cost">8</span>💰 <span id="lumber-resistance-cost-lumber">8</span>🌲
                                </button>
                            </div>
                        </div>

                        <!-- Gold Goblin Upgrades -->
                        <div class="upgrade-item">
                            <div class="upgrade-header">
                                💰 Gold Gobis (<span id="gold-goblin-count">1</span>/<span id="gold-max-goblins">3</span>)
                            </div>
                            <div class="upgrade-controls">
                                <button id="buy-gold-goblin" class="btn btn-sm btn-fourthiary">
                                    Buy <span id="gold-goblin-cost">20</span>🌲
                                </button>
                                <button id="upgrade-gold-speed" class="btn btn-sm btn-fourthiary">
                                    Speed (<span id="gold-speed-level">1</span>) <span id="gold-speed-cost">5</span>🌲
                                </button>
                                <button id="upgrade-gold-carry" class="btn btn-sm btn-fourthiary">
                                    Carry (<span id="gold-carry-level">1</span>) <span id="gold-carry-cost">5</span>🌲
                                </button>
                                <button id="upgrade-gold-resistance" class="btn btn-sm btn-fourthiary">
                                    Resist (<span id="gold-resistance-level">1</span>) <span id="gold-resistance-cost">8</span>🌲 <span id="gold-resistance-cost-gold">8</span>💰
                                </button>
                            </div>
                        </div>

                        <!-- Rocket Upgrade -->
                        <div class="upgrade-item">
                            <div class="upgrade-header">
                                🚀 Rocket Lv <span id="rocket-level">1</span>
                            </div>
                            <div class="upgrade-controls">
                                <button id="upgrade-rocket" class="btn btn-sm btn-fourthiary">
                                    Upgrade <span id="rocket-cost-lumber">70</span>🌲 <span id="rocket-cost-gold">70</span>💰
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4 p-3 bg-tertiary text-white">
            <h3 class="text-center">How to Play</h3>
            <ul class="list-unstyled">
                <li><strong>Goal:</strong> Upgrade your rocket as much as possible to achieve a high score!</li>
                <li><strong>Gather Resources:</strong> Goblins gather <span class="text-fourthiary">gold 💰</span> and <span class="text-fourthiary">lumber 🌲</span>.</li>
                <li><strong>Upgrade:</strong> Invest resources to improve goblins’ speed, carry capacity, and resistance.</li>
                <li><strong>Score:</strong> Earn points for upgrades. Submit your score to compete!</li>
            </ul>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        // Game State
        let resources = { lumber: 0, gold: 0 };
        let gameRunning = false;
        let score = 0;

        // Goblin Data
        let lumberGoblins = [];
        let goldGoblins = [];

        // Goblin Upgrades
        let lumberGoblinUpgrades = {
            speedLevel: 1,
            carryLevel: 1,
            resistanceLevel: 1,
            speedCost: 5,
            carryCost: 5,
            resistanceCost: 8,
            resistanceCostLumber: 8
        };

        let goldGoblinUpgrades = {
            speedLevel: 1,
            carryLevel: 1,
            resistanceLevel: 1,
            speedCost: 5,
            carryCost: 5,
            resistanceCost: 8,
            resistanceCostGold: 8
        };

        // Goblin Purchase Costs
        let lumberGoblinCost = 20;
        let goldGoblinCost = 20;

        let lumberGoblinResurrectCost = 70;
        let goldGoblinResurrectCost = 70;

        // Rocket Upgrade
        let rocketLevel = 1;
        let rocketCost = {
            lumber: 70,
            gold: 70
        };

        // Max Goblins
        const maxGoblins = 3;

        // Initialize Goblins
        function initGoblins() {
            addLumberGoblin();
            addGoldGoblin();
        }

        let gameStartTime;

        // Blockchain variables
        let connection = new window.solanaWeb3.Connection(
            // window.solanaWeb3.clusterApiUrl('mainnet-beta'),
            window.solanaWeb3.clusterApiUrl('devnet'),
            'confirmed'
        );

        const DEV_WALLET = '8w9BriDSc57tm7RYMPHVpRkD3CoGUqBuiQs2kNqQouzg'; // Replace with your actual dev wallet address
        const ALLOCATION_PERCENTAGE = 75; // Adjustable percentage

        $('#start-game').click(() => {
            // Existing code...
            gameStartTime = Date.now(); // Store game start time
        });

        function getElementCenter(element) {
            const pos = element.position();
            const width = element.width();
            const height = element.height();
            return {
                left: pos.left + width / 2,
                top: pos.top + height / 2
            };
        }

        // Add Goblin Functions
        function addLumberGoblin() {
            if (lumberGoblins.length >= maxGoblins) {
                alert('Maximum lumber goblins reached!');
                return;
            }
            const goblinId = 'lumber-goblin-' + (lumberGoblins.length + 1);
            const goblin = $('<div class="goblin lumber-goblin" id="' + goblinId + '"><img class="img-goblin" src="../../images/game_assets/gobi.webp"></div>');

            const rocketCenter = getElementCenter($('#rocket'));

            const goblinData = {
                id: goblinId,
                element: goblin,
                resourceType: 'lumber',
                isMoving: false,
                direction: 'toResource',
                hp: 100,
                maxHp: 100,
                isDead: false
            };

            goblin.css({
                position: 'absolute',
                top: rocketCenter.top - goblin.height() / 2,
                left: rocketCenter.left - goblin.width() / 2
            });

            // Create health bar
            const hpBarContainer = $('<div class="goblin-hp-bar-container"></div>');
            const hpBar = $('<div class="goblin-hp-bar" id="' + goblinId + '-hp-bar"></div>');
            hpBarContainer.append(hpBar);
            goblin.append(hpBarContainer);
            $('.map-section').append(goblin);
            lumberGoblins.push(goblinData);
            updateButtons();
            $('#lumber-goblin-count').text(lumberGoblins.length);
            updateButtons();
            if (gameRunning) {
                startGoblin(goblinData);
            }
        }

        function addGoldGoblin() {
            if (goldGoblins.length >= maxGoblins) {
                alert('Maximum gold goblins reached!');
                return;
            }
            const goblinId = 'gold-goblin-' + (goldGoblins.length + 1);
            const goblin = $('<div class="goblin gold-goblin" id="' + goblinId + '"><img class="img-goblin" src="../../images/game_assets/gobi.webp"></div>');
            const goblinData = {
                id: goblinId,
                element: goblin,
                resourceType: 'gold',
                isMoving: false,
                direction: 'toResource',
                hp: 100,
                maxHp: 100
            };
            const rocketCenter = getElementCenter($('#rocket'));
            goblin.css({
                position: 'absolute',
                top: rocketCenter.top - goblin.height() / 2,
                left: rocketCenter.left - goblin.width() / 2
            });
            // Create health bar
            const hpBarContainer = $('<div class="goblin-hp-bar-container"></div>');
            const hpBar = $('<div class="goblin-hp-bar" id="' + goblinId + '-hp-bar"></div>');
            hpBarContainer.append(hpBar);
            goblin.append(hpBarContainer);
            $('.map-section').append(goblin);
            goldGoblins.push(goblinData);
            updateButtons();
            $('#gold-goblin-count').text(goldGoblins.length);
            updateButtons();
            if (gameRunning) {
                startGoblin(goblinData);
            }
        }

        // Start Goblin Movement
        function startGoblin(goblinData) {
            if (goblinData.isMoving || goblinData.isDead) return;
            goblinData.isMoving = true;

            const goblin = goblinData.element;
            const resourceType = goblinData.resourceType;

            const resourceElement = resourceType === 'lumber' ? $('#forest') : $('#mine');
            const rocketElement = $('#rocket');

            const resourceCenter = getElementCenter(resourceElement);
            const rocketCenter = getElementCenter(rocketElement);

            function goblinLoop() {
                if (!gameRunning || goblinData.hp <= 0) {
                    goblinData.isMoving = false;
                    return;
                }

                let upgrades = resourceType === 'lumber' ? lumberGoblinUpgrades : goldGoblinUpgrades;
                let baseSpeed = 2000 / (1 + 0.05 * upgrades.speedLevel);
                let carryAmount = upgrades.carryLevel;

                let startPos = goblin.position();
                let targetPos = goblinData.direction === 'toResource' ? resourceCenter : rocketCenter;

                // Calculate distance and adjust speed
                let dx = targetPos.left - startPos.left - goblin.width() / 2;
                let dy = targetPos.top - startPos.top - goblin.height() / 2;
                let distance = Math.sqrt(dx * dx + dy * dy);
                const standardDistance = 500; // Adjust as needed
                let adjustedSpeed = baseSpeed * (distance / standardDistance);

                // Start moving
                goblin.animate(
                    {
                        left: targetPos.left - goblin.width() / 2,
                        top: targetPos.top - goblin.height() / 2
                    },
                    adjustedSpeed,
                    'linear',
                    () => {
                        if (goblinData.direction === 'toResource') {
                            goblin.addClass('collecting');

                            if (resourceType === 'gold') {
                                // Simulate entering the mine
                                goblin.fadeOut(500, () => {
                                    if (goblinData.isDead) return;
                                    setTimeout(() => {
                                        if (goblinData.isDead) return;
                                        goblin.fadeIn(500, () => {
                                            if (goblinData.isDead) return;
                                            goblin.removeClass('collecting');
                                            goblinData.direction = 'toRocket';
                                            goblinLoop();
                                        });
                                    }, 1500);
                                });
                            } else {
                                // For lumber goblins, just wait
                                setTimeout(() => {
                                    if (goblinData.isDead) return;
                                    goblin.removeClass('collecting');
                                    goblinData.direction = 'toRocket';
                                    goblinLoop();
                                }, 1500);
                            }
                        } else if (goblinData.direction === 'toRocket') {
                            // Deliver resources
                            resources[resourceType] += carryAmount;
                            $('#' + resourceType + '-count').text(resources[resourceType]);

                            // Add colored counter for delivered resources
                            if (resourceType === 'gold') {
                                displayCounter(goblin, '+' + carryAmount, '#ffc107'); // Yellow for gold
                            } else {
                                displayCounter(goblin, '+' + carryAmount, '#28a745'); // Green for lumber
                            }

                            updateButtons();
                            goblinData.direction = 'toResource';
                            goblinLoop();
                        }
                    }
                );
            }

            goblinLoop();
        }

        // Display Counter Animation
        function displayCounter(goblin, text, color = '#28a745') { // Default color is green
            const counter = $('<div class="delivery-counter"></div>').text(text);

            const offset = goblin.offset();
            counter.css({
                position: 'absolute',
                top: offset.top - 20,
                left: offset.left + 20,
                color: color,
                fontWeight: 'bold', // Make it visually distinct
                zIndex: 1000 // Ensure it appears on top of other elements
            });

            $('body').append(counter);
            counter.animate({ top: '-=20', opacity: 0 }, 1000, () => counter.remove());
        }

        // Handle Play Free
        $('#start-game-free').click(() => {
            gameRunning = true;
            $('#start-screen').hide();
            $('#pause-game').show();
            lumberGoblins.forEach(g => startGoblin(g));
            goldGoblins.forEach(g => startGoblin(g));
            startEnemySpawn();
            updateButtons();
            gameStartTime = Date.now(); // Start time
        });

        // Handle Play Paid
        $('#start-game-paid').click(async () => {
            // Check if Phantom is installed and wallet is connected
            if (window.solana && window.solana.isPhantom) {
                if (!window.walletPublicKey) {
                    alert('Please connect your wallet using the button in the navbar.');
                    return;
                }

                try {
                    // Define the amount to send (e.g., 0.01 SOL)
                    const amountSOL = 0.0001; // Adjust as needed

                    // Fetch the latest blockhash
                    const { blockhash } = await connection.getLatestBlockhash('finalized');

                    // Create a transaction to send SOL to the dev wallet
                    const transaction = new window.solanaWeb3.Transaction({
                        recentBlockhash: blockhash, // Set the required blockhash
                        feePayer: window.solana.publicKey, // Wallet paying the transaction fees
                    }).add(
                        window.solanaWeb3.SystemProgram.transfer({
                            fromPubkey: window.solana.publicKey,
                            toPubkey: new window.solanaWeb3.PublicKey(DEV_WALLET),
                            lamports: window.solanaWeb3.LAMPORTS_PER_SOL * amountSOL,
                        })
                    );

                    // Send transaction
                    const signedTransaction = await window.solana.signTransaction(transaction);
                    const signature = await connection.sendRawTransaction(signedTransaction.serialize());
                    await connection.confirmTransaction(signature, 'confirmed');

                    // Start the game as paid
                    gameRunning = true;
                    $('#start-screen').hide();
                    $('#pause-game').show();
                    lumberGoblins.forEach(g => startGoblin(g));
                    goldGoblins.forEach(g => startGoblin(g));
                    startEnemySpawn();
                    updateButtons();
                    gameStartTime = Date.now(); // Start time

                    // Optionally, notify the backend about the payment
                    // However, since the payment is handled manually, the backend relies on score submission to update the prize pool
                } catch (err) {
                    console.error(err);
                    alert('Failed to connect to wallet or complete transaction.');
                }
            } else {
                alert('Phantom Wallet not found. Please install Phantom to play paid.');
            }
        });

        // Pause Game
        $('#pause-game').click(() => {
            gameRunning = false;
            $('#pause-game').hide();
            $('#resume-game').show();
            // Pause goblin animations
            lumberGoblins.forEach(g => {
                g.element.stop(true);
                g.isMoving = false;
            });
            goldGoblins.forEach(g => {
                g.element.stop(true);
                g.isMoving = false;
            });
            // Pause enemy animations
            enemies.forEach(e => {
                e.element.stop(true);
                if (e.attackTimeout) {
                    clearTimeout(e.attackTimeout);
                    e.attackTimeout = null;
                }
            });
            // Stop enemy spawning
            clearTimeout(enemyInterval);

            // Calculate time remaining to next enemy spawn
            if (nextEnemySpawnTime) {
                timeRemainingToNextEnemy = nextEnemySpawnTime - Date.now();
                if (timeRemainingToNextEnemy < 0) timeRemainingToNextEnemy = 0;
            }
        });

        // Resume Game
        $('#resume-game').click(() => {
            gameRunning = true;
            $('#resume-game').hide();
            $('#pause-game').show();
            lumberGoblins.forEach(g => {
                startGoblin(g);
            });
            goldGoblins.forEach(g => {
                startGoblin(g);
            });
            // Resume enemy animations
            enemies.forEach(e => {
                let remainingDistance = $(window).width() - e.element.offset().left;
                let remainingTime = (remainingDistance / $(window).width()) * 8000; // Adjust duration
                e.element.animate({ left: '110%' }, {
                    duration: remainingTime,
                    easing: 'linear',
                    complete: function() {
                        e.element.remove();
                        enemies = enemies.filter(en => en.element !== e.element);
                    }
                });
                // Reschedule attack
                let elapsedTime = 8000 - remainingTime;
                let attackTime = Math.max(4000 - elapsedTime, 0);
                e.attackTimeout = setTimeout(() => {
                    attackGoblin(e.element);
                }, attackTime);
            });
            // Restart enemy spawning
            startEnemySpawn();
        });


        // Buy Goblins
        $('#buy-lumber-goblin').click(() => {
            let aliveLumberGoblins = lumberGoblins.filter(g => !g.isDead);
            let deadLumberGoblins = lumberGoblins.filter(g => g.isDead);

            if (lumberGoblins.length < maxGoblins) {
                // Buy new goblin
                if (resources.gold >= lumberGoblinCost) {
                    resources.gold -= lumberGoblinCost;
                    $('#gold-count').text(resources.gold);
                    lumberGoblinCost = Math.floor(lumberGoblinCost * 1.3);
                    $('#lumber-goblin-cost').text(lumberGoblinCost);
                    addLumberGoblin();
                    updateButtons();

                    score += 20;
                    updateScoreDisplay();
                }
            } else if (deadLumberGoblins.length > 0) {
                // Resurrect a dead goblin
                if (resources.gold >= lumberGoblinResurrectCost) {
                    resources.gold -= lumberGoblinResurrectCost;
                    $('#gold-count').text(resources.gold);

                    let goblinData = deadLumberGoblins[0];
                    goblinData.isDead = false;
                    goblinData.hp = goblinData.maxHp;
                    goblinData.element.show();

                    // Update HP bar to full
                    $('#' + goblinData.id + '-hp-bar').css('width', '100%');

                    startGoblin(goblinData);
                    lumberGoblinResurrectCost = Math.floor(lumberGoblinResurrectCost * 1.2);
                    $('#lumber-goblin-cost').text(lumberGoblinResurrectCost);
                    updateButtons();
                }
            } else {
                alert('Maximum lumber goblins reached!');
            }
        });

        $('#buy-gold-goblin').click(() => {
            let aliveGoldGoblins = goldGoblins.filter(g => !g.isDead);
            let deadGoldGoblins = goldGoblins.filter(g => g.isDead);

            if (goldGoblins.length < maxGoblins) {
                // Buy new goblin
                if (resources.lumber >= goldGoblinCost) {
                    resources.lumber -= goldGoblinCost;
                    $('#lumber-count').text(resources.lumber);
                    goldGoblinCost = Math.floor(goldGoblinCost * 1.3);
                    $('#gold-goblin-cost').text(goldGoblinCost);
                    addGoldGoblin();
                    updateButtons();

                    score += 20;
                    updateScoreDisplay();
                }
            } else if (deadGoldGoblins.length > 0) {
                // Resurrect a dead goblin
                if (resources.lumber >= goldGoblinResurrectCost) {
                    resources.lumber -= goldGoblinResurrectCost;
                    $('#lumber-count').text(resources.lumber);

                    let goblinData = deadGoldGoblins[0];
                    goblinData.isDead = false;
                    goblinData.hp = goblinData.maxHp;
                    goblinData.element.show();

                    // Update HP bar to full
                    $('#' + goblinData.id + '-hp-bar').css('width', '100%');

                    startGoblin(goblinData);
                    goldGoblinResurrectCost = Math.floor(goldGoblinResurrectCost * 1.2);
                    $('#gold-goblin-cost').text(goldGoblinResurrectCost);
                    updateButtons();
                }
            } else {
                alert('Maximum gold goblins reached!');
            }
        });

        // Upgrade Goblins
        $('#upgrade-lumber-speed').click(() => {
            let maxLevel = rocketLevel * 5;
            if (lumberGoblinUpgrades.speedLevel >= maxLevel) {
                alert('Max level reached! Upgrade your rocket to increase max level.');
                return;
            }
            if (resources.gold >= lumberGoblinUpgrades.speedCost) {
                resources.gold -= lumberGoblinUpgrades.speedCost;
                $('#gold-count').text(resources.gold);
                lumberGoblinUpgrades.speedLevel++;
                lumberGoblinUpgrades.speedCost = Math.floor(lumberGoblinUpgrades.speedCost * 1.3);
                $('#lumber-speed-level').text(lumberGoblinUpgrades.speedLevel);
                $('#lumber-speed-cost').text(lumberGoblinUpgrades.speedCost);
                updateButtons();

                // Increment score
                score += 10; // Adjust the value as needed
                updateScoreDisplay();
            }
        });

        $('#upgrade-lumber-carry').click(() => {
            let maxLevel = rocketLevel * 5;
            if (lumberGoblinUpgrades.carryLevel >= maxLevel) {
                alert('Max level reached! Upgrade your rocket to increase max level.');
                return;
            }
            if (resources.gold >= lumberGoblinUpgrades.carryCost) {
                resources.gold -= lumberGoblinUpgrades.carryCost;
                $('#gold-count').text(resources.gold);
                lumberGoblinUpgrades.carryLevel++;
                lumberGoblinUpgrades.carryCost = Math.floor(lumberGoblinUpgrades.carryCost * 1.3);
                $('#lumber-carry-level').text(lumberGoblinUpgrades.carryLevel);
                $('#lumber-carry-cost').text(lumberGoblinUpgrades.carryCost);
                updateButtons();

                // Increment score
                score += 10; // Adjust the value as needed
                updateScoreDisplay();
            }
        });

        $('#upgrade-lumber-resistance').click(() => {
            let maxLevel = rocketLevel * 5;
            if (lumberGoblinUpgrades.resistanceLevel >= maxLevel) {
                alert('Max level reached! Upgrade your rocket to increase max level.');
                return;
            }
            if (resources.gold >= lumberGoblinUpgrades.resistanceCost && resources.lumber >= lumberGoblinUpgrades.resistanceCostLumber) {
                resources.gold -= lumberGoblinUpgrades.resistanceCost;
                resources.lumber -= lumberGoblinUpgrades.resistanceCostLumber;
                $('#gold-count').text(resources.gold);
                $('#lumber-count').text(resources.lumber);
                lumberGoblinUpgrades.resistanceLevel++;
                lumberGoblinUpgrades.resistanceCost = Math.floor(lumberGoblinUpgrades.resistanceCost * 1.3);
                lumberGoblinUpgrades.resistanceCostLumber = Math.floor(lumberGoblinUpgrades.resistanceCostLumber * 1.3);
                $('#lumber-resistance-level').text(lumberGoblinUpgrades.resistanceLevel);
                $('#lumber-resistance-cost').text(lumberGoblinUpgrades.resistanceCost);
                $('#lumber-resistance-cost-lumber').text(lumberGoblinUpgrades.resistanceCostLumber);
                updateButtons();

                // Increment score
                score += 10; // Adjust the value as needed
                updateScoreDisplay();
            }
        });

        $('#upgrade-gold-speed').click(() => {
            let maxLevel = rocketLevel * 5;
            if (goldGoblinUpgrades.speedLevel >= maxLevel) {
                alert('Max level reached! Upgrade your rocket to increase max level.');
                return;
            }
            if (resources.lumber >= goldGoblinUpgrades.speedCost) {
                resources.lumber -= goldGoblinUpgrades.speedCost;
                $('#lumber-count').text(resources.lumber);
                goldGoblinUpgrades.speedLevel++;
                goldGoblinUpgrades.speedCost = Math.floor(goldGoblinUpgrades.speedCost * 1.3);
                $('#gold-speed-level').text(goldGoblinUpgrades.speedLevel);
                $('#gold-speed-cost').text(goldGoblinUpgrades.speedCost);
                updateButtons();

                // Increment score
                score += 10; // Adjust the value as needed
                updateScoreDisplay();
            }
        });

        $('#upgrade-gold-carry').click(() => {
            let maxLevel = rocketLevel * 5;
            if (goldGoblinUpgrades.carryLevel >= maxLevel) {
                alert('Max level reached! Upgrade your rocket to increase max level.');
                return;
            }
            if (resources.lumber >= goldGoblinUpgrades.carryCost) {
                resources.lumber -= goldGoblinUpgrades.carryCost;
                $('#lumber-count').text(resources.lumber);
                goldGoblinUpgrades.carryLevel++;
                goldGoblinUpgrades.carryCost = Math.floor(goldGoblinUpgrades.carryCost * 1.3);
                $('#gold-carry-level').text(goldGoblinUpgrades.carryLevel);
                $('#gold-carry-cost').text(goldGoblinUpgrades.carryCost);
                updateButtons();

                // Increment score
                score += 10; // Adjust the value as needed
                updateScoreDisplay();
            }
        });

        $('#upgrade-gold-resistance').click(() => {
            let maxLevel = rocketLevel * 5;
            if (goldGoblinUpgrades.resistanceLevel >= maxLevel) {
                alert('Max level reached! Upgrade your rocket to increase max level.');
                return;
            }
            if (resources.lumber >= goldGoblinUpgrades.resistanceCost && resources.gold >= goldGoblinUpgrades.resistanceCostGold) {
                resources.lumber -= goldGoblinUpgrades.resistanceCost;
                resources.gold -= goldGoblinUpgrades.resistanceCostGold;
                $('#lumber-count').text(resources.lumber);
                $('#gold-count').text(resources.gold);
                goldGoblinUpgrades.resistanceLevel++;
                goldGoblinUpgrades.resistanceCost = Math.floor(goldGoblinUpgrades.resistanceCost * 1.3);
                goldGoblinUpgrades.resistanceCostGold = Math.floor(goldGoblinUpgrades.resistanceCostGold * 1.3);
                $('#gold-resistance-level').text(goldGoblinUpgrades.resistanceLevel);
                $('#gold-resistance-cost').text(goldGoblinUpgrades.resistanceCost);
                $('#gold-resistance-cost-gold').text(goldGoblinUpgrades.resistanceCostGold);
                updateButtons();

                // Increment score
                score += 10; // Adjust the value as needed
                updateScoreDisplay();
            }
        });

        // Upgrade Rocket
        $('#upgrade-rocket').click(() => {
            if (resources.lumber >= rocketCost.lumber && resources.gold >= rocketCost.gold) {
                resources.lumber -= rocketCost.lumber;
                resources.gold -= rocketCost.gold;
                $('#lumber-count').text(resources.lumber);
                $('#gold-count').text(resources.gold);
                rocketLevel++;
                $('#rocket-level').text(rocketLevel);
                rocketCost.lumber = Math.floor(rocketCost.lumber * 1.3);
                rocketCost.gold = Math.floor(rocketCost.gold * 1.3);
                $('#rocket-cost-lumber').text(rocketCost.lumber);
                $('#rocket-cost-gold').text(rocketCost.gold);
                showMessage('Rocket upgraded to level ' + rocketLevel + '!');

                // Increment score with time bonus
                let timeElapsed = (Date.now() - gameStartTime) / 1000; // Time in seconds
                let baseScore = 1000; // Base score for rocket upgrade
                let timeBonus = Math.max(0, (1000 - timeElapsed)); // Faster upgrades give more score
                score += baseScore + timeBonus;
                updateScoreDisplay();

                updateButtons();
                updateLevelDisplays();
                clearTimeout(enemyInterval);
                startEnemySpawn();
            }
        });

        // Update Buttons Based on Resources
        function updateButtons() {
            // Lumber Goblin Logic
            let aliveLumberGoblins = lumberGoblins.filter(g => !g.isDead);
            let deadLumberGoblins = lumberGoblins.filter(g => g.isDead);

            if (lumberGoblins.length < maxGoblins) {
                // Can buy new goblin
                $('#buy-lumber-goblin').html(`Buy <span id="lumber-goblin-cost">${lumberGoblinCost}</span>💰`);
                $('#buy-lumber-goblin').prop('disabled', resources.gold < lumberGoblinCost);
            } else if (deadLumberGoblins.length > 0) {
                // Can resurrect dead goblin
                $('#buy-lumber-goblin').html(`Resurrect <span id="lumber-goblin-cost">${lumberGoblinResurrectCost}</span>💰`);
                $('#buy-lumber-goblin').prop('disabled', resources.gold < lumberGoblinResurrectCost);
            } else {
                // Cannot buy or resurrect
                $('#buy-lumber-goblin').prop('disabled', true);
            }

            // Update the goblin count display
            $('#lumber-goblin-count').text(aliveLumberGoblins.length);
            $('#lumber-max-goblins').text(maxGoblins);

            // Gold Goblin Logic
            let aliveGoldGoblins = goldGoblins.filter(g => !g.isDead);
            let deadGoldGoblins = goldGoblins.filter(g => g.isDead);

            if (goldGoblins.length < maxGoblins) {
                // Can buy new goblin
                $('#buy-gold-goblin').html(`Buy <span id="gold-goblin-cost">${goldGoblinCost}</span>🌲`);
                $('#buy-gold-goblin').prop('disabled', resources.lumber < goldGoblinCost);
            } else if (deadGoldGoblins.length > 0) {
                // Can resurrect dead goblin
                $('#buy-gold-goblin').html(`Resurrect <span id="gold-goblin-cost">${goldGoblinResurrectCost}</span>🌲`);
                $('#buy-gold-goblin').prop('disabled', resources.lumber < goldGoblinResurrectCost);
            } else {
                // Cannot buy or resurrect
                $('#buy-gold-goblin').prop('disabled', true);
            }

            // Update the goblin count display
            $('#gold-goblin-count').text(aliveGoldGoblins.length);
            $('#gold-max-goblins').text(maxGoblins);


            let maxLevel = rocketLevel * 5;

            // Lumber Goblin Upgrades
            $('#upgrade-lumber-speed')
                .prop('disabled', resources.gold < lumberGoblinUpgrades.speedCost || lumberGoblinUpgrades.speedLevel >= maxLevel)
                .attr('title', lumberGoblinUpgrades.speedLevel >= maxLevel ? 'Max level reached. Upgrade your rocket to increase max level.' : '');

            $('#upgrade-lumber-carry')
                .prop('disabled', resources.gold < lumberGoblinUpgrades.carryCost || lumberGoblinUpgrades.carryLevel >= maxLevel)
                .attr('title', lumberGoblinUpgrades.carryLevel >= maxLevel ? 'Max level reached. Upgrade your rocket to increase max level.' : '');

            $('#upgrade-lumber-resistance')
                .prop('disabled', resources.gold < lumberGoblinUpgrades.resistanceCost || resources.lumber < lumberGoblinUpgrades.resistanceCostLumber || lumberGoblinUpgrades.resistanceLevel >= maxLevel)
                .attr('title', lumberGoblinUpgrades.resistanceLevel >= maxLevel ? 'Max level reached. Upgrade your rocket to increase max level.' : '');

            // Gold Goblin Upgrades
            $('#upgrade-gold-speed')
                .prop('disabled', resources.lumber < goldGoblinUpgrades.speedCost || goldGoblinUpgrades.speedLevel >= maxLevel)
                .attr('title', goldGoblinUpgrades.speedLevel >= maxLevel ? 'Max level reached. Upgrade your rocket to increase max level.' : '');

            $('#upgrade-gold-carry')
                .prop('disabled', resources.lumber < goldGoblinUpgrades.carryCost || goldGoblinUpgrades.carryLevel >= maxLevel)
                .attr('title', goldGoblinUpgrades.carryLevel >= maxLevel ? 'Max level reached. Upgrade your rocket to increase max level.' : '');

            $('#upgrade-gold-resistance')
                .prop('disabled', resources.lumber < goldGoblinUpgrades.resistanceCost || resources.gold < goldGoblinUpgrades.resistanceCostGold || goldGoblinUpgrades.resistanceLevel >= maxLevel)
                .attr('title', goldGoblinUpgrades.resistanceLevel >= maxLevel ? 'Max level reached. Upgrade your rocket to increase max level.' : '');

            // Rocket Upgrade Button
            $('#upgrade-rocket').prop('disabled', resources.lumber < rocketCost.lumber || resources.gold < rocketCost.gold);

            updateLevelDisplays();
        }

        // Enemy Spawn Function
        function startEnemySpawn() {
            function spawnLoop() {
                if (!gameRunning) return;

                // Decrease interval as rocket level increases
                let spawnInterval = Math.max(15000 - (rocketLevel - 1) * 1000, 5000); // Minimum interval of 5 seconds

                nextEnemySpawnTime = Date.now() + spawnInterval;

                enemyInterval = setTimeout(() => {
                    if (!gameRunning) return;
                    spawnEnemy();
                    spawnLoop();
                }, spawnInterval);
            }

            if (timeRemainingToNextEnemy > 0) {
                // Use remaining time
                enemyInterval = setTimeout(() => {
                    if (!gameRunning) return;
                    spawnEnemy();
                    spawnLoop();
                }, timeRemainingToNextEnemy);
                nextEnemySpawnTime = Date.now() + timeRemainingToNextEnemy;
                timeRemainingToNextEnemy = 0;
            } else {
                spawnLoop();
            }
        }

        // Enemy Variables
        let enemyInterval;
        let enemies = [];
        let nextEnemySpawnTime;
        let timeRemainingToNextEnemy = 0;

        function spawnEnemy() {
            const enemy = $(`
                <div class="enemy-container">
                    <div class="enemy-name">Rafa</div>
                    <div class="enemy">
                        <img src="../../images/game_assets/rafa.webp" height="120px">
                    </div>
                </div>
            `);
            enemy.css({
                top: Math.random() * 80 + '%',
                left: '-50px'
            });
            $('.map-section').append(enemy);

            // Move enemy across the screen
            const enemyAnimation = enemy.animate({ left: '110%' }, {
                duration: 8000,
                easing: 'linear',
                complete: function() {
                    enemy.remove();
                    enemies = enemies.filter(e => e.element !== enemy);
                }
            });

            // Enemy object
            let enemyObj = {
                element: enemy,
                animation: enemyAnimation,
                attackTimeout: null
            };

            // Store enemy and its animation
            enemies.push(enemyObj);

            // Enemy attacks a random goblin
            enemyObj.attackTimeout = setTimeout(() => {
                attackGoblin(enemy);
            }, 4000); // Enemy attacks at halfway point
        }

        function attackGoblin(enemy) {
            const allGoblins = lumberGoblins.concat(goldGoblins).filter(g => g.hp > 0);
            if (allGoblins.length === 0) {
                endGame();
                return;
            }

            const targetGoblin = allGoblins[Math.floor(Math.random() * allGoblins.length)];
            const goblinElement = targetGoblin.element;

            // Show attack animation
            const attackEffect = $('<div class="attack-effect">💥</div>');
            attackEffect.css({
                position: 'absolute',
                top: goblinElement.position().top,
                left: goblinElement.position().left,
                fontSize: '30px',
                color: 'red'
            });
            $('.map-section').append(attackEffect);
            setTimeout(() => attackEffect.remove(), 500);

            // Calculate damage based on rocket level
            let baseDamage = 25 + (rocketLevel - 1) * 5; // Increase damage by 2 for each rocket level
            let resistanceLevel = targetGoblin.resourceType === 'lumber' ? lumberGoblinUpgrades.resistanceLevel : goldGoblinUpgrades.resistanceLevel;
            let damage = Math.max(baseDamage - resistanceLevel * 2, 5); // Minimum damage of 5

            targetGoblin.hp -= damage;

            // Update HP bar
            let hpPercent = (targetGoblin.hp / targetGoblin.maxHp) * 100;
            $('#' + targetGoblin.id + '-hp-bar').css('width', hpPercent + '%');

            // Check if goblin is dead
            // Check if goblin is dead
            // Check if goblin is dead
            if (targetGoblin.hp <= 0) {
                handleGoblinDeath(targetGoblin);
            }
        }

        function endGame() {
            gameRunning = false;
            clearTimeout(enemyInterval);
            $('#pause-game').hide();

            // Show the final score in the modal
            $('#final-score').text(score);

            // Show the game over modal
            $('#game-over-modal').modal('show');

            // Handle submit score button
            $('#submit-score-button').off('click').on('click', function () {
                let playerName = $('#player-name-input').val().trim();
                if (playerName !== '') {
                    // Disable button and show spinner
                    $(this).prop('disabled', true);
                    $(this).html('Submitting <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

                    // Determine if the playthrough is paid
                    const isPaid = walletPublicKey !== null; // Replace walletPublicKey with your actual wallet connection logic
                    const paymentAmount = isPaid ? 0.01 : 0; // Replace 0.01 with the actual payment amount for paid playthroughs

                    $.ajax({
                        url: '/scores',
                        method: 'POST',
                        data: {
                            name: playerName,
                            score: score,
                            wallet_address: walletPublicKey || 'free_player',
                            is_paid: isPaid,
                            payment_amount: paymentAmount,
                            _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                        },
                        success: function (response) {
                            console.log('Score submitted successfully:', response);
                            $('#game-over-modal').modal('hide');
                            resetGame();
                        },
                        error: function (xhr) {
                            console.error('Score submission error:', xhr.responseText);
                            alert('An error occurred while saving your score.');
                            $('#submit-score-button').prop('disabled', false);
                            $('#submit-score-button').html('Submit Score');
                        }
                    });
                }
            });

            // Update the Start Game button text
            $('#start-game').text('Restart Game');
            $('#start-screen').show();
        }


        // Reset Game State
        function resetGame() {
            // Reset variables
            resources = { lumber: 0, gold: 0 };
            lumberGoblins = [];
            goldGoblins = [];

            score = 0; // Reset score
            displayedScore = 0; // Reset displayed score
            $('#score-count').text(score); // Update score display

            lumberGoblinUpgrades = {
                speedLevel: 1,
                carryLevel: 1,
                resistanceLevel: 1,
                speedCost: 5,
                carryCost: 5,
                resistanceCost: 8,
                resistanceCostLumber: 8
            };

            goldGoblinUpgrades = {
                speedLevel: 1,
                carryLevel: 1,
                resistanceLevel: 1,
                speedCost: 5,
                carryCost: 5,
                resistanceCost: 8,
                resistanceCostGold: 8
            };

            lumberGoblinCost = 20;
            goldGoblinCost = 20;

            lumberGoblinResurrectCost = 70;
            goldGoblinResurrectCost = 70;

            rocketLevel = 1;
            rocketCost = {
                lumber: 70,
                gold: 70
            };

            // Update UI
            $('#lumber-count').text(resources.lumber);
            $('#gold-count').text(resources.gold);
            // Update goblin counts
            $('#lumber-goblin-count').text('0');
            $('#lumber-max-goblins').text(maxGoblins);
            $('#gold-goblin-count').text('0');
            $('#gold-max-goblins').text(maxGoblins);
            $('#rocket-level').text(rocketLevel);
            $('#rocket-cost-lumber').text(rocketCost.lumber);
            $('#rocket-cost-gold').text(rocketCost.gold);

            // Update upgrade levels and costs
            updateLevelDisplays();

            // Update upgrade costs
            $('#lumber-speed-cost').text(lumberGoblinUpgrades.speedCost);
            $('#lumber-carry-cost').text(lumberGoblinUpgrades.carryCost);
            $('#lumber-resistance-cost').text(lumberGoblinUpgrades.resistanceCost);
            $('#lumber-resistance-cost-lumber').text(lumberGoblinUpgrades.resistanceCostLumber);

            $('#gold-speed-cost').text(goldGoblinUpgrades.speedCost);
            $('#gold-carry-cost').text(goldGoblinUpgrades.carryCost);
            $('#gold-resistance-cost').text(goldGoblinUpgrades.resistanceCost);
            $('#gold-resistance-cost-gold').text(goldGoblinUpgrades.resistanceCostGold);

            $('#lumber-goblin-cost').text(lumberGoblinCost);
            $('#gold-goblin-cost').text(goldGoblinCost);

            // Remove all goblin elements
            $('.goblin').remove();

            // Clear enemy interval and remove enemies
            clearTimeout(enemyInterval);
            enemies.forEach(e => {
                e.element.stop(true, true);
                e.element.remove();
                if (e.attackTimeout) {
                    clearTimeout(e.attackTimeout);
                }
            });
            enemies = [];

            // Reset enemy spawn timing variables
            nextEnemySpawnTime = null;
            timeRemainingToNextEnemy = 0;

            updateButtons();

            // Initialize goblins again
            initGoblins();
        }

        // Initialize Game
        $(document).ready(() => {
            initGoblins();
            updateButtons();

            // Warn user if they try to leave the page during the game
            window.onbeforeunload = function() {
                if (gameRunning) {
                    return 'Are you sure you want to leave the game? Your progress will be lost.';
                }
            };

            // Handle clicks on links to prompt the user
            $(document).on('click', 'a', function(event) {
                if (gameRunning) {
                    let confirmLeave = confirm('Are you sure you want to leave the game? Your progress will be lost.');
                    if (!confirmLeave) {
                        event.preventDefault();
                    }
                }
            });
        });

        function updateLevelDisplays() {
            let maxLevel = rocketLevel * 5;

            // Lumber Goblin Upgrades
            $('#lumber-speed-level').text(`${lumberGoblinUpgrades.speedLevel}/${maxLevel}`);
            $('#lumber-carry-level').text(`${lumberGoblinUpgrades.carryLevel}/${maxLevel}`);
            $('#lumber-resistance-level').text(`${lumberGoblinUpgrades.resistanceLevel}/${maxLevel}`);

            // Gold Goblin Upgrades
            $('#gold-speed-level').text(`${goldGoblinUpgrades.speedLevel}/${maxLevel}`);
            $('#gold-carry-level').text(`${goldGoblinUpgrades.carryLevel}/${maxLevel}`);
            $('#gold-resistance-level').text(`${goldGoblinUpgrades.resistanceLevel}/${maxLevel}`);
        }

        function handleGoblinDeath(goblinData) {
            goblinData.isDead = true;
            goblinData.isMoving = false;
            goblinData.element.stop(true, true); // Stop all animations
            goblinData.element.hide(); // Hide the goblin from the map

            updateButtons(); // Update buttons and counts

            // Check if all goblins are dead
            let allAliveGoblins = lumberGoblins.concat(goldGoblins).filter(g => !g.isDead);
            if (allAliveGoblins.length === 0) {
                endGame();
            }
        }

        let displayedScore = 0;

        function updateScoreDisplay() {
            $('#score-count').stop(true, true);

            // Start from displayedScore or score
            displayedScore = parseInt($('#score-count').text()) || 0;

            $({ scoreValue: displayedScore }).animate({ scoreValue: score }, {
                duration: 500,
                easing: 'swing',
                step: function () {
                    $('#score-count').text(Math.round(this.scoreValue));
                },
                complete: function () {
                    displayedScore = score;
                }
            });
        }

        function showMessage(message) {
            const messageDiv = $('<div class="text-center bg-tertiary text-white p-4 rounded" role="alert"></div>').text(message);
            const messageContainer = $('#message-container');

            messageContainer.html(messageDiv); // Add the new message
            messageContainer.fadeIn(500).delay(1500).fadeOut(500, function () {
                $(this).empty(); // Clear the content after fading out
            });
        }

    </script>
@endpush
