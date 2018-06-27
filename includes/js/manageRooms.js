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
function loopInventoryDetails(data) {
    $('#ItemInventoryTable').html("");
    $('#ItemInventoryTable').append("<thead><tr><th style='width:55%'>Item</th><th style='width:25%'>Quantity</th><th style='width:20%'>Action</th></tr></thead>");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id;
        var roomNo = data[i].roomNo;
        var description = data[i].description;
        var quantity = data[i].quantity;

        $('#ItemInventoryTable').append(createInventoryTable(id, description, quantity));
    }
}

function createInventoryTable(id, description, quantity) {
    var myInventory = '<tr>' +
        '<td>' + description + '</td>' +
        '<td>' + quantity + '</td>' +
        '<td><a class="btn btn-1 tooltipped modal-trigger updateInventoryBtn" data-tooltip="Edit" href="#updateInventoryModal" onclick="populateUpdateModal(\'' + id + '\',\'' + description + '\',\'' + quantity + '\')"><i class="material-icons">edit</i></a></td>' +
        '</tr>'
    return myInventory;
}

function createRoomTable(roomNo, type, floor, rate, rateperhour) {
    var myRoom = '<tr onclick="checkInventory(' + roomNo + ')">' +
        '<td>' + roomNo + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + floor + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + rateperhour + '</td>' +
        '<td><a class="btn btn-1 tooltipped" style="margin-right:5px;" data-tooltip="Delete" onclick="deleteRoom(' + roomNo + ')" "><i class="material-icons">delete</i></a>' +
            '<a class="btn btn-1 tooltipped" data-tooltip="Edit" onclick="EditRoom(' + roomNo + ')" "><i class="material-icons">edit</i></a></td>' +
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
function checkInventory(roomNo){
    // alert(roomNo);
    $('#roomtoDisplayInventory').html('Room ' + roomNo);
    $('#addInventoryContainer').html('<a class="btn right btn-1 modal-trigger" data-roomNo='+ roomNo +' id="submitRoom" href="#addInventory" style="margin-left:5px; height:36px; line-height:36px;"><i class= "material-icons left" style = "margin-right:10px;">add</i>Add</a >');
    $('#addInventory #modalRoomNo').html(roomNo);
    $('#updateInventoryModal #modalRoomNo').html(roomNo);
    populateInventoryTable(roomNo);
}
function populateInventoryTable(roomNo){
    $.ajax({
        url: 'pages/api/getInventoryDetails.php',
        data: "roomNo=" + roomNo,
        dataType: 'json',
        success: function (data) {
            loopInventoryDetails(data);
            M.AutoInit();
        }
    });
}
function submitItemInventoryModal() {
    var roomNo = $('#addInventory #modalRoomNo').html();
    var itemDescription = $('#addInventory #itemDescription').val();
    var itemQuantity = $('#addInventory #itemQuantity').val();

    if (roomNo != "" && itemDescription != "" && itemQuantity != "") {
        $.ajax({
            url: 'pages/api/insertRoomItemInventory.php',
            type: "POST",
            data: "roomNo=" + roomNo + "&itemDescription=" + itemDescription + "&itemQuantity=" + itemQuantity,
            success: function () {
                // populateRooms();
                $('#addInventory #itemDescription').val("");
                $('#addInventory #itemQuantity').val("");
                populateInventoryTable(roomNo);
            }
        });
    }
}

  

// $('.updateInventoryBtn').on("click", function() {
//     var id = $(this).data('id');
//     alert(id);    
// });

function populateUpdateModal(id, description, quantity){
    // alert(id);
    $('#updateInventoryModal #itemDescription').val(description);
    $('#updateInventoryModal #itemQuantity').val(quantity);
    $('#updateInventoryModal #itemDescription').addClass('valid');
    $('#updateInventoryModal #itemQuantity').addClass('valid');
    $('#updateInventoryModal .invetoryLabels').addClass('active');
    $('#updateInventoryModal .updateInventoryBtn').attr('id', id);
}

function updateItemInventoryModal(){
    var id = $('#updateInventoryModal .updateInventoryBtn').attr('id');;
    var description = $('#updateInventoryModal #itemDescription').val();
    var quantity = $('#updateInventoryModal #itemQuantity').val();
    var roomNo = $('#updateInventoryModal #modalRoomNo').html();;

    $.ajax({
        url: 'pages/api/updateInventory.php',   
        type: "POST",
        data: "id=" + id + "&description=" + description + "&quantity=" + quantity,
        success: function () {
            // populateRooms();
            $('#updateInventoryModal #itemDescription').val("");
            $('#updateInventoryModal #itemQuantity').val("");
            populateInventoryTable(roomNo);
        }
    });
}