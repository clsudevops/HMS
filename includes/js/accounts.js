$(document).ready(function () {
    populateRooms();

    $("#submitAccount").on("click", function () {
        var userName = $('#userName').val();
        var passWord = $('#passWord').val();
        var accountType = $('#accountType').val();
        var confirmPassWord = $('#confirmPassWord').val();
        // displayMessage("",accountType);

        // if (userName != "" && passWord != "" && accountType != "" && confirmPassWord != "") {
        //     if(passWord == confirmPassWord){
        //        displayMessage("","tama");
        //     }
        //     else{
        //         displayMessage("", "Password does not match");
        //     }
        //     // $.ajax({
        //     //     url: 'pages/api/insertAccount.php',
        //     //     type: "POST",
        //     //     data: "username=" + userName + "&password=" + passWord + "&accountType=" + accountType,
        //     //     success: function () {
        //     //         $('#userName').val("");
        //     //         $('#passWord').val("");
        //     //         $('#accountType').val("");
        //     //         $('#confirmPassWord').val("");
        //     //         populateRooms();
        //     //         clearRoom();
        //     //         $.alert({
        //     //             title: 'Status',
        //     //             content: 'Saved Succesfully!!!',
        //     //             boxWidth: '40%',
        //     //             theme: 'dark',
        //     //             useBootstrap: false
        //     //         });
        //     //     }
        //     // });
        // }
        // else{
        //     displayMessage("","Pleas Fill up all textfields");
        // }
    });

    $("#search").on("keyup", function () {
        populateRooms();
    });

});
// function clearRoom() {
//     $('#roomNo').val("");
//     $('#rate').val("");
//     $('#rateperhour').val("");
//     $('#roomType').val("1");
//     $('#roomFloor').val("1");
//     $('#roomNo').prop("disabled", false);
//     $('#roomType').prop("disabled", false);
//     $('#roomFloor').prop("disabled", false);

//     M.AutoInit();
// }
function populateRooms() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getAccountsList.php',
        data: "username=" + search,
        dataType: 'json',
        success: function (data) {
            loopAccountsList(data);
            M.AutoInit();
        }
    });
}

function loopAccountsList(data) {
    $('#roomTable').html("");
    for (var i = 0; i < data.length; i++) {
        var username = data[i].username;
        var password = data[i].password;
        var accountType = data[i].accountType;
        var onhold = data[i].onhold;

        $('#accountsTable').append(createAccountsTable(username,password,accountType,onhold));
    }
}

function createAccountsTable(username, password, accountType, onhold) {
    var myAccounts = '<tr>' +
        '<td>' + username + '</td>' +
        '<td>' + accountType + '</td>' +
        '<td><a class="btn btn-flat btn-2 tooltipped" style="margin-right:5px;" onclick="viewPass(\'' + password + '\')" data-tooltip="View Password"><i class="material-icons">visibility</i></a>' +
        '</tr>'
    return myAccounts;
}

function viewPass(password){
    displayMessage("Account Password", password);
}

function deleteAccount(id) {
    $.ajax({
        url: 'pages/api/deleteRoom.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateRooms();
            clearRoom();
            $.alert({
                title: 'Status',
                content: 'Room ' + id + 'Deleted Succesfully!!!',
                boxWidth: '40%',
                theme: 'dark',
                useBootstrap: false
            });
        }
    });
}
// function checkInventory(roomNo, typeid, floor, rate, rateperhour) {
//     $('#roomNo').prop("disabled", true);
//     $('#roomType').prop("disabled", true);
//     $('#roomFloor').prop("disabled", true);

//     $('#roomNo').val(roomNo);
//     $('#roomType').val(typeid);
//     $('#roomFloor').val(floor);
//     $('#rate').val(rate);
//     $('#rateperhour').val(rateperhour);

//     $('#roomtoDisplayInventory').html('Room ' + roomNo);
//     $('#addInventoryContainer').html('<a class="btn right btn-1 modal-trigger" data-roomNo=' + roomNo + ' id="submitRoom" href="#addInventory" style="margin-left:5px; height:36px; line-height:36px;"><i class= "material-icons left" style = "margin-right:10px;">add</i>Add</a >');
//     $('#addInventory #modalRoomNo').html(roomNo);
//     $('#updateInventoryModal #modalRoomNo').html(roomNo);
//     populateInventoryTable(roomNo);
// }
// function populateInventoryTable(roomNo) {
//     $.ajax({
//         url: 'pages/api/getInventoryDetails.php',
//         data: "roomNo=" + roomNo,
//         dataType: 'json',
//         success: function (data) {
//             loopInventoryDetails(data);
//             M.AutoInit();
//         }
//     });
// }

// function submitItemInventoryModal() {
//     var roomNo = $('#addInventory #modalRoomNo').html();
//     var itemDescription = $('#addInventory #itemDescription').val();
//     var itemQuantity = $('#addInventory #itemQuantity').val();

//     if (roomNo != "" && itemDescription != "" && itemQuantity != "") {
//         $.ajax({
//             url: 'pages/api/insertRoomItemInventory.php',
//             type: "POST",
//             data: "roomNo=" + roomNo + "&itemDescription=" + itemDescription + "&itemQuantity=" + itemQuantity,
//             success: function () {
//                 // populateRooms();
//                 $('#addInventory #itemDescription').val("");
//                 $('#addInventory #itemQuantity').val("");
//                 populateInventoryTable(roomNo);
//             }
//         });
//     }
// }

// function populateUpdateModal(id, description, quantity) {
//     // alert(id);
//     $('#updateInventoryModal #itemDescription').val(description);
//     $('#updateInventoryModal #itemQuantity').val(quantity);
//     $('#updateInventoryModal #itemDescription').addClass('valid');
//     $('#updateInventoryModal #itemQuantity').addClass('valid');
//     $('#updateInventoryModal .invetoryLabels').addClass('active');
//     $('#updateInventoryModal .updateInventoryBtn').attr('id', id);
// }

// function updateItemInventoryModal() {
//     var id = $('#updateInventoryModal .updateInventoryBtn').attr('id');;
//     var description = $('#updateInventoryModal #itemDescription').val();
//     var quantity = $('#updateInventoryModal #itemQuantity').val();
//     var roomNo = $('#updateInventoryModal #modalRoomNo').html();;

//     $.ajax({
//         url: 'pages/api/updateInventory.php',
//         type: "POST",
//         data: "id=" + id + "&description=" + description + "&quantity=" + quantity,
//         success: function () {
//             // populateRooms();
//             $('#updateInventoryModal #itemDescription').val("");
//             $('#updateInventoryModal #itemQuantity').val("");
//             populateInventoryTable(roomNo);
//         }
//     });
// }