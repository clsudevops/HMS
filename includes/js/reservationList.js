$(document).ready(function () {
    // alert();
    $(populateReservation());
    $("#search").on("keyup", function () {
        populateReservation();
    });
});

function populateReservation() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getReservationList.php',
        data: "search=" + search,
        dataType: 'json',
        success: function (data) {
            loopReservationList(data);
            M.AutoInit()
        }
    });
}


function loopReservationList(data) {
    $('#reservationListTable').html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].reservationId;
        var name = data[i].name;
        var contact = data[i].mobile;
        var roomNo = data[i].roomNo;
        var checkindate = data[i].checkInDate;
        var checkoutdate = data[i].checkOutDate;


        $('#reservationListTable').append(createReservationTable(id,name, contact, roomNo, checkindate, checkoutdate));
    }
}

function createReservationTable(id,name, contact, roomNo, checkindate, checkoutdate) {
    var myRoom = '<tr>' +
        '<td>' + name + '</td>' +
        '<td>' + contact + '</td>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + checkindate + '</td>' +
        '<td>' + checkoutdate + '</td>' +
        '<td>' +
        '<a class="btn btn-1 tooltipped modal-trigger Vacant" href="" onclick="bookNow('+ id +')" data-tooltip="Book Now" style="margin-right:5px;"><i class="material-icons left">exit_to_app</i></a>' +
        '<a class="btn btn-1 tooltipped modal-trigger Cleaning" href="" onclick="" data-tooltip="Cancel Reservation" style="margin-right:5px;"><i class="material-icons left">clear</i></a>' +
        '<a class="btn btn-1 tooltipped modal-trigger Maintenance" href="" onclick="" data-tooltip="View Details" style="margin-right:5px;"><i class="material-icons left">pageview</i></a>' +
        '</td>' +
        '</tr>'
    return myRoom;
}

function bookNow(id) {
  alert(id);
}

// function changeStatus(roomNo, status, curstatus) {
//     if (status != curstatus) {
//         $.ajax({
//             url: 'pages/api/updateRoomStatus.php',
//             data: "roomNo=" + roomNo + "&status=" + curstatus,
//             type: "POST",
//             success: function () {
//                 populateRoomsRoomNo();
//                 M.AutoInit()
//                 $.alert({ title: 'Change status', content: 'Room Status Updated Succesfully', boxWidth: '40%', theme: 'dark', useBootstrap: false });
//             },
//             error: function (asd, asf, ass) {
//                 console.log(asd);
//             }
//         });
//     }
//     else {
//         $.alert({
//             title: 'Change status',
//             content: 'The status of this Room is already ' + status,
//             boxWidth: '40%',
//             theme: 'dark',
//             useBootstrap: false
//         });
//     }
// }

