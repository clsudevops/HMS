$(document).ready(function () {
    var roomNo = getUrlParameter('roomNo');
    getRoomDatails(roomNo);
});

function getRoomDatails(roomNo) {
    $.ajax({
        url: 'pages/api/getCheckInDetails.php',
        data: "roomNo=" + roomNo,
        dataType: 'json',
        success: function (data) {
            $('#h5-roomNo').html("Room No " + roomNo + " " + data[0].type);
            // loopRoomDetails(data);
            // M.AutoInit();
        }
    });
}