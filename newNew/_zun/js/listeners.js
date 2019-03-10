window.addEventListener("beforeunload", function(event) {
    navigator.sendBeacon('auth/logout.php', "");
});