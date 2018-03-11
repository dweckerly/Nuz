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