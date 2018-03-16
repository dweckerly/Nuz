var click = 0;

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