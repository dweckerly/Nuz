function giveItem(id, q) {
    var data = "id=" + id + "&q=" + q;
    postXHR('../util/giveItem.util.php', data, itemModal);
}

function itemModal(data) {
    $('#itemImg').attr('src', data['imgPath']);
    $('#itemName').html(data['name']);
    $('#itemDescription').html(data['description']);
    $('#itemModal').modal();
}