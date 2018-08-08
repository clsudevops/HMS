var page = 1;
var curpage = 1;
var selectedType = null;

$(document).ready(function () {
    $(populateRoomTypes(page));

    $("#submitRoomType").on("click", function () {
        var type = $('#typeName').val();
        var maxAdult = $('#maxAdult').val();
        var maxChildren = $('#maxChildren').val();
        var rate = $('#rate').val();
        var rateperhour = $('#rateperhour').val();

        if (type != ""){
            $.ajax({
                url: 'pages/api/insertRoomTypes.php',
                type: "POST",
                data: {
                    type : type,
                    maxAdult: maxAdult,
                    maxChildren: maxChildren,
                    rate: rate,
                    rateperhour: rateperhour
                },
                success: function () {
                    $('#typeName').val("");
                    $('#maxAdult').val("");
                    $('#maxChildren').val("");
                    $('#rate').val("");
                    $('#rateperhour').val("");
                    populateRoomTypes(curpage);
                }
            });
        }
    });
    $('#btnupdateRoomType').on("click", function () {
        var id = $('#upd_id').val();
        var type = $('#upd_roomType').val();
        var maxAdult = $('#upd_adult').val();
        var maxChildren =  $('#upd_child').val();
        var rate = $('#upd_rate').val();
        var rateperhour = $('#upd_rateperhour').val();

        $.ajax({
            url: 'pages/api/updateRoomTypes.php',
            type: "POST",
            data: {
                id: id,
                type: type,
                maxAdult : maxAdult,
                maxChildren: maxChildren,
                rate: rate,
                rateperhour: rateperhour
            },
            success: function () {
                displayMessage("Update Status", "Room Type updated succesfully");
                populateRoomTypes(curpage);
            }
        });

    });

    $("#searchRoomType").on("click", function () {
        populateRoomTypes(page);
    });
    $("#search").on("keyup", function () {
        populateRoomTypes(page);
    });
});

function populateRoomTypes(pageNo) {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getRoomTypes.php',
        data: {
            type: search,
            page: pageNo
        },
        dataType: 'json',
        success: function (data) {
            loopRoomTypes(data);
            if (search != "") { forPagination("roomTypes", "type like '%"+ type +"%'", "populateRoomTypes"); }
            else { forPagination("roomTypes", 1, "populateRoomTypes"); }
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
        var rate = data[i].rate;
        var rateperhour = data[i].rateperhour;

        $('#roomTypeTable').append(createRoomTypeTable(id, type, maxAdult, maxChildren,rate,rateperhour));
    }
}

function createRoomTypeTable(id, type, maxAdult, maxChildren, rate, rateperhour) {
    var myRoomType = '<tr>' +
        '<td>' + type + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + rateperhour + '</td>' +
        '<td>' + maxAdult + '</td>' +
        '<td>' + maxChildren + '</td>' +
        '<td><a class="btn btn-flat btn-2 modal-trigger" href="#updateRoomType" onclick="forUpdate(\'' + id + '\',\'' + type + '\',\'' + maxAdult + '\',\'' + maxChildren + '\',\'' + rate + '\',\'' + rateperhour + '\')"><i class="material-icons">edit</i></a>' +
        '<a class="btn btn-flat btn-2" onclick="deleteRoomType('+ id +')"><i class="material-icons">delete</i></a></td>' +
        '</tr>'
    return myRoomType;
}

function forUpdate(id, type, maxAdult, maxChildren, rate, rateperhour){
    $('#upd_id').val(id);
    $('#upd_roomType').val(type);
    $('#upd_adult').val(maxAdult);
    $('#upd_child').val(maxChildren);
    $('#upd_rate').val(rate);
    $('#upd_rateperhour').val(rateperhour);
}

function deleteRoomType(id){
    $.ajax({
        url: 'pages/api/deleteRoomTypes.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateRoomTypes(curpage);
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
