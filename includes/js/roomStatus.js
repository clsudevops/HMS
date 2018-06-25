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
            $('#h5-roomNo').html("<span class='guestName'># Room No " + roomNo + " " + data[0].type + "</span>" + "&nbsp;&nbsp;--> <i class='material-icons roomStatusGuestIcon'>person</i>" + "<span class='guestName'>" + data[0].name +"</span>");
            $('#ratepernight').html("<i class='material-icons roomRateGuestIcon'>hotel</i>Php"+ " " + data[0].rate + '/night');
            $('#checkin').html("<i class='material-icons roomcalendarGuestIcon'>event</i><span style='font-weight:bold;'>Check-in: </span>" + data[0].checkInDate + "&nbsp;&nbsp;" + "<i class='material-icons roomcalendarGuestIcon'>access_time</i>" + data[0].checkInTime);
            $('#checkout').html("<i class='material-icons roomcalendarGuestIcon'>event</i><span style='font-weight:bold;'>Check-out: </span>" + data[0].checkOutDate + "&nbsp;&nbsp;" + "<i class='material-icons roomcalendarGuestIcon'>access_time</i>" + data[0].checkOutTime);
            // loopRoomDetails(data);
            // M.AutoInit();
        }
    });
}