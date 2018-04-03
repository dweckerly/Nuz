var currentMon = 1;
var atkChoice = 1;

var npcMon = 1;
var npcAtk = 1;
var turn = 'player';
var sameSpd = 0;

var typeSpeed = 50;

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
    speedCheck();
    startTurn();
}

function speedCheck() {
    if (pMons[currentMon]['speed'] < nMons[npcMon]['speed']) {
        turn = 'enemy';
    } else if (pMons[currentMon]['speed'] > nMons[npcMon]['speed']) {
        turn = 'player';
    } else if (pMons[currentMon]['speed'] == nMons[npcMon]['speed']) {
        sameSpd = 1;
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

function startTurn() {
    if (turn == 'player') {
        console.log(pMons[currentMon]['name']);
        $('#text-container').hide();
        $('#battle-command-container').show();
    } else if (turn == 'enemy') {
        console.log(nMons[npcMon]['name']);
        $('#battle-command-container').hide();
        enemyAction();
    }
}

function swapTurn() {
    if (turn == 'player') {
        turn = 'enemy';
        console.log(turn);
        startTurn();
    } else if (turn == 'enemy') {
        turn = 'player';
        console.log(turn);
        startTurn();
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
    $('#attack-container').hide();
    $('#atk-1').html(pMons[currentMon]['attacks'][1]['name']);
    $('#atk-1').click(function() {
        $('#attack-container').hide();
        atkChoice = 1;
        playerAtk();
    });
    if (pMons[currentMon]['attacks'][2]['name'] == null) {
        $('#atk-2').html('-');
        $('#atk-2').prop("disabled", true);
    } else {
        $('#atk-2').html(pMons[currentMon]['attacks'][2]['name']);
        $('#atk-2').prop("disabled", false);
        $('#atk-2').click(function() {
            $('#attack-container').hide();
            atkChoice = 2;
            playerAtk();
        });
    }
    if (pMons[currentMon]['attacks'][3] == null) {
        $('#atk-3').html('-');
        $('#atk-3').prop("disabled", true);
    } else {
        $('#atk-3').html(pMons[currentMon]['attacks'][3]['name']);
        $('#atk-3').prop("disabled", false);
        $('#atk-3').click(function() {
            $('#attack-container').hide();
            atkChoice = 3;
            playerAtk();
        });
    }
    if (pMons[currentMon]['attacks'][4] == null) {
        $('#atk-4').html('-');
        $('#atk-4').prop("disabled", true);
    } else {
        $('#atk-4').html(pMons[currentMon]['attacks'][4]['name']);
        $('#atk-4').prop("disabled", false);
        $('#atk-4').click(function() {
            $('#attack-container').hide();
            atkChoice = 4;
            playerAtk();
        });
    }
}

function enemyAction() {
    var choice = 1;
    // need to determine AI for action choice here
    enemyAtk(choice);
}

function battleWriter(text, id) {
    document.getElementById(id).innerHTML = "";
    $('#text-container').show();
    var i = 0;
    var typeEffect = setInterval(function() {
        if (i < text.length) {
            document.getElementById(id).innerHTML += text.charAt(i);
            i++;
        } else {
            clearInterval(typeEffect);
        }
    }, typeSpeed);
}

function enemyAtk(choice) {
    var miss = Math.floor(Math.random() * 100);
    if (miss <= nMons[npcMon]['attacks'][choice]['acc']) {
        // hit
        if (nMons[npcMon]['attacks'][choice]['special'] == 0) {
            var dmg = Math.round((nMons[npcMon]['atk'] / pMons[currentMon]['def']) * nMons[npcMon]['attacks'][choice]['dmg']);
        } else if (pMons[currentMon]['attacks'][atkChoice]['special'] == 1) {
            var dmg = Math.round((nMons[npcMon]['sAtk'] / pMons[currentMon]['sDef']) * nMons[npcMon]['attacks'][choice]['dmg']);
        }
        var crit = Math.floor(Math.random() * 100);
        if (crit < nMons[npcMon]['attacks'][choice]['crit']) {
            dmg = dmg * 2;
            var txt = nMons[npcMon]['name'] + " used " + nMons[npcMon]['attacks'][choice]['name'] + "! Critical hit!";
        } else {
            var txt = nMons[npcMon]['name'] + " used " + nMons[npcMon]['attacks'][choice]['name'] + "!";
        }
        console.log(dmg);
        var txt = nMons[npcMon]['name'] + " used " + nMons[npcMon]['attacks'][choice]['name'] + "!";
        battleWriter(txt, 'message');
        setTimeout(function() { decreaseHealth(dmg, '#player-health'); }, 1000)
    } else {
        // miss
        // need to broadcast a message here that there was a miss...
        console.log("miss");
        var txt = nMons[npcMon]['name'] + " missed!";
        battleWriter(txt, 'message');
        setTimeout(swapTurn, 2000)
    }
}

function playerAtk() {
    var miss = Math.floor(Math.random() * 100);
    if (miss <= pMons[currentMon]['attacks'][atkChoice]['acc']) {
        // hit
        if (pMons[currentMon]['attacks'][atkChoice]['special'] == 0) {
            var dmg = Math.round((pMons[currentMon]['atk'] / nMons[npcMon]['def']) * pMons[currentMon]['attacks'][atkChoice]['dmg']);
        } else if (pMons[currentMon]['attacks'][atkChoice]['special'] == 1) {
            var dmg = Math.round((pMons[currentMon]['sAtk'] / nMons[npcMon]['sDef']) * pMons[currentMon]['attacks'][atkChoice]['dmg']);
        }
        var crit = Math.floor(Math.random() * 100);
        if (crit < pMons[currentMon]['attacks'][atkChoice]['crit']) {
            dmg = dmg * 2;
            var txt = pMons[currentMon]['name'] + " used " + pMons[currentMon]['attacks'][atkChoice]['name'] + "! Critical hit!";
        } else {
            var txt = pMons[currentMon]['name'] + " used " + pMons[currentMon]['attacks'][atkChoice]['name'] + "!";
        }
        console.log(dmg);
        battleWriter(txt, 'message');
        setTimeout(function() { decreaseHealth(dmg, '#enemy-health'); }, 1000)
    } else {
        // miss
        // need to broadcast a message here that there was a miss...
        console.log("miss");
        var txt = pMons[currentMon]['name'] + " missed!";
        battleWriter(txt, 'message');
        setTimeout(swapTurn, 2000)
    }
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
    swapTurn();
}

function ko() {
    console.log("Knock out.");
}