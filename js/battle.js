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

var atkMonArr;
var atkMonNum;
var atkMonMod;
var atkNum;
var defMonArr;
var defMonNum;
var defMonMod;
var bar;

var critMod = 2;

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
        $('inventoryModal').modal();
    });

    $('#sur-btn').click(function() {
        // function to surrender the fight
    });

    statusDisplay();
    populatePlayerAttacks();
    actionSelect();
}

function statusDisplay() {
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

function actionSelect() {
    $('#text-container').hide();
    $('#attack-container').hide();
    $('#battle-command-container').show();
}

function startRound() {
    whoseTurn();
    $('#text-container').show();
    if (turn == 'player') {
        playerAction(pAction);
    } else if (turn == 'enemy') {
        enemyAction();
    }
}

function speedCheck() {
    if ((pMons[currentMon]['speed'] * pMonMods['speed']) < (nMons[npcMon]['speed'] * nMonMods['speed'])) {
        turn = 'enemy';
    } else if ((pMons[currentMon]['speed'] * pMonMods['speed']) > (nMons[npcMon]['speed'] * nMonMods['speed'])) {
        turn = 'player';
    } else if ((pMons[currentMon]['speed'] * pMonMods['speed']) == (nMons[npcMon]['speed'] * nMonMods['speed'])) {
        randTurn();
    }
}

function randTurn() {
    var rand = Math.round(Math.random());
    if (rand == 0) {
        turn = 'enemy'
    } else if (rand == 1) {
        turn = 'player';
    }
}

function whoseTurn() {
    speedCheck();
    priorityEffCheck();
}

function startTurn() {
    // will need to do an effect check here for moves with priority
    
}

function priorityEffCheck() {
    var pQuick = 0;
    var nQuick = 0;
    //check for if player mon used a prioroty attack
    if(pMons[currentMon]['attacks'][atkChoice]['priority'] > nMons[npcMon]['attacks'][npcAtk]['priority']) {
        pQuick = 1;
    } 
    // check if npc mon used a priority attack
    if(nMons[npcMon]['attacks'][npcAtk]['priority'] > pMons[currentMon]['attacks'][atkChoice]['priority']) {
        nQuick = 1;
    } 

    // swap turn if one is quick and the other is not
    if((pQuick == 1) && (nQuick == 0)) {
        turn = 'player';
    } else if ((pQuick == 0) && (nQuick == 1)) {
        turn = 'enemy';
    }
}

function swapTurn() {
    if (action == 0) {
        action++;
        if (turn == 'player') {
            turn = 'enemy'
            enemyAction();
        } else if (turn == 'enemy') {
            turn = 'player'
            playerAction(pAction);
        }
    } else {
        action = 0;
        actionSelect();
    }
}

function atkClick(num) {
    $('#attack-container').hide();
    atkChoice = num;
    pAction = 'attack';
    startRound();
}

function playerAction(action) {
    // will add conditions here for later options...
    if (action == 'attack') {
        attack();
    }
}

function enemyAction() {
    var choice = Math.floor(Math.random() * 3) + 1;
    // need to determine AI for action choice here
    npcAtk = choice
    attack();
}

function statusCheck(monArr, monNum) {
    if(monArr[monNum]['status'] != 'normal') {
        // do stuff...
        statusDisplay();
    }
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

function attack() {
    if (turn == 'player') {
        atkMonArr = pMons;
        atkMonNum = currentMon;
        atkMonMod = pMonMods;
        defMonArr = nMons;
        defMonNum = npcMon;
        defMonMod = nMonMods;
        bar = '#enemy-health';
        atkNum = atkChoice;
    } else if (turn == 'enemy') {
        atkMonArr = nMons;
        atkMonNum = npcMon;
        atkMonMod = nMonMods;
        defMonArr = pMons;
        defMonNum = currentMon;
        defMonMod = pMonMods;
        bar = '#player-health';
        atkNum = npcAtk;
    }
    var txt = atkMonArr[atkMonNum]['name'] + " used " + atkMonArr[atkMonNum]['attacks'][atkNum]['name'] + "!";
    battleWriter(txt);

    setTimeout(function() {

        var miss = Math.floor(Math.random() * 100);
        if (miss <= (atkMonArr[atkMonNum]['attacks'][atkMonNum]['acc'] * atkMonMod['acc'])) {
            
            /* * * * * * * * * * * * * * * * * * */
            /* need to do type checking for the attacks... 
            /* Once I figure out how the type system works...
            /* doing it here in the case of invulnerability
            /* var dmgMod;
            /* dmgMod = typeCheck(dmg);
            /* * * * * * * * * * * * * * * * * * */
            
            // check for attacks that don't do damage
            if(atkMonArr[atkMonNum]['attacks'][atkNum]['dmg'] == 0) {
                setTimeout(effectCheck, typeTimeout);
            } else {
                // check for attacks that do damage
                if (atkMonArr[atkMonNum]['attacks'][atkNum]['special'] == 0) {
                    var dmg = Math.round(((atkMonArr[atkMonNum]['atk'] * atkMonMod['atk']) / (defMonArr[defMonNum]['def'] * defMonMod['def'])) * atkMonArr[atkMonNum]['attacks'][atkNum]['dmg']);
                } else if (atkMonArr[atkMonNum]['attacks'][atkNum]['special'] == 1) {
                    var dmg = Math.round(((atkMonArr[atkMonNum]['sAtk'] * atkMonMod['sAtk']) / (defMonArr[defMonNum]['sDef'] * defMonMod['sDef'])) * atkMonArr[atkMonNum]['attacks'][atkNum]['dmg']);
                }
                var crit = Math.floor(Math.random() * 100);
                if(dmg < 1) {
                    dmg = 1;
                }
                if (crit >= (atkMonArr[atkMonNum]['attacks'][atkNum]['crit'] * atkMonMod['crit'])) {
                    decreaseHealth(dmg, bar);
                } else {
                    txt = "Critical hit!"
                    battleWriter(txt);
                    setTimeout(function() {
                        decreaseHealth(dmg * critMod, bar);
                    }, typeTimeout)
                }
            }
        } else {
            if(atkMonArr[atkMonNum]['attacks'][atkNum]['dmg'] == 0) {
                txt = "It failed!";
            } else {
                txt = atkMonArr[atkMonNum]['name'] + " missed!";
            }
            battleWriter(txt);
            setTimeout(function() {
                swapTurn();
            }, typeTimeout);
        }
    }, typeTimeout);
}

function effectCheck(){
    if(atkMonArr[atkMonNum]['attacks'][atkNum]['e1'] == '') {
        // no effects, call swapTurn without a timeout
        console.log('no effect')
        swapTurn();
    } else {
        var eff = [atkMonArr[atkMonNum]['attacks'][atkNum]['e1']];
        console.log(eff);
        if(atkMonArr[atkMonNum]['attacks'][atkNum]['e2'] != '') {
            eff.push(atkMonArr[atkMonNum]['attacks'][atkNum]['e2']);
        }  
        if(atkMonArr[atkMonNum]['attacks'][atkNum]['e3'] != '') {
            eff.push(atkMonArr[atkMonNum]['attacks'][atkNum]['e3']);
        }
        // pass effect array, set interval to play each effect similar to typeWriter
        applyEffects(eff);
    }
}

function applyEffects(eff) {
    var i = 0;
    var txt = "";
    var effects = setInterval( function() {
        if(i < eff.length) {
            console.log(eff[i]);
            var effParse = String(eff[i]).split('-');

            // check for buff or nerf
            if(effParse[0] == 'increase') {
                if(effParse[2] == 'self') {
                    if(atkMonMod[effParse[1]] >= 2.2) {
                        //can't increase anymore
                        txt = atkMonArr[atkMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " can't go any higher!";
                    } else {
                        atkMonMod[effParse[1]] += (0.2 * effParse[3]);
                        if(atkMonMod[effParse[1]] >= 2.2) {
                            atkMonMod[effParse[1]] = 2.2;
                        }
                        txt = atkMonArr[atkMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " increased!";
                    }
                } else if(effParse[2] == 'target') {
                    if(defMonMod[effParse[1]] >= 2.2) {
                        //can't increase anymore
                        txt = defMonArr[defMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " can't go any higher!";
                    } else {
                        defMonMod[effParse[1]] += (0.2 * effParse[3]);
                        if(defMonMod[effParse[1]] >= 2.2) {
                            defMonMod[effParse[1]] = 2.2;
                        }
                        txt = defMonArr[defMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " increased!";
                    }
                }
            } else if (effParse[0] == 'decrease') {
                if(effParse[2] == 'self') {
                    if(atkMonMod[effParse[1]] <= 0.4) {
                        //can't increase anymore
                        txt = atkMonArr[atkMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " can't go any lower!";
                    } else {
                        atkMonMod[effParse[1]] -= (0.1 * effParse[3]);
                        if(atkMonMod[effParse[1]] < 0.4) {
                            atkMonMod[effParse[1]] = 0.4;
                        }
                        txt = atkMonArr[atkMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " decreased!";
                    }
                } else if(effParse[2] == 'target') {
                    if(defMonMod[effParse[1]] <= 0.4) {
                        //can't increase anymore
                        txt = defMonArr[defMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " can't go any lower!";
                    } else {
                        defMonMod[effParse[1]] -= (0.1 * effParse[3]);
                        if(defMonMod[effParse[1]] < 0.4) {
                            defMonMod[effParse[1]] = 0.4;
                        }
                        txt = defMonArr[defMonNum]['name'] + "'s " + effParse[1].toUpperCase() + " decreased!";
                    }
                }
            }

            // check for recoil
            if(effParse[0] == 'recoil') {
                var dmg = Math.round(atkMonArr[atkMonNum]['attacks'][atkNum]['dmg'] * (effParse[1] / 100));
                txt = atkMonArr[atkMonNum]['name'] + " took recoil damage!";
                recoilDamage(dmg);
            }

            // check for burn, wound, poison, infect, etc.
            if((effParse[0] == 'burn') || (effParse[0] == 'wound') || (effParse[0] == 'poison') || (effParse[0] == 'infect')) {
                var chance = Math.floor(Math.random() * 100);
                if(chance < effParse[1]) {
                    addState(effParse[0]);
                    txt = defMonArr[defMonNum]['name'] + " was " + effParse[0] + "ed!";
                }
            }

            battleWriter(txt);
            i++;
        } else {
            clearInterval(effects);
            swapTurn();
        }
    }, typeTimeout + 500);
}

function decreaseHealth(dmg, bar) {
    console.log(dmg);
    var valNow = $(bar).attr('aria-valuenow');
    var maxVal = $(bar).attr('aria-valuemax');
    var val = valNow - dmg;
    if (val < 0) {
        val = 0;
        ko();
    }
    var barW = Math.round((val / maxVal) * 100);
    var w = "width:" + barW + "%";
    $(bar).attr('style', w);
    $(bar).attr('aria-valuenow', val);
    setTimeout(effectCheck, typeTimeout);
}

function recoilDamage(dmg) {
    // need to swap bar
    console.log(dmg);
    if(bar == '#player-health') {
        bar = '#enemy-health';
    } else if (bar == '#enemy-health') {
        bar = '#player-health';
    }
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
}

function addState(state){
    if(defMonArr[defMonNum]['status'] == 'normal') {
        defMonArr[defMonNum]['status'] = state;
    } else {
        defMonArr[defMonNum]['status'] += "-" + state;
    }
}

function ko() {
    console.log("Knock out.");
}

initialize();