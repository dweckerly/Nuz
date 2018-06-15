var quantity

function giveItem(id, q) {
    quantity = q;
    var data = "id=" + id + "&q=" + q;
    postXHR('../util/giveItem.util.php', data, itemModal);
}

function itemModal(data) {
    var obj = JSON.parse(data);
    $('#itemImg').attr('src', obj.imgPath);
    if (quantity > 1) {
        $('#itemName').html("You received " + quantity + " " + obj.name + "s!");
    } else {
        $('#itemName').html("You received one " + obj.name + '!');
    }
    $('#itemDescription').html(obj.description);
    $('#itemModal').modal({backdrop: 'static', keyboard: false});
    $('#getItem').click(function () {
        $('#itemModal').modal('hide');
    });
}

function callBattlePage() {
    console.log("first function called...");
    getXHR("../test/battle/getPartyMons.php", function(data) {
        $("#mainContainer").html(data);
        initialize();
    });
}
