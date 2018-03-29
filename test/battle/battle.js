var healthInterval = 50;

var playerHealth = document.getElementById('player-health');
var enemyHealth = document.getElementById('enemy-health');

document.getElementById('btn-1').addEventListener('click', function () {
    decreaseHealth(30, enemyHealth);
});

function decreaseHealth(dmg, bar) {
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

function ko() {
    console.log("Knock out.");
}

