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
});

function populateRoomsRoomNo() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getRoomDetailsNotOccupied.php',
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
        url: 'pages/api/getRoomDetailsNotOccupied.php',
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
        url: 'pages/api/getRoomDetailsNotOccupied.php',
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
    var myRoom = '<tr>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + floor + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + rateperhour + '</td>' +
        '<td>' +
        '<a class="btn btn-1 tooltipped Vacant" id="Vacant" onclick="" data-tooltip="Reserve" style="margin-right:5px;"><i class="material-icons left">save</i>Reserve</a>' +
        '</td>' +
        '</tr>'
    return myRoom;
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

