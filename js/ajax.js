function getXHR(script, fun) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", script, true);
    xhr.onreadystatechange = function () {
        if(xhr.readyState == 4 && xhr.status == 200) {
            fun(xhr.responseText);
        }
    }
    xhr.send();
}

function postXHR(script, data, fun) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", script, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if(xhr.readyState == 4 && xhr.status == 200) {
            fun(xhr.responseText);
        }
    }
    xhr.send(data);
}