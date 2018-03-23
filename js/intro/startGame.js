var click = 0;
var modals = ["#nameModal", "#monModal", "#nickNameModal"];
var modalIndex = 0;

var choice = 1;

var nameBtn = document.getElementById('nameBtn');
var choiceBtn = document.getElementById('choiceBtn');

var state = 0;
var playerName = "";

var txt0 = ['Howdy pardner! This is The Ranch. It was left to you by your long-lost, eccentric, twice-removed, felon of an Uncle.',
    "Let me be the first to say... Welcome! Name's Pete Moss. I been a ranch-hand here for awhile now, so I'll show you around the place.",
    "What's your name?"
];

var ntxt0 = [""];
var ntxt1 = ["", ""];

var txt1 = ["Whadaya say we find you a pardner? It's been tough times around here and we only got three 'mons left.",
    "Go ahead and choose one to take with you."
];
var txt2 = ['Whadaya say you give that little critter a name, huh?'];


nameBtn.addEventListener("click", function() {
    $('#nameModal').modal('hide');
    var inputName = document.getElementById('nameTxt').value;
    if (inputName.length == 0) {
        playerName = "Bob";
        ntxt1 = ["Silent type, huh? Guess I'll just call you... " + playerName + ".",
            "Don't worry though, you can change your name later."
        ];
        state = 2;
        nextText();
    } else {
        playerName = document.getElementById('nameTxt').value;
        ntxt0 = ["Well, nice to meet you, " + playerName + "! Officially and all."];
        state = 1;
        nextText();
    }
});

$(document).ready(function() {
    state = 0;
    nextText();
});

function start(txt) {
    if (click < txt.length) {
        document.getElementById('startText').innerHTML = "";
        disableButton("nextButton");
        typeWriter(txt[click], 'startText');
        click++;
    } else {
        click = 0;
        if (state == 0) {
            openModal(modals[modalIndex]);
            modalIndex++;
        } else if (state == 1 || state == 2) {
            state = 3;
            nextText();
        } else if (state == 3) {
            openModal(modals[modalIndex]);
            modalIndex++;
        } else if (state == 4) {
            openModal(modals[modalIndex]);
            modalIndex++;
        }
    }
}

function setChoice(num) {
    choice = num;
    document.getElementById('chooseModalFooter').style.display = "block";
    if (choice == 1) {
        var monName = "Carnipula";
    } else if (choice == 2) {
        var monName = "Embah";
    } else if (choice == 3) {
        var monName = "Derple";
    } else {
        window.location.replace("http://nuz.96.lt");
    }
    document.getElementById('chooseDialogue').innerHTML = "So you choose " + monName + "?";
}

function nextText() {
    if (state == 0) {
        start(txt0);
    } else if (state == 1) {
        start(ntxt0);
    } else if (state == 2) {
        start(ntxt1);
    } else if (state == 3) {
        start(txt1);
    } else if (state == 4) {
        start(txt2);
    }
}

function openModal(id) {
    $(id).modal();
}

function makeChoice() {
    state = 4;
    $('#monModal').modal('hide');
    nextText();
}