var click = 0;
var choice = 0;

function start() {
    if (click < txt.length) {
        document.getElementById('startText').innerHTML = "";
        disableButton("nextButton");
        typeWriter(txt[click], 'startText');
    } else {
        openModal('#nameModal');
        openModal('#monModal');
    }
}

function nextText() {
    click++;
    start();
}

function openModal(id) {
    $(id).modal();
}

function confirmChoice(id) {
    if(id == 1) {
        name = "Carnipula";
    } else if(id == 2) {
        name = "Embah";
    } else if (id == 3) {
        name = "Derple";
    } else {
        name = "ERROR!!!";
    }
    choice = id;
    document.getElementById('chooseModalFooter').style.display = "block";
    document.getElementById('chooseDialogue').innerHTML = "So you choose " + name + "?";
}

function makeChoice() {
    $.post("../util/setFirstMon.php",
        {
            id: choice
        }
    );
}