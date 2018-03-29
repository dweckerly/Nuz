var btn = document.getElementById("testBtn");
var target = document.getElementById("testTarget");

var data = "id=1";
var response;
btn.addEventListener("click", function () { 
    postXHR("../test/getSomething.php", data, changeData);
});

function changeData(data) {
    target.innerHTML = data;
}

