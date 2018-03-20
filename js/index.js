var loginForm = document.getElementById('loginForm');
var signupForm = document.getElementById('signupForm');

var loginAction = loginForm.getAttribute('action');
var signupAction = signupForm.getAttribute('action');

var button = document.getElementById('logorsignBtn');

button.addEventListener("click", swapLogAndSign);

window.onload = function () {
    if(login == true) {
        loginForm.style.display = "block";
        button.innerHTML = "Or Sign Up";
    } else {
        signupForm.style.display = "block";
        button.innerHTML = "Or Log In";
    }
}

function removeElement(id) {
    var element = document.getElementById(id);
    element.outerHTML = "";
    delete element;
}

function swapLogAndSign() {
    if(document.body.contains(document.getElementById('errMess'))){
        removeElement('errMess');
    }
    if(signupForm.style.display == "block") {
        signupForm.style.display = "none";
        
        loginForm.style.display = "block";
        button.innerHTML = "Or Sign Up";
    } else {
        loginForm.style.display = "none";
        signupForm.style.display = "block";
        button.innerHTML = "Or Log In";
    }
}
