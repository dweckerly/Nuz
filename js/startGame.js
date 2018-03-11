var txt = [
    "Howdy pardner! \nThis is The Ranch. It was left to you by your long-lost, eccentric, twice-removed, felon of an Uncle.",
    "Let me be the first to say... Welcome! \nName's Pete Moss. I been a ranch-hand here for awhile now, so I'll show you around the place.",
    "What's your name?"
];

var click = 0;

function start() {
    $('#nameModal').modal({ show: false });
    if (click < txt.length) {
        document.getElementById('startText').innerHTML = "";
        disableButton("nextButton");
        typeWriter(txt[click], 'startText');
    } else {
        nameModal();
    }
}

function nextText() {
    click++;
    start();
}

function nameModal() {
    console.log("called...")
    $('#nameModal').modal('show');
}