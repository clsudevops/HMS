$(document).ready(function () {
    $(populateRoomTypes());

    $("#submitRoomType").on("click", function () {
        var type = $('#typeName').val();
        var maxAdult = $('#maxAdult').val();
        var maxChildren = $('#maxChildren').val();

        if (type != ""){
            $.ajax({
                url: 'pages/api/insertRoomTypes.php',
                type: "POST",
                data: "type=" + type + "&maxAdult=" + maxAdult + "&maxChildren=" + maxChildren,
                success: function () {
                    $('#typeName').val("");
                    $('#maxAdult').val("");
                    $('#maxChildren').val("");
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
        var maxAdult = data[i].maxAdult;
        var maxChildren = data[i].maxChildren;

        $('#roomTypeTable').append(createRoomTypeTable(id, type, maxAdult, maxChildren));
    }
}

function createRoomTypeTable(id, type, maxAdult, maxChildren) {
    var myRoomType = '<tr>' +
        '<td>' + type + '</td>' +
        '<td>' + maxAdult + '</td>' +
        '<td>' + maxChildren + '</td>' +
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
            $.alert({
                title: 'Status',
                content: 'Room Type Deleted Succesfully!!!',
                boxWidth: '40%',
                theme: 'dark',
                useBootstrap: false
            });
            M.AutoInit();
        }
    });
}
