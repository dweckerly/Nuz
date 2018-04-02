var playerHealth = document.getElementById('player-health');
var playerMonPic = document.getElementById('player-mon-portrait');

var enemyHealth = document.getElementById('enemy-health');
var enemyMonPic = document.getElementById('enemy-mon-portrait');

var currentMon = 1;

enemyMonPic.src = nMons[1]['imgPath'];
playerMonPic.src = pMons[1]['imgPath'];
enemyHealth.setAttribute('aria-valuenow', nMons[1]['cHp']);
enemyHealth.setAttribute('aria-valuemax', nMons[1]['hp']);
playerHealth.setAttribute('aria-valuenow', pMons[1]['cHp']);
playerHealth.setAttribute('aria-valuemax', pMons[1]['hp']);

document.ready = populatePlayerAttacks();

document.getElementById('atk-btn').addEventListener('click', function () {
    // need to show attacks here
    $('#battle-command-container').fadeOut(600, "swing");
    $('#attack-container').fadeIn(600, "swing");
});

document.getElementById('switch-btn').addEventListener('click', function () {
    // function to switch mons
});

document.getElementById('inv-btn').addEventListener('click', function () {
    // function to access inventory
});

document.getElementById('sur-btn').addEventListener('click', function () {
    // function to surrender the fight
});



function populatePlayerAttacks() {
    $('#attack-container').hide();
    $('#atk-1').html(pMons[currentMon]['attacks'][1]['name']);
    if(pMons[currentMon]['attacks'][2]['name'] == null) {
        $('#atk-2').html('-');
    } else {
        $('#atk-2').html(pMons[currentMon]['attacks'][2]['name']);
    }
    if(pMons[currentMon]['attacks'][3] == null) {
        $('#atk-3').html('-');
    } else {
        $('#atk-3').html(pMons[currentMon]['attacks'][3]['name']);
    }
    if(pMons[currentMon]['attacks'][4] == null) {
        $('#atk-4').html('-');
    } else {
        $('#atk-4').html(pMons[currentMon]['attacks'][4]['name']);
    }
}



function decreaseHealth(dmg, bar) {
    var valNow = bar.getAttribute('aria-valuenow');
    var maxVal = bar.getAttribute('aria-valuemax');
    var val = valNow - dmg;
    if(val < 0) {
        val = 0;
    }
    var barW = Math.round((val / maxVal)*100);
    var w = "width:" + barW + "%";
    bar.setAttribute('style', w);
    bar.setAttribute('aria-valuenow', val);
}

function ko() {
    console.log("Knock out.");
}








//currently using above function with bootstrap built in animation but will save this for later if I want animation control over the health bar.
function formerDecreaseHealth(dmg, bar) {
    // can later calculate healthInterval by taking health total and slowing down proportional to the amount of damage done?
    var valNow = bar.getAttribute('aria-valuenow');
    console.log(valNow);
    var maxVal = bar.getAttribute('aria-valuemax');
    var i = 1;
    var damage = setInterval(function () {
        if(i <= dmg) {
            var val = valNow - i;
            var barW = Math.round((val / maxVal)*100);
            var w = "width:" + barW + "%";
            bar.setAttribute('style', w);
            bar.setAttribute('aria-valuenow', val);
            if(barW <= 0 || val <= 0) {
                clearInterval(damage);
                ko();
            }
            i++;
        } else {
            clearInterval(damage);
        }
    }, healthInterval);
}

