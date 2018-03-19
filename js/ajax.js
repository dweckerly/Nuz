function getXHR(script) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", script, true)
}

function postXHR(script) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", script, true)
}