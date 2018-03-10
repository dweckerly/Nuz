var txt = [
    "Howdy pardner! You must be the one that inherited The Ranch from your long-lost, eccentric, twice-removed, felon of an Uncle.",
    "Let me be the first to say... Welcome! Name's Pete. I been a ranch-hand here for awhile now, so I'll show you around the place.",
    "What's your name?"
];

var click = 0;

function start() {
    console.log("function started");
    if (click < txt.length()) {
        console.log("typewriter started");
        typeWriter(txt[click], 'startText');
    } else {
        nameModal();
    }
}

function nextText() {
    click++;
    console.log(click);
    start();
}

function nameModal() {

}