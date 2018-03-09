var txt = [
    "",
    "",
    ""];

var click = 0;

function start() {
    if(click < txt.length()) {
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

}