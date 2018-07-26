$(document).ready(function () {
    populateAccounts();

    $("#submitAccount").on("click", function () {
        var userName = $('#userName').val();
        var passWord = $('#passWord').val();
        var accountType = $('#accountType').val();
        var confirmPassWord = $('#confirmPassWord').val();
        
        if (userName != "" && passWord != "" && accountType != "" && confirmPassWord != "") {
            if (accountType != null) {
                if (passWord == confirmPassWord) {
                    $.ajax({
                        url: 'pages/api/insertAccount.php',
                        type: "POST",
                        data:{
                            userName: userName,
                            passWord: passWord,
                            accountType : accountType
                        },
                        success: function () {
                            $('#userName').val("");
                            $('#passWord').val("");
                            $('#accountType').val("");
                            $('#confirmPassWord').val("");
                            populateAccounts();
                            $.alert({
                                title: 'Status',
                                content: 'Account Created Succesfully!!!',
                                boxWidth: '40%',
                                theme: 'dark',
                                useBootstrap: false
                            });
                        }
                    });
                }
                else{
                    displayMessage("", "Password does not match");
                }
            }
            else{
                displayMessage("", "Please Select Account Type");
            }
        }
        else {
            displayMessage("", "Please Fill up all textfields");
        }
    });

    $("#search").on("keyup", function () {
        populateAccounts();
    });

});

function populateAccounts() {
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
    $('#accountsTable').html("");
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
        '<td>' +
            '<a class="btn btn-flat btn-2 tooltipped" style="margin-right:5px;" onclick="viewPass(\'' + password + '\')" data-tooltip="View Password"><i class="material-icons">visibility</i></a>' +
            '<a class="btn btn-flat btn-2 tooltipped" style="margin-right:5px;" onclick="deleteAccount(\'' + username + '\')" data-tooltip="Delete Account"><i class="material-icons">delete</i></a>' +
        '</td>' +
        '</tr>'
    return myAccounts;
}

function viewPass(password){
    displayMessage("Account Password", password);
}

function deleteAccount(id) {
    $.ajax({
        url: 'pages/api/deleteAccount.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateAccounts();
            $.alert({
                title: 'Status',
                content: 'Account ' + id + ' Deleted Succesfully!!!',
                boxWidth: '40%',
                theme: 'dark',
                useBootstrap: false
            });
            M.AutoInit();
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