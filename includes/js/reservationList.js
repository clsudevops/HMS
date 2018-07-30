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
        '<a class="btn btn-1 tooltipped Vacant" onclick="bookNow(\'' + id + '\')" data-tooltip="Book Now" style="margin-right:5px;"><i class="material-icons left">exit_to_app</i></a>' +
        '<a class="btn btn-1 tooltipped Cleaning" onclick="" data-tooltip="Cancel Reservation" style="margin-right:5px;"><i class="material-icons left">clear</i></a>' +
        '<a class="btn btn-1 tooltipped Maintenance" onclick="" data-tooltip="View Details" style="margin-right:5px;"><i class="material-icons left">pageview</i></a>' +
        '</td>' +
        '</tr>'
    return myRoom;
}

function bookNow(id) {
    $.ajax({
            url: 'pages/api/getReservationDetails.php',
            data: "id=" + id,
            dataType: 'json',
            success: function (data) {
                roomNo = data[0].roomNo;
                name = data[0].name;
                mobile = data[0].mobile;
                compName = data[0].compName;
                compAddress = data[0].compAddress;
                checkOutDate = data[0].checkOutDate;
                adultsCount = data[0].adultsCount;
                childrensCount = data[0].childrensCount;

                $.confirm({
                    title: '',
                    content: 'Book Now?',
                    buttons: {
                        confirm: function () {
                            $.ajax({
                                url: 'pages/api/insertBooking.php',
                                type:"POST",
                                data: {
                                    reservationId: id,
                                    roomNo: roomNo,
                                    name: name,
                                    mobile: mobile,
                                    compName: compName,
                                    compAddress: compAddress,
                                    checkOutDate: checkOutDate,
                                    adultsCount: adultsCount,
                                    childrensCount: childrensCount
                                },
                                success: function (data) {
                                    window.location = "index.php";
                                }
                            });
                        },
                        cancel: function () {

                        },
                    },
                    theme: 'dark',
                    boxWidth: '35%',
                    useBootstrap: false
                });
            }
    });
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

