$(document).ready(function () {
    populateRooms();

    $("#submitRoom").on("click", function () {
        var roomNo = $('#roomNo').val();
        var roomType = $('#roomType').val();
        var roomFloor = $('#roomFloor').val();
        var rate = $('#rate').val();
        var rateperhour = $('#rateperhour').val();

        if (roomNo != "" && roomType != "" && roomFloor != "" && rate != "") {
            $.ajax({
                url: 'pages/api/insertRoom.php',
                type: "POST",
                data: "roomNo=" + roomNo + "&roomType=" + roomType + "&roomFloor=" + roomFloor + "&rate=" + rate +"&rateperhour=" + rateperhour ,
                success: function () {
                    $('#roomNo').val("");
                    $('#roomType').val("");
                    $('#roomFloor').val("");
                    $('#rate').val("");
                    $('#rateperhour').val("");
                    populateRooms();
                }
            });
        }
    });
    $("#search").on("keyup", function () {
        populateRooms();
    });

});

function populateRooms() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getRoomDetails.php',
        data: "roomNo=" + search,
        dataType: 'json',
        success: function (data) {
            loopRoomDetails(data);
            M.AutoInit();
        }
    });
}

function loopRoomDetails(data) {
    $('#roomTable').html("");
    for (var i = 0; i < data.length; i++) {
        var roomNo = data[i].roomNo;
        var type = data[i].type;
        var floor = data[i].floor;
        var rate = data[i].rate;
        var rateperhour = data[i].rateperhour;

        $('#roomTable').append(createRoomTable(roomNo, type,floor, rate,rateperhour));
    }
}

function createRoomTable(roomNo, type, floor, rate, rateperhour) {
    var myRoom = '<tr>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + floor + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + rateperhour + '</td>' +
        '<td><a class="btn btn-2 tooltipped" data-tooltip="Delete" onclick="deleteRoom(' + roomNo + ')" "><i class="material-icons">delete</i></a></td>' +
        '</tr>'
    return myRoom;
}

function deleteRoom(id) {
    $.ajax({
        url: 'pages/api/deleteRoom.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateRooms();
        }
    });
}
