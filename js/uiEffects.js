fadeSpeed = 50;
typeSpeed = 20;


function clearHtml (id) {
    document.getElementById(id).innerHTML = "";
}

function fadeInEffect(id) {
    var j = 0;
    var fadeTarget = document.getElementById(id);
    var fadeEffect = setInterval(function() {
        if (fadeTarget.style.opacity >= 1.0) {
            console.log("Done " + fadeTarget.style.opacity);
            clearInterval(fadeEffect);
        } else {
            j += 0.05;
            fadeTarget.style.opacity = j;
            console.log("Fade in " + fadeTarget.style.opacity);
        }
    }, fadeSpeed);
}

function fadeOutEffect(id) {
    var j = 1;
    var fadeTarget = document.getElementById(id);
    var fadeEffect = setInterval(function() {
        if (j <= 0) {
            clearInterval(fadeEffect);
        } else {
            j -= 0.05;
            fadeTarget.style.opacity = j;
        }
    }, fadeSpeed);
}

function disableButton(btnid) {
    document.getElementById(btnid).disabled = true;
}

function enableButton(btnid) {
    document.getElementById(btnid).disabled = false;
}

function typeWriter(text, id) {
    clearTimeout(typeEffect);
    var i = 0;
    var typeEffect = setInterval(function() {
        if (i < text.length) {
            document.getElementById(id).innerHTML += text.charAt(i);
            i++;
        } else {
            enableButton("nextButton");
            clearTimeout(typeEffect);
        }
    }, typeSpeed);
}