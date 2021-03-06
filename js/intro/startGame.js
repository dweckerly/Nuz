var click = 0;
var modals = ["#nameModal", "#monModal", "#nameMonModal"];
var modalIndex = 0;

var choice = 1;

var nameBtn = document.getElementById('nameBtn');
var choiceBtn = document.getElementById('choiceBtn');

var state = 0;
var playerName = "";
var monName = "";
var monImg = "";

var txt0 = ['Howdy pardner! This is The Ranch. It was left to you by your long-lost, eccentric, twice-removed, felon of an Uncle.',
    "Let me be the first to say... Welcome! Name's Pete Moss. I been a ranch-hand here for awhile now, so I'll show you around the place.",
    "What's your name?"
];

var ntxt = [];

var txt1 = ["Whadaya say we find you a pardner? It's been tough times around here and we only got three 'mons left.",
    "Go ahead and choose one to take with you."
];
var txt2 = ['Whadaya say you give that little critter a name, huh?'];

// add stuff about catching nuzmon
var txt3 = ["Suppose all you need now is... more 'mons! Only way to get 'em is to go out an catch 'em!",
    "I think we got a couple sacks layin' around here you can have..."
];

// go over battle? have battle?
var txt4 = ["Looks like you're all set! If my spaghetti code hasn't borken somewhere you can now go explore the world!",
    "Huzzah!"
];

nameBtn.addEventListener("click", function() {
    $('#nameModal').modal('hide');
    var inputName = document.getElementById('nameTxt').value;
    if (inputName.length == 0) {
        playerName = "Bob";
        ntxt = ["Silent type, huh? Guess I'll just call you... " + playerName + ".",
            "Don't worry though, you can change your name later."
        ];
    } else {
        playerName = document.getElementById('nameTxt').value;
        ntxt = ["Well, nice to meet you, " + playerName + "! Officially and all."];
    }
    state = 1;
    nextText();
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
        } else if (state == 5) {
            giveSack();
        } else if (state == 6) {
            //send player to the main game
            window.location = "http://nuz.96.lt/game/main.g.php";
        }
    }
}

function setChoice(num) {
    choice = num;
    monName = mons[choice]['name'];
    document.getElementById('chooseModalFooter').style.display = "block";
    document.getElementById('chooseDialogue').innerHTML = "So you choose " + monName + "?";
}

// handles text passing to start method
function nextText() {
    if (state == 0) {
        start(txt0);
    } else if (state == 1) {
        start(ntxt);
    } else if (state == 2) {
        //need to refactor
    } else if (state == 3) {
        start(txt1);
    } else if (state == 4) {
        start(txt2);
    } else if (state == 5) {
        start(txt3);
    } else if (state == 6) {
        start(txt4);
    }
}

function openModal(id) {
    $(id).modal({backdrop: 'static', keyboard: false});
}

function makeChoice() {
    state = 4;
    monName = mons[choice]['name'];
    monImg = mons[choice]['img'];
    $('#monModal').modal('hide');
    setMonName(monName, monImg);
    nextText();
}

function setMonName(monName, imgSrc) {
    document.getElementById('namePrompt').innerHTML = "What would you like to name your " + monName + "?";
    document.getElementById('monImg').src = imgSrc;
}

var confirmBtn = document.getElementById('nameMonBtn');

confirmBtn.addEventListener("click", function() {
    $('#nameMonModal').modal('hide');
    var monInputName = document.getElementById('nameMonTxt').value;
    if (monInputName.length == 0) {
        monInputName = monName;
    }
    if (choice == 2) {
        choice = 4;
    } else if (choice == 3) {
        choice = 7;
    }
    data = "pName=" + playerName + "&monID=" + choice + "&monName=" + monInputName;
    postXHR("../util/createGame.php", data, moreExposition);
});

function moreExposition() {
    state = 5;
    nextText();
}

function giveSack() {
    giveItem('1', '3');
    state = 6;
    $('#getItem').click( function() {
        $('#itemModal').modal('hide');
        nextText();
    });
}