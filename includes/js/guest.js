$(document).ready(function () {
    $(populateGuests);
});

function createGuestTable() {
    var myRoom = "";
    return myRoom;
}
function populateGuests() {
    $.ajax({
        url: 'pages/api/getGuests.php',
        data: "",
        dataType: 'json',
        success: function (data) {
         
        }
    });
}