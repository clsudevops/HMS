$(document).ready(function () {
    $(populateRoomsRoomNo());
    $("#search").on("keyup", function () {
        populateRoomsRoomNo();
    });
    $('#typeSelect').on("change", function () {
        var type = $('#typeSelect').val();
        populateRoomsType(type);
    });
    $('#floorSelect').on("change", function () {
        var floor = $('#floorSelect').val();
        populateRoomsFloor(floor);
    });
    $('#forPersonal').on('click', function () {
        $('.forCompanyDiv').css("display", "none");
    });
    $('#forCompany').on('click', function () {
        $('.forCompanyDiv').css("display", "block");
    });
});

function populateRoomsRoomNo() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getRoomDetailsNotMaintenance.php.php',
        data: "roomNo=" + search,
        dataType: 'json',
        success: function (data) {
            loopRoomDetails(data);
            M.AutoInit()
        }
    });
}
function populateRoomsType(type) {
    $.ajax({
        url: 'pages/api/getRoomDetailsNotMaintenance.php.php',
        data: "type=" + type,
        dataType: 'json',
        success: function (data) {
            loopRoomDetails(data);
            M.AutoInit()
        }
    });
}
function populateRoomsFloor(floor) {
    $.ajax({
        url: 'pages/api/getRoomDetailsNotMaintenance.php.php',
        data: "floor=" + floor,
        dataType: 'json',
        success: function (data) {
            loopRoomDetails(data);
            M.AutoInit()
        }
    });
}


function loopRoomDetails(data) {
    $('#roomManagementTable').html("");
    for (var i = 0; i < data.length; i++) {
        var roomNo = data[i].roomNo;
        var type = data[i].type;
        var floor = data[i].floor;
        var rate = data[i].rate;
        var rateperhour = data[i].rateperhour;
        var status = data[i].status;

        $('#roomManagementTable').append(createRoomTable(roomNo, type, floor, rate, rateperhour));
    }
}

function createRoomTable(roomNo, type, floor, rate, rateperhour) {
    var myRoom = '<tr onclick="setRoomNo(' + roomNo + ')">' +
        '<td>' + roomNo + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + floor + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + rateperhour + '</td>' +
        '<td>' +
        '<a class="btn btn-1 tooltipped modal-trigger" href="#addReservation" onclick="" data-tooltip="Reserve" style="margin-right:5px;"><i class="material-icons left">save</i>Reserve</a>' +
        '</td>' +
        '</tr>'
    return myRoom;
}

function setRoomNo(roomNo) {
    $('#addReservation #modalRoomNo').html(roomNo);
}
function submitReservationModal() {
    var roomNo = $('#modalRoomNo').html();
    var name = $('#name').val();
    var contact = $('#contact').val();
    var compName = $('#compName').val();
    var compAddress = $('#compAddress').val();
    var checkindate = $('#checkindate').val();
    var checkoutdate = $('#checkoutdate').val();
    checkoutdate = getMyDate1(checkoutdate);
    var adultsCount = $('#adultsCount').val();
    var childrenCount = $('#childrenCount').val();
    var idTypeSelect = $('#idTypeSelect').val();
    var personal_id = $('#personal_id').val();
    // console.log(checkindate);
    if (roomNo != "" && name != "" && contact != "" && checkindate != "" && checkoutdate != "" && adultsCount != "" && idTypeSelect != "" && childrenCount != "" && personal_id != "") {
        $.ajax({
            url: 'pages/api/insertReservation.php',
            type: "POST",
            data:{
                'roomNo': roomNo,
                'name': name,
                'mobile': contact,
                'compName': compName,
                'compAddress': compAddress,
                'checkInDate': checkindate,
                'checkOutDate': checkoutdate,
                'adultsCount': adultsCount,
                'childrensCount': childrenCount,
                'personal_id_type': idTypeSelect,
                'personal_id': personal_id
            },
            success: function () {
                window.location = "reservationList.php";
            }
        });
    }
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

