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
        var status = data[i].status;

        $('#roomManagementTable').append(createRoomTable(roomNo, type, floor, rate, status));
    }
}

function createRoomTable(roomNo, type, floor, rate, status) {
    var myRoom = '<tr>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + floor + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + status + '</td>' +
        '<td>' +
        '<a class="btn btn-1 tooltipped Vacant changeStatus" id="Vacant" onclick="changeStatus(\'' + roomNo + '\',\'' + status + '\', \'Vacant\')" data-tooltip="Vacant" style="margin-right:5px;"><i class="material-icons">check</i></a>' +
        '<a class="btn btn-1 tooltipped Cleaning changeStatus" id="Cleaning" onclick="changeStatus(\'' + roomNo + '\',\'' + status + '\' , \'Cleaning\')" data-tooltip="Cleaning" style="margin-right:5px;"><i class="material-icons">delete_sweep</i></a>' +
        '<a class="btn btn-1 tooltipped Maintenance changeStatus" id="Maintenance" onclick="changeStatus(\'' + roomNo + '\',\'' + status + '\' , \'Maintenance\')" data-tooltip="Maintenance" style="margin-right:5px;"><i class="material-icons">launch</i></a>' +
        '</td>' +
        '</tr>'
    return myRoom;
}

function changeStatus(roomNo, status, curstatus){
    // alert(status + '----' + curstatus);   
}

