$(window).on("unload", () => {
    $.ajax({
        url: '../api/deleteSesh.php'
    })
});