var page = 1;
var curpage = 1;

$(document).ready(function () {
    $(populateRoomsRoomNo(page));
    $("#search").on("keyup", function () {
        populateRoomsRoomNo(pageNo);
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

function populateRoomsRoomNo(pageNo) {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getRoomDetailsNotOccupied.php',
        data: {
            roomNo : search,
            page: pageNo
        },
        dataType: 'json',
        success: function (data) {
        loopRoomDetails(data);
            
        $.getScript("includes/js/pagination.js", function () {
            getPaginationData("roomdetails", 1, "populateRoomsRoomNo");
            
        });
            // populateRoomsRoomNo(pageNo);
            // M.AutoInit()
        }
    });
}
function populateRoomsType(type) {
    $.ajax({
        url: 'pages/api/getRoomDetailsNotOccupied.php',
        data: {
            type: type,
            page: page
        },
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
        data: {
            floor: floor,
            page: page
        },
        dataType: 'json',
        success: function (data) {
            loopRoomDetails(data);
            M.AutoInit()
        }
    });
}


function loopRoomDetails(data) {
    $('#roomManagementTable').html("");
    // $(".material-tooltip").html("");
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
    if(status != curstatus){
        $.ajax({
            url: 'pages/api/updateRoomStatus.php',
            data: "roomNo=" + roomNo + "&status=" + curstatus,
            type: "POST",
            success: function () {
                populateRoomsRoomNo(curpage);
                M.AutoInit()
                $.alert({ title: 'Change status', content: 'Room Status Updated Succesfully', boxWidth: '40%', theme: 'dark', useBootstrap: false});
            },
            error: function (asd, asf, ass) {
                console.log(asd);
            }
        });  
    }
    else{
        $.alert({
            title: 'Change status',
            content: 'The status of this Room is already ' + status,
            boxWidth: '40%',
            theme: 'dark',
            useBootstrap: false
        });
    }
   
}


