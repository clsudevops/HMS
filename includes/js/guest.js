$(document).ready(function () {
    $(populateGuests());
});

function createGuestTable(guestID, name, mobile, roomNo, floor, checkInDate, checkOutDate) {
    var myRoom = '<tr>' +
                    '<td>'+ guestID +'</td>' +
                    '<td>' + name +'</td>' +
                    '<td>' + mobile +'</td>' +
                    '<td>' + roomNo +'</td>' +
                    '<td>' + floor +'</td>' +
                    '<td>' + checkInDate +'</td>' +
                    '<td>' + checkOutDate +'</td>' +
                 '</tr>'
    return myRoom;
}
function loopGuests(data){
    for (var i = 0; i < data.length; i++) {
        var guestID = data[i].id;
        var name = data[i].name;
        var mobile = data[i].mobile;
        var roomNo = data[i].roomNo;
        var floor = data[i].floor;
        var checkInDate = data[i].checkin;
        var checkOutDate = data[i].checkOutDate;

        // $('#guestTable').append(createGuestTable(data));
        $('#guestTable').append(createGuestTable(guestID, name, mobile, roomNo, floor, checkInDate, checkOutDate));
    }
}
function populateGuests() {
    $.ajax({
        url: 'pages/api/getGuests.php',
        data: "",
        dataType: 'json',
        success: function (data) {
            loopGuests(data);
        }
    });
}