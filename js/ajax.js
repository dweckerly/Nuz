function getXHR(script) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", script, true)
}

function postXHR(script, data) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", script, true)
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if(xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
        }
    }
    xhr.send(data);
}

