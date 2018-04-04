var currentMon = 1;
var atkChoice = 1;

var npcMon = 1;
var npcAtk = 1;
var turn = 'player';
var action = 0;

var pAction;
var eAction;

var typeSpeed = 50;
var typeTimeout = 1500;

var pMonMods = { 'atk': 1, 'def': 1, 'sAtk': 1, 'sDef': 1, 'speed': 1, 'acc': 1, 'crit': 1 };
var nMonMods = { 'atk': 1, 'def': 1, 'sAtk': 1, 'sDef': 1, 'speed': 1, 'acc': 1, 'crit': 1 };

var critMod = 2;

document.ready = initialize();

function initialize() {
    $('#enemy-mon-portrait').attr('src', nMons[1]['imgPath']);
    $('#player-mon-portrait').attr('src', pMons[1]['imgPath']);
    $('#enemy-name').html(nMons[npcMon]['name']);
    $('#player-name').html(pMons[currentMon]['name']);
    $('#enemy-health').attr('aria-valuenow', nMons[1]['cHp']);
    $('#enemy-health').attr('aria-valuemax', nMons[1]['hp']);
    $('#player-health').attr('aria-valuenow', pMons[1]['cHp']);
    $('#player-health').attr('aria-valuemax', pMons[1]['hp']);

    $('#atk-btn').click(function() {
        $('#battle-command-container').fadeOut(200, "swing", function() {
            $('#attack-container').fadeIn(200, "swing");
        });
    });

    $('#back-btn').click(function() {
        $('#attack-container').fadeOut(200, "swing", function() {
            $('#battle-command-container').fadeIn(200, "swing");
        });
    });

    $('#switch-btn').click(function() {
        // function to switch mons
    });

    $('#inv-btn').click(function() {
        // function to access inventory
    });

    $('#sur-btn').click(function() {
        // function to surrender the fight
    });

    statusCheck();
    populatePlayerAttacks();
    startRound();
}

function startRound() {
    speedCheck();
    $('#text-container').hide();
    $('#attack-container').hide();
    $('#battle-command-container').show();
}

function speedCheck() {
    if ((pMons[currentMon]['speed'] * pMonMods['speed']) < (nMons[npcMon]['speed'] * nMonMods['speed'])) {
        turn = 'enemy';
    } else if ((pMons[currentMon]['speed'] * pMonMods['speed']) > (nMons[npcMon]['speed'] * nMonMods['speed'])) {
        turn = 'player';
    } else if ((pMons[currentMon]['speed'] * pMonMods['speed']) == (nMons[npcMon]['speed'] * nMonMods['speed'])) {
        whoseTurn();
    }
}

function whoseTurn() {
    var rand = Math.floor(Math.random() * 2);
    if (rand == 0) {
        turn = 'enemy'
    } else if (rand == 1) {
        turn = 'player';
    }
}

function statusCheck() {
    if (nMons[npcMon]['status'] == 'normal') {
        $('#enemy-status').text('-');
    } else {
        $('#enemy-status').text(nMons[npcMon]['status']);
    }
    if (pMons[currentMon]['status'] == 'normal') {
        $('#player-status').text('-');
    } else {
        $('#player-status').text(pMons[currentMon]['status']);
    }
}

function populatePlayerAttacks() {
    $('#atk-1').html(pMons[currentMon]['attacks'][1]['name']);
    $('#atk-1').click(function() {
        atkClick(1);
    });
    if (pMons[currentMon]['attacks'][2]['name'] == null) {
        $('#atk-2').html('-');
        $('#atk-2').prop("disabled", true);
    } else {
        $('#atk-2').html(pMons[currentMon]['attacks'][2]['name']);
        $('#atk-2').prop("disabled", false);
        $('#atk-2').click(function() {
            atkClick(2);
        });
    }
    if (pMons[currentMon]['attacks'][3] == null) {
        $('#atk-3').html('-');
        $('#atk-3').prop("disabled", true);
    } else {
        $('#atk-3').html(pMons[currentMon]['attacks'][3]['name']);
        $('#atk-3').prop("disabled", false);
        $('#atk-3').click(function() {
            atkClick(3);
        });
    }
    if (pMons[currentMon]['attacks'][4] == null) {
        $('#atk-4').html('-');
        $('#atk-4').prop("disabled", true);
    } else {
        $('#atk-4').html(pMons[currentMon]['attacks'][4]['name']);
        $('#atk-4').prop("disabled", false);
        $('#atk-4').click(function() {
            atkClick(4);
        });
    }
}

function startTurn() {
    $('#text-container').show();
    if (turn == 'player') {
        playerAction(pAction);
    } else if (turn == 'enemy') {
        enemyAction();
    }
}

function swapTurn() {
    if (turn == 'player') {
        turn = 'enemy'
    } else if (turn == 'enemy') {
        turn = 'player'
    }
    if (action == 0) {
        action++;
        startTurn();
    } else {
        action = 0;
        startRound();
    }
}

function atkClick(num) {
    $('#attack-container').hide();
    atkChoice = num;
    pAction = 'attack';
    startTurn();
}

function playerAction(action) {
    // will add conditions here for later options...
    if (action == 'attack') {
        attack(atkChoice);
    }
}

function enemyAction() {
    var choice = 1;
    // need to determine AI for action choice here
    attack(choice);
}

function battleWriter(text) {
    document.getElementById('message').innerHTML = "";
    $('#text-container').show();
    var i = 0;
    var typeEffect = setInterval(function() {
        if (i < text.length) {
            document.getElementById('message').innerHTML += text.charAt(i);
            i++;
        } else {
            clearInterval(typeEffect);
        }
    }, typeSpeed);
}

function attack(atkNum) {
    if (turn == 'player') {
        var atkMonArr = pMons;
        var atkMonNum = currentMon;
        var atkMonMod = pMonMods;
        var defMonArr = nMons;
        var defMonNum = npcMon;
        var defMonMod = nMonMods;
        var bar = '#enemy-health';
    } else if (turn == 'enemy') {
        var atkMonArr = nMons;
        var atkMonNum = npcMon;
        var atkMonMod = nMonMods;
        var defMonArr = pMons;
        var defMonNum = currentMon;
        var defMonMod = pMonMods;
        var bar = '#player-health';
    }
    var txt = atkMonArr[atkMonNum]['name'] + " used " + atkMonArr[atkMonNum]['attacks'][atkNum]['name'] + "!";
    battleWriter(txt);
    setTimeout(function() {
        var miss = Math.floor(Math.random() * 100);
        if (miss <= (atkMonArr[atkMonNum]['attacks'][atkMonNum]['acc'] * atkMonMod['acc'])) {
            if (atkMonArr[atkMonNum]['attacks'][atkNum]['special'] == 0) {
                var dmg = Math.round(((atkMonArr[atkMonNum]['atk'] * atkMonMod['atk']) / (defMonArr[defMonNum]['def'] * defMonMod['def'])) * atkMonArr[atkMonNum]['attacks'][atkNum]['dmg']);
            } else if (atkMonArr[atkMonNum]['attacks'][atkNum]['special'] == 1) {
                var dmg = Math.round(((atkMonArr[atkMonNum]['sAtk'] * atkMonMod['sAtk']) / (defMonArr[defMonNum]['sDef'] * defMonMod['sDef'])) * atkMonArr[atkMonNum]['attacks'][atkNum]['dmg']);
            }
            var crit = Math.floor(Math.random() * 100);
            if (crit >= (atkMonArr[atkMonNum]['attacks'][atkNum]['crit'] * atkMonMod['crit'])) {
                decreaseHealth(dmg, bar);
            } else {
                txt = "Critical hit!"
                battleWriter(txt);
                setTimeout(function() {
                    decreaseHealth(dmg * critMod, bar);
                }, typeTimeout)
            }
        } else {
            txt = atkMonArr[atkMonNum]['name'] + " missed!";
            battleWriter(txt);
            setTimeout(function() {
                swapTurn();
            }, typeTimeout)
        }
    }, typeTimeout);
}

function decreaseHealth(dmg, bar) {
    var valNow = $(bar).attr('aria-valuenow');
    var maxVal = $(bar).attr('aria-valuemax');
    var val = valNow - dmg;
    if (val < 0) {
        val = 0;
    }
    var barW = Math.round((val / maxVal) * 100);
    var w = "width:" + barW + "%";
    $(bar).attr('style', w);
    $(bar).attr('aria-valuenow', val);
    setTimeout(swapTurn, typeTimeout);
}

function ko() {
    console.log("Knock out.");
}