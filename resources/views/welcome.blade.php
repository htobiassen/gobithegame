@extends('layouts.web')
@section('head')
@endsection
@section('content')
    @include('web.partials.navbar')
    <div class="container">
        <!-- Start Screen Overlay -->
        <div class="card card-body mt-3">
            <div id="start-screen" class="overlay">
                <div class="overlay-content">
                    <h2 id="game-over-message"></h2>
                    <button id="start-game" class="btn btn-tertiary btn-lg">Start Game</button>
                </div>
            </div>
            <div class="row">
                <!-- Map Section -->
                <div class="col-md-8 position-relative">
                    <div class="map-section">
                        <div id="forest" class="map-item forest">Forest</div>
                        <div id="mine" class="map-item mine">Gold Mine</div>
                        <div id="rocket" class="map-item rocket">🚀</div>
                        <!-- Goblins will be dynamically added here -->
                    </div>
                    <!-- Resources Display -->
                    <div class="resources-display">
                        💰 <span id="gold-count">0</span> &nbsp;&nbsp; 🌲 <span id="lumber-count">0</span>
                    </div>
                </div>
                <!-- Upgrade Menu -->
                <div class="col-md-4">
                    <!-- Upgrades Table -->
                    <table class="table table-sm small table-secondary table-striped">
                        <thead>
                        <tr>
                            <th>Skill</th>
                            <th>Level</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Lumber Goblin Upgrades -->
                        <tr>
                            <td colspan="4" class="table-success text-center">Lumber Gobi's</td>
                        </tr>
                        <tr>
                            <td>Number</td>
                            <td><span id="lumber-goblin-count">1</span></td>
                            <td><span id="lumber-goblin-cost">50</span> 💰</td>
                            <td><button class="btn btn-sm btn-success" id="buy-lumber-goblin">Buy</button></td>
                        </tr>
                        <tr>
                            <td>Speed</td>
                            <td><span id="lumber-speed-level">1</span></td>
                            <td><span id="lumber-speed-cost">20</span> 💰</td>
                            <td><button class="btn btn-sm btn-primary" id="upgrade-lumber-speed">Upgrade</button></td>
                        </tr>
                        <tr>
                            <td>Carry</td>
                            <td><span id="lumber-carry-level">1</span></td>
                            <td><span id="lumber-carry-cost">20</span> 💰</td>
                            <td><button class="btn btn-sm btn-primary" id="upgrade-lumber-carry">Upgrade</button></td>
                        </tr>
                        <tr>
                            <td>Resistance</td>
                            <td><span id="lumber-resistance-level">1</span></td>
                            <td><span id="lumber-resistance-cost">10</span> 💰 <span id="lumber-resistance-cost-lumber">10</span> 🌲</td>
                            <td><button class="btn btn-sm btn-primary" id="upgrade-lumber-resistance">Upgrade</button></td>
                        </tr>
                        <!-- Gold Goblin Upgrades -->
                        <tr>
                            <td colspan="4" class="table-warning text-center">Gold Gobi's</td>
                        </tr>
                        <tr>
                            <td>Number</td>
                            <td><span id="gold-goblin-count">1</span></td>
                            <td><span id="gold-goblin-cost">50</span> 🌲</td>
                            <td><button class="btn btn-sm btn-success" id="buy-gold-goblin">Buy</button></td>
                        </tr>
                        <tr>
                            <td>Speed</td>
                            <td><span id="gold-speed-level">1</span></td>
                            <td><span id="gold-speed-cost">20</span> 🌲</td>
                            <td><button class="btn btn-sm btn-primary" id="upgrade-gold-speed">Upgrade</button></td>
                        </tr>
                        <tr>
                            <td>Carry</td>
                            <td><span id="gold-carry-level">1</span></td>
                            <td><span id="gold-carry-cost">20</span> 🌲</td>
                            <td><button class="btn btn-sm btn-primary" id="upgrade-gold-carry">Upgrade</button></td>
                        </tr>
                        <tr>
                            <td>Resistance</td>
                            <td><span id="gold-resistance-level">1</span></td>
                            <td><span id="gold-resistance-cost">10</span> 🌲 <span id="gold-resistance-cost-gold">10</span> 💰</td>
                            <td><button class="btn btn-sm btn-primary" id="upgrade-gold-resistance">Upgrade</button></td>
                        </tr>
                        <!-- Rocket Upgrade -->
                        <tr>
                            <td colspan="4" class="table-danger text-center">Rocket Progress</td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td><span id="rocket-level">1</span></td>
                            <td><span id="rocket-cost-lumber">100</span> 🌲 <span id="rocket-cost-gold">100</span> 💰</td>
                            <td><button class="btn btn-sm btn-danger" id="upgrade-rocket">Upgrade</button></td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- Control Buttons -->
                    <div class="mt-4 text-center">
                        <button id="pause-game" class="btn btn-tertiary" style="display: none;">Pause Game</button>
                        <button id="resume-game" class="btn btn-primary" style="display: none;">Resume Game</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .map-section {
        background-color: #e0f7fa;
        border: 2px solid #00796b;
        height: 400px;
        position: relative;
        overflow: hidden;
    }

    .map-item {
        position: absolute;
        text-align: center;
        font-weight: bold;
        color: #fff;
        padding: 10px;
        border-radius: 50%;
        user-select: none;
    }

    .forest {
        background-color: #388e3c;
        top: 10%;
        left: 10%;
    }

    .mine {
        background-color: #ffca28;
        top: 10%;
        right: 10%;
    }

    .rocket {
        background-color: #f44336;
        bottom: 10%;
        left: 50%;
        transform: translateX(-50%);
    }

    .goblin {
        position: absolute;
        width: 30px;
        height: 30px;
        font-size: 20px;
        text-align: center;
        user-select: none;
    }

    .collecting {
        animation: vibrate 0.3s infinite;
    }

    @keyframes vibrate {
        0% { transform: translate(0, 0); }
        25% { transform: translate(-1px, 1px); }
        50% { transform: translate(1px, -1px); }
        75% { transform: translate(-1px, -1px); }
        100% { transform: translate(1px, 1px); }
    }

    .delivery-counter {
        position: absolute;
        font-size: 16px;
        color: #000;
        font-weight: bold;
    }

    button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Enemy Styles */
    .enemy {
        position: absolute;
        width: 30px;
        height: 30px;
        font-size: 20px;
        text-align: center;
        user-select: none;
    }

    /* Overlay Styles */
    .overlay {
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
    }

    .overlay-content {
        text-align: center;
        color: #fff;
    }

    .overlay-content h2 {
        margin-bottom: 20px;
    }

    /* Resources Display Styles */
    .resources-display {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 14px;
        font-weight: bold;
    }

    /* Health Bar Styles */
    .goblin-hp-bar-container {
        position: absolute;
        bottom: 100%; /* Position above the goblin */
        left: 50%;
        transform: translateX(-50%);
        width: 30px; /* Width of the health bar */
        height: 5px; /* Height of the health bar */
        background-color: #ccc; /* Background color for the container */
        border: 1px solid #000;
        border-radius: 2px;
        overflow: hidden;
    }

    .goblin-hp-bar {
        height: 100%;
        width: 100%; /* Initially full */
        background-color: red;
    }
</style>
@push('scripts')
    <script>
        // Game State
        let resources = { lumber: 0, gold: 0 };
        let gameRunning = false;

        // Goblin Data
        let lumberGoblins = [];
        let goldGoblins = [];

        // Goblin Upgrades
        let lumberGoblinUpgrades = {
            speedLevel: 1,
            carryLevel: 1,
            resistanceLevel: 1,
            speedCost: 20,
            carryCost: 20,
            resistanceCost: 10,
            resistanceCostLumber: 10
        };

        let goldGoblinUpgrades = {
            speedLevel: 1,
            carryLevel: 1,
            resistanceLevel: 1,
            speedCost: 20,
            carryCost: 20,
            resistanceCost: 10,
            resistanceCostGold: 10
        };

        // Goblin Purchase Costs
        let lumberGoblinCost = 50;
        let goldGoblinCost = 50;

        // Rocket Upgrade
        let rocketLevel = 1;
        let rocketCost = {
            lumber: 100,
            gold: 100
        };

        // Max Goblins
        const maxGoblins = 3;

        // Enemy Variables
        let enemyInterval;

        // Initialize Goblins
        function initGoblins() {
            addLumberGoblin();
            addGoldGoblin();
        }

        // Add Goblin Functions
        function addLumberGoblin() {
            if (lumberGoblins.length >= maxGoblins) {
                alert('Maximum lumber goblins reached!');
                return;
            }
            const goblinId = 'lumber-goblin-' + (lumberGoblins.length + 1);
            const goblin = $('<div class="goblin lumber-goblin" id="' + goblinId + '">🪓</div>');
            const goblinData = {
                id: goblinId,
                element: goblin,
                resourceType: 'lumber',
                position: { top: '10%', left: '10%' },
                isMoving: false,
                direction: 'toResource',
                hp: 100,
                maxHp: 100
            };
            // Create health bar
            const hpBarContainer = $('<div class="goblin-hp-bar-container"></div>');
            const hpBar = $('<div class="goblin-hp-bar" id="' + goblinId + '-hp-bar"></div>');
            hpBarContainer.append(hpBar);
            goblin.append(hpBarContainer);
            $('.map-section').append(goblin);
            lumberGoblins.push(goblinData);
            $('#lumber-goblin-count').text(lumberGoblins.length);
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
            const goblin = $('<div class="goblin gold-goblin" id="' + goblinId + '">⛏️</div>');
            const goblinData = {
                id: goblinId,
                element: goblin,
                resourceType: 'gold',
                position: { top: '10%', left: '80%' },
                isMoving: false,
                direction: 'toResource',
                hp: 100,
                maxHp: 100
            };
            // Create health bar
            const hpBarContainer = $('<div class="goblin-hp-bar-container"></div>');
            const hpBar = $('<div class="goblin-hp-bar" id="' + goblinId + '-hp-bar"></div>');
            hpBarContainer.append(hpBar);
            goblin.append(hpBarContainer);
            $('.map-section').append(goblin);
            goldGoblins.push(goblinData);
            $('#gold-goblin-count').text(goldGoblins.length);
            if (gameRunning) {
                startGoblin(goblinData);
            }
        }

        // Start Goblin Movement
        function startGoblin(goblinData) {
            if (goblinData.isMoving) return; // Prevent multiple loops
            goblinData.isMoving = true;

            const goblin = goblinData.element;
            const resourceType = goblinData.resourceType;

            // Positions in pixels
            const resourceElement = resourceType === 'lumber' ? $('#forest') : $('#mine');
            const resourcePos = resourceElement.position();
            const rocketPos = $('#rocket').position();

            function goblinLoop() {
                if (!gameRunning || goblinData.hp <= 0) {
                    goblinData.isMoving = false;
                    return;
                }

                let upgrades = resourceType === 'lumber' ? lumberGoblinUpgrades : goldGoblinUpgrades;
                // Adjust speed formula to prevent goblins from becoming too fast
                let baseSpeed = Math.max(3000 / (1 + 0.05 * upgrades.speedLevel), 1000);
                let carryAmount = upgrades.carryLevel;

                let startPos = goblin.position();
                let targetPos;

                if (goblinData.direction === 'toResource') {
                    targetPos = resourcePos;
                } else if (goblinData.direction === 'toRocket') {
                    targetPos = rocketPos;
                }

                // Calculate distance between current position and target
                let dx = targetPos.left - startPos.left;
                let dy = targetPos.top - startPos.top;
                let distance = Math.sqrt(dx * dx + dy * dy);

                // Calculate total distance between resource and rocket
                let totalDx = resourcePos.left - rocketPos.left;
                let totalDy = resourcePos.top - rocketPos.top;
                let totalDistance = Math.sqrt(totalDx * totalDx + totalDy * totalDy);

                // Adjust speed based on remaining distance
                let adjustedSpeed = baseSpeed * (distance / totalDistance);

                // Start moving
                goblin.animate({
                    left: targetPos.left,
                    top: targetPos.top
                }, adjustedSpeed, 'linear', () => {
                    if (goblinData.direction === 'toResource') {
                        // Start collecting immediately
                        goblin.addClass('collecting');
                        setTimeout(() => {
                            goblin.removeClass('collecting');
                            goblinData.direction = 'toRocket';
                            goblinLoop(); // Continue loop after collecting
                        }, 500);
                    } else if (goblinData.direction === 'toRocket') {
                        // Deliver resources
                        resources[resourceType] += carryAmount;
                        $('#' + resourceType + '-count').text(resources[resourceType]);
                        displayCounter(goblin, '+' + carryAmount);
                        updateButtons();
                        goblinData.direction = 'toResource';
                        goblinLoop(); // Continue loop after delivering
                    }
                });
            }

            goblinLoop();
        }

        // Display Counter Animation
        function displayCounter(goblin, text) {
            const counter = $('<div class="delivery-counter"></div>').text(text);
            const offset = goblin.offset();
            counter.css({ top: offset.top - 20, left: offset.left + 20 });
            $('body').append(counter);
            counter.animate({ top: '-=20', opacity: 0 }, 1000, () => counter.remove());
        }

        // Start Game
        $('#start-game').click(() => {
            gameRunning = true;
            $('#start-screen').hide();
            $('#pause-game').show();
            lumberGoblins.forEach(g => startGoblin(g));
            goldGoblins.forEach(g => startGoblin(g));
            startEnemySpawn();
            updateButtons();
        });

        // Pause Game
        $('#pause-game').click(() => {
            gameRunning = false;
            $('#pause-game').hide();
            $('#resume-game').show();
            // Pause animations
            lumberGoblins.forEach(g => {
                g.element.stop(true);
                g.isMoving = false;
            });
            goldGoblins.forEach(g => {
                g.element.stop(true);
                g.isMoving = false;
            });
            // Stop enemy spawning
            clearInterval(enemyInterval);
            $('.enemy').remove();
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
            startEnemySpawn();
        });

        // Buy Goblins
        $('#buy-lumber-goblin').click(() => {
            if (resources.gold >= lumberGoblinCost) {
                resources.gold -= lumberGoblinCost;
                $('#gold-count').text(resources.gold);
                lumberGoblinCost = Math.floor(lumberGoblinCost * 1.3);
                $('#lumber-goblin-cost').text(lumberGoblinCost);
                addLumberGoblin();
                updateButtons();
            }
        });

        $('#buy-gold-goblin').click(() => {
            if (resources.lumber >= goldGoblinCost) {
                resources.lumber -= goldGoblinCost;
                $('#lumber-count').text(resources.lumber);
                goldGoblinCost = Math.floor(goldGoblinCost * 1.3);
                $('#gold-goblin-cost').text(goldGoblinCost);
                addGoldGoblin();
                updateButtons();
            }
        });

        // Upgrade Goblins
        $('#upgrade-lumber-speed').click(() => {
            if (resources.gold >= lumberGoblinUpgrades.speedCost) {
                resources.gold -= lumberGoblinUpgrades.speedCost;
                $('#gold-count').text(resources.gold);
                lumberGoblinUpgrades.speedLevel++;
                lumberGoblinUpgrades.speedCost = Math.floor(lumberGoblinUpgrades.speedCost * 1.3);
                $('#lumber-speed-level').text(lumberGoblinUpgrades.speedLevel);
                $('#lumber-speed-cost').text(lumberGoblinUpgrades.speedCost);
                updateButtons();
            }
        });

        $('#upgrade-lumber-carry').click(() => {
            if (resources.gold >= lumberGoblinUpgrades.carryCost) {
                resources.gold -= lumberGoblinUpgrades.carryCost;
                $('#gold-count').text(resources.gold);
                lumberGoblinUpgrades.carryLevel++;
                lumberGoblinUpgrades.carryCost = Math.floor(lumberGoblinUpgrades.carryCost * 1.3);
                $('#lumber-carry-level').text(lumberGoblinUpgrades.carryLevel);
                $('#lumber-carry-cost').text(lumberGoblinUpgrades.carryCost);
                updateButtons();
            }
        });

        $('#upgrade-lumber-resistance').click(() => {
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
            }
        });

        $('#upgrade-gold-speed').click(() => {
            if (resources.lumber >= goldGoblinUpgrades.speedCost) {
                resources.lumber -= goldGoblinUpgrades.speedCost;
                $('#lumber-count').text(resources.lumber);
                goldGoblinUpgrades.speedLevel++;
                goldGoblinUpgrades.speedCost = Math.floor(goldGoblinUpgrades.speedCost * 1.3);
                $('#gold-speed-level').text(goldGoblinUpgrades.speedLevel);
                $('#gold-speed-cost').text(goldGoblinUpgrades.speedCost);
                updateButtons();
            }
        });

        $('#upgrade-gold-carry').click(() => {
            if (resources.lumber >= goldGoblinUpgrades.carryCost) {
                resources.lumber -= goldGoblinUpgrades.carryCost;
                $('#lumber-count').text(resources.lumber);
                goldGoblinUpgrades.carryLevel++;
                goldGoblinUpgrades.carryCost = Math.floor(goldGoblinUpgrades.carryCost * 1.3);
                $('#gold-carry-level').text(goldGoblinUpgrades.carryLevel);
                $('#gold-carry-cost').text(goldGoblinUpgrades.carryCost);
                updateButtons();
            }
        });

        $('#upgrade-gold-resistance').click(() => {
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
                alert('Rocket upgraded to level ' + rocketLevel + '!');
                updateButtons();
            }
        });

        // Update Buttons Based on Resources
        function updateButtons() {
            // Lumber Goblin Buttons
            $('#buy-lumber-goblin').prop('disabled', resources.gold < lumberGoblinCost || lumberGoblins.length >= maxGoblins);
            $('#upgrade-lumber-speed').prop('disabled', resources.gold < lumberGoblinUpgrades.speedCost);
            $('#upgrade-lumber-carry').prop('disabled', resources.gold < lumberGoblinUpgrades.carryCost);
            $('#upgrade-lumber-resistance').prop('disabled', resources.gold < lumberGoblinUpgrades.resistanceCost || resources.lumber < lumberGoblinUpgrades.resistanceCostLumber);

            // Gold Goblin Buttons
            $('#buy-gold-goblin').prop('disabled', resources.lumber < goldGoblinCost || goldGoblins.length >= maxGoblins);
            $('#upgrade-gold-speed').prop('disabled', resources.lumber < goldGoblinUpgrades.speedCost);
            $('#upgrade-gold-carry').prop('disabled', resources.lumber < goldGoblinUpgrades.carryCost);
            $('#upgrade-gold-resistance').prop('disabled', resources.lumber < goldGoblinUpgrades.resistanceCost || resources.gold < goldGoblinUpgrades.resistanceCostGold);

            // Rocket Upgrade Button
            $('#upgrade-rocket').prop('disabled', resources.lumber < rocketCost.lumber || resources.gold < rocketCost.gold);
        }

        // Enemy Spawn Function
        function startEnemySpawn() {
            enemyInterval = setInterval(() => {
                if (!gameRunning) return;
                spawnEnemy();
            }, 15000); // Spawn enemy every 15 seconds
        }

        function spawnEnemy() {
            const enemy = $('<div class="enemy">👾</div>');
            enemy.css({
                top: Math.random() * 80 + '%',
                left: '-50px'
            });
            $('.map-section').append(enemy);

            // Move enemy across the screen
            enemy.animate({ left: '110%' }, 8000, 'linear', () => {
                enemy.remove();
            });

            // Enemy attacks a random goblin
            setTimeout(() => {
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
            let baseDamage = 8 + (rocketLevel - 1) * 2; // Increase damage by 2 for each rocket level
            let resistanceLevel = targetGoblin.resourceType === 'lumber' ? lumberGoblinUpgrades.resistanceLevel : goldGoblinUpgrades.resistanceLevel;
            let damage = Math.max(baseDamage - resistanceLevel * 2, 5); // Minimum damage of 5

            targetGoblin.hp -= damage;

            // Update HP bar
            let hpPercent = (targetGoblin.hp / targetGoblin.maxHp) * 100;
            $('#' + targetGoblin.id + '-hp-bar').css('width', hpPercent + '%');

            // Check if goblin is dead
            if (targetGoblin.hp <= 0) {
                targetGoblin.element.remove();
                if (targetGoblin.resourceType === 'lumber') {
                    lumberGoblins = lumberGoblins.filter(g => g.id !== targetGoblin.id);
                    $('#lumber-goblin-count').text(lumberGoblins.length);
                } else {
                    goldGoblins = goldGoblins.filter(g => g.id !== targetGoblin.id);
                    $('#gold-goblin-count').text(goldGoblins.length);
                }

                // Check if all goblins are dead
                if (lumberGoblins.length === 0 && goldGoblins.length === 0) {
                    endGame();
                }
            }
        }

        // End Game Function
        function endGame() {
            gameRunning = false;
            clearInterval(enemyInterval);
            $('#pause-game').hide();
            // Display Game Over Screen
            $('#game-over-message').text('Game Over! You reached Rocket Level ' + rocketLevel + '.');
            $('#start-game').text('Restart Game');
            $('#start-screen').show();

            // Reset Game State
            resetGame();
        }

        // Reset Game State
        function resetGame() {
            // Reset variables
            resources = { lumber: 0, gold: 0 };
            lumberGoblins = [];
            goldGoblins = [];

            lumberGoblinUpgrades = {
                speedLevel: 1,
                carryLevel: 1,
                resistanceLevel: 1,
                speedCost: 20,
                carryCost: 20,
                resistanceCost: 10,
                resistanceCostLumber: 10
            };

            goldGoblinUpgrades = {
                speedLevel: 1,
                carryLevel: 1,
                resistanceLevel: 1,
                speedCost: 20,
                carryCost: 20,
                resistanceCost: 10,
                resistanceCostGold: 10
            };

            lumberGoblinCost = 50;
            goldGoblinCost = 50;

            rocketLevel = 1;
            rocketCost = {
                lumber: 100,
                gold: 100
            };

            // Update UI
            $('#lumber-count').text(resources.lumber);
            $('#gold-count').text(resources.gold);
            $('#lumber-goblin-count').text('0');
            $('#gold-goblin-count').text('0');
            $('#rocket-level').text(rocketLevel);
            $('#rocket-cost-lumber').text(rocketCost.lumber);
            $('#rocket-cost-gold').text(rocketCost.gold);

            // Remove all goblin elements
            $('.goblin').remove();

            updateButtons();

            // Initialize goblins again
            initGoblins();
        }

        // Initialize Game
        $(document).ready(() => {
            initGoblins();
            updateButtons();
        });
    </script>
@endpush
