fadeSpeed = 50;
typeSpeed = 50;

function fadeInEffect(id) {
    var j = 0;
    var fadeTarget = document.getElementById(id);
    var fadeEffect = setInterval(function () {
        if(fadeTarget.style.opacity >= 1.0) {
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
    var fadeEffect = setInterval(function () {
        if(j <= 0) {
            clearInterval(fadeEffect);
        } else {
            j -= 0.05;
            fadeTarget.style.opacity = j;
        }
    }, fadeSpeed);
}


function typeWriter(txt, id) {
    var i = 0;
    var typeEffect = setInterval(function() {
        if (i < txt.length) {
            document.getElementById(id).innerHTML += txt.charAt(i);
            i++;
            setTimeout(typeWriter, typeSpeed);
        } else {
            clearTimeout(typeWriter);
        }
    }, typeSpeed);
}