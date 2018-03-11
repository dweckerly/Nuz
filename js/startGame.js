var click = 0;

function start() {
    $('#nameModal').modal({ show: false });
    if (click < txt.length) {
        document.getElementById('startText').innerHTML = "";
        disableButton("nextButton");
        typeWriter(txt[click], 'startText');
    } else {
        if (name == true) {
            monModal();
        } else {
            nameModal();
        }
    }
}

function nextText() {
    click++;
    start();
}

function nameModal() {
    $('#nameModal').modal('show');
}

function monModal() {
    $('#monModal').modal('show');
}