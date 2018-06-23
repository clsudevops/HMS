$(document).ready(function () {
    $(populateRoomTypes());

    $("#submitRoomType").on("click", function () {
        var type = $('#typeName').val();
        var rate = $('#rate').val();
        if (type != "" && rate != ""){
            $.ajax({
                url: 'pages/api/insertRoomTypes.php',
                type: "POST",
                data: "type=" + type + "&rate=" + rate,
                success: function () {
                    $('#typeName').val("");
                    $('#rate').val("");
                    populateRoomTypes();
                }
            });
        }
    });

    $("#searchRoomType").on("click", function () {
        populateRoomTypes();
    });
    $("#search").on("keyup", function () {
        populateRoomTypes();
    });
});

function populateRoomTypes() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getRoomTypes.php',
        data: "type=" + search,
        dataType: 'json',
        success: function (data) {
            loopRoomTypes(data);
            M.AutoInit();
        }
    });
}

function loopRoomTypes(data) {
    $('#roomTypeTable').html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id;
        var type = data[i].type;
        var rate = data[i].rate;

        $('#roomTypeTable').append(createRoomTypeTable(id,type,rate));
    }
}

function createRoomTypeTable(id, type, rate) {
    var myRoomType = '<tr>' +
        '<td>' + id + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + rate + '</td>' +
        '<td><a class="btn btn-flat btn-2 tooltipped" data-tooltip="Delete" onclick="deleteRoomType('+ id +')" "><i class="material-icons">delete</i></a></td>' +
        '</tr>'
    return myRoomType;
}

function deleteRoomType(id){
    $.ajax({
        url: 'pages/api/deleteRoomTypes.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateRoomTypes();
        }
    });
}
