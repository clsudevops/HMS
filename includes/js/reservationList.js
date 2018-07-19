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
        var name = data[i].name;
        var contact = data[i].mobile;
        var roomNo = data[i].roomNo;
        var checkindate = data[i].checkInDate;
        var checkoutdate = data[i].checkOutDate;


        $('#reservationListTable').append(createReservationTable(name, contact, roomNo, checkindate, checkoutdate));
    }
}

function createReservationTable(name, contact, roomNo, checkindate, checkoutdate) {
    var myRoom = '<tr>' +
        '<td>' + name + '</td>' +
        '<td>' + contact + '</td>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + checkindate + '</td>' +
        '<td>' + checkoutdate + '</td>' +
        '<td>' +
        '<a class="btn btn-1 tooltipped modal-trigger Vacant" href="" onclick="" data-tooltip="Book Now" style="margin-right:5px;"><i class="material-icons left">exit_to_app</i></a>' +
        '<a class="btn btn-1 tooltipped modal-trigger Cleaning" href="" onclick="" data-tooltip="Cancel Reservation" style="margin-right:5px;"><i class="material-icons left">clear</i></a>' +
        '<a class="btn btn-1 tooltipped modal-trigger Maintenance" href="" onclick="" data-tooltip="View Details" style="margin-right:5px;"><i class="material-icons left">pageview</i></a>' +
        '</td>' +
        '</tr>'
    return myRoom;
}

function submitReservationModal() {
    // var roomNo = $('#modalRoomNo').html();
    // var name = $('#name').val();
    // var contact = $('#contact').val();
    // var compName = $('#compName').val();
    // var compAddress = $('#compAddress').val();
    // var checkindate = $('#checkindate').val();
    // var checkoutdate = $('#checkoutdate').val();
    // var adultsCount = $('#adultsCount').val();
    // var childrenCount = $('#childrenCount').val();
    // var idTypeSelect = $('#idTypeSelect').val();
    // var personal_id = $('#personal_id').val();
    // // console.log(checkindate);
    // if (roomNo != "" && name != "" && contact != "" && checkindate != "" && checkoutdate != "" && adultsCount != "" && idTypeSelect != "" && childrenCount != "" && personal_id != "") {
    //     alert();
    //     $.ajax({
    //         url: 'pages/api/insertReservation.php',
    //         type: "POST",
    //         data: {
    //             'roomNo': roomNo,
    //             'name': name,
    //             'mobile': contact,
    //             'compName': compName,
    //             'compAddress': compAddress,
    //             'checkInDate': checkindate,
    //             'checkOutDate': checkoutdate,
    //             'adultsCount': adultsCount,
    //             'childrensCount': childrenCount,
    //             'personal_id_type': idTypeSelect,
    //             'personal_id': personal_id
    //         },
    //         success: function (data) {
                
    //             window.location = "bookReservation.php";
    //         },
    //         error: function (aaa, aas, aad) {
    //             alert();
    //             console.log(aaa);
    //         }
    //     });
    // }
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

