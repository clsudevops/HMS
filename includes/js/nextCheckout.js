$(document).ready(function () {
     $(populateNextCheckout());
    $("#search").on("keyup", function () {
        populateNextCheckout();
    });
});

function populateNextCheckout() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getNextCheckout.php',
        data: "guestName=" + search,
        dataType: 'json',
        success: function (data) {
            loopNextCheckout(data);
            M.AutoInit()
        }
    });
}

function loopNextCheckout(data) {
    $('#nextCheckoutTable').html("");
    for (var i = 0; i < data.length; i++) {
        var guestId = data[i].guestId;
        var guestName = data[i].name;
        var roomNo = data[i].roomNo;
        var checkin = data[i].checkIn;
        var checkOutDate = data[i].checkOutDate;

        $('#nextCheckoutTable').append(createNextCheckoutTable(guestId, guestName, roomNo, checkin, checkOutDate));
    }
}

function createNextCheckoutTable(guestId, guestName, roomNo, checkin, checkOutDate) {
    var myNextCheckoutTable = '<tr>' +
        '<td>' + guestId + '</td>' +
        '<td>' + guestName + '</td>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + checkin + '</td>' +
        '<td>' + checkOutDate + '</td>' +
        '</tr>'
    return myNextCheckoutTable;
}