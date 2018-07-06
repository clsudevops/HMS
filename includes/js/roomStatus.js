var roomNo = getUrlParameter('roomNo');

$(document).ready(function () {    
    getRoomDatails(roomNo);
    populateExtras();
    populateFoods();
    populateAddedExtraTable();
    populateOrders(roomNo);
});

function getRoomDatails(roomNo) {
    $.ajax({
        url: 'pages/api/getCheckInDetails.php',
        data: "roomNo=" + roomNo,
        dataType: 'json',
        success: function (data) {
            $('#h5-roomNo').html("<span class='guestName'># Room No " + roomNo + " " + data[0].type + "</span>" + "&nbsp;&nbsp;--> <i class='material-icons roomStatusGuestIcon'>person</i>" + "<span class='guestName'>" + data[0].name +"</span>");
            $('#ratepernight').html("<i class='material-icons roomRateGuestIcon'>hotel</i>Php"+ " " + data[0].rate + '/night');
            $('#checkin').html("<i class='material-icons roomcalendarGuestIcon'>event</i><span class='spanCheckinRoomStatus'>Check-in</span>" + ": " + data[0].checkInDate + "&nbsp;&nbsp;" + "<i class='material-icons roomcalendarTimeIcon'>access_time</i>" + data[0].checkInTime);
            $('#checkout').html("<i class='material-icons roomcalendarGuestIcon'>event</i><span class='spanCheckinRoomStatus'>Check-out</span>" + ": " + data[0].checkOutDate + "&nbsp;&nbsp;" + "<i class='material-icons roomcalendarTimeIcon'>access_time</i>" + data[0].checkOutTime);
        }
    });
}

function populateExtras(){
    $.ajax({
        url: 'pages/api/getExtras.php',
        dataType: 'json',
        data: "description=",
        success: function (data) {
            $('#extraListTable').html("");
            for (var i = 0; i < data.length; i++) {
                var id = data[i].id;
                var description = data[i].description;
                var cost = data[i].cost;
                $('#extraListTable').append(createExtraTable(id, description, cost));
                M.AutoInit();
            }
        }
    });
}
function populateFoods() {
    $.ajax({
        url: 'pages/api/getFoods.php',
        dataType: 'json',
        data: "menu=",
        success: function (data) {
            $('#foodListTable').html("");
            for (var i = 0; i < data.length; i++) {
                var id = data[i].id;
                var menuName = data[i].menuName;
                var price = data[i].sellingPrice;
                var remaining = data[i].remaining;
                $('#foodListTable').append(createFoodsTable(id, menuName, price, remaining));
                M.AutoInit();
            }
        }
    });
}
function populateOrders(roomNo) {
    var totalofOrders = 0;
    $.ajax({
        url: 'pages/api/getAddedOrders.php',
        dataType: 'json',
        data: "roomNo=" + roomNo,
        success: function (data) {
            $('#ordersTable').html("");
            for (var i = 0; i < data.length; i++) {
                var id = data[i].id;
                var menuName = data[i].menuName;
                var quantity = data[i].quantity;
                var totalPrice = data[i].totalPrice;
                totalofOrders = totalofOrders + totalPrice;
                $('#ordersTable').append(createOrdersTable(id, menuName, quantity, totalPrice));
                $('#totalofOrders').html(convert(totalofOrders));
                M.AutoInit();
            }
        }
    });
}
function createOrdersTable(id, menuName, quantity, totalPrice) {
    var foodList = '<tr>' +
        '<td>' + menuName + '</td>' +
        '<td>' + quantity + '</td>' +
        '<td>' + totalPrice + '</td>' +
        '<td style="width:20%;">' +
        '<a class="btn btn-1 tooltipped" id="addExtra" onclick="editOrder(\'' + id + '\',\'' + menuName + '\',\'' + quantity + '\')" data-tooltip="Edit" style="margin-right:5px;"><i class="material-icons">edit</i></a>' +
        '</td>' +
        '</tr>'
    return foodList;
}

function createFoodsTable(id, menuName, price, remaining) {
    var foodList = '<tr>' +
        '<td>' + menuName + '</td>' +
        '<td>' + price + '</td>' +
        '<td style="width:20%;">' +
        '<a class="btn btn-1 tooltipped" id="addExtra" onclick="addFoods(\'' + id + '\',\'' + menuName + '\',\'' + remaining + '\')" data-tooltip="Add" style="margin-right:5px;"><i class="material-icons">add</i></a>' +
        '</td>' +
        '</tr>'
    return foodList;
}
function editOrder(id, menuName, quantity){
    alert();
}
function createExtraTable(id, description, cost) {
    var extraList = '<tr>' +
        '<td>' + description + '</td>' +
        '<td>' + cost + '</td>' +
        '<td style="width:20%;">' +
        '<a class="btn btn-1 tooltipped" id="addExtra" onclick="addExtra(\'' + id + '\')" data-tooltip="Add" style="margin-right:5px;"><i class="material-icons">add</i></a>' +
        '</td>' +
        '</tr>'
    return extraList;
}

function addExtra(id){
    $.ajax({
        url: 'pages/api/insertCheckinExtras.php',
        data: "roomNo=" + roomNo + "&extrasId=" + id,
        type: "POST",
        success: function () {
            populateAddedExtraTable();   
        }
    });
}

function addFoods(id, menuName,remaining){
    $.confirm({
        title: 'Add Order of ' + menuName +'',
        theme:'dark',
        boxWidth: '30%',
        useBootstrap: false,
        content: '' +
            '<form action="" class="formName">' +
            '<label>Available Servings ' + remaining + '</label>'+
            '<div class="form-group">' +
            '<input type="number" style="color:white;" placeholder="Quantity" class="quantity form-control" required/>' +
            '</div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: 'Add',
                btnClass: 'btn-blue',
                action: function () {
                    var quantity = this.$content.find('.quantity').val();
                    if (!quantity) {
                        displayMessage("", "Please provide a valid input");
                        return false;
                    }
                   else{
                        if (parseInt(quantity) > parseInt(remaining)){
                            displayMessage("", "Quantity inputted is greater than the remaining servings left!");
                            return false;
                       }
                       else{
                            var newCount = remaining - quantity;
                            $.ajax({
                                url: 'pages/api/insertCheckInOrder.php',
                                data: {
                                    roomNo: roomNo,
                                    foodsId: id,
                                    quantity: quantity,
                                    newCount: newCount
                                },
                                type: "POST",
                                success: function () {
                                    populateFoods();
                                    populateOrders(roomNo);
                                    displayMessage("", "Food Added Succesfully");
                                }
                            });
                       }
                   }
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
}

function populateAddedExtraTable(){
    $.ajax({
        url: 'pages/api/getAddedExtras.php',
        dataType: 'json',
        data: "roomNo=" + roomNo,
        type: "POST",
        success: function (data) {
            $('#addedExtraTable').html("");
            for (var i = 0; i < data.length; i++) {
                var id = data[i].id;
                var checkinId = data[i].checkinId;
                var quantity = data[i].quantity;
                var description = data[i].description;
                var cost = quantity * data[i].cost;
                $('#addedExtraTable').append(createAddedExtraTable(id, checkinId, quantity, description, cost));
                M.AutoInit();
            }
        }
    });
}
function createAddedExtraTable(id, checkinId, quantity, description ,cost) {
    var addedExtraList = '<tr>' +
        '<td>' + description + '</td>' +
        '<td>' + quantity + '</td>' +
        '<td>' + cost + '</td>' +
        '<td style="width:15%;">' +
        '<a class="btn btn-1 tooltipped" id="addExtra" id="Delete" onclick="deleteAddedExtra(\'' + id + '\')" data-tooltip="Delete" style="margin-right:5px;"><i class="material-icons">delete</i></a>' +
        '</td>' +
        '</tr>'
    return addedExtraList;
}
function deleteAddedExtra(id) {
    $.ajax({
        url: 'pages/api/deleteAddedExtras.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateAddedExtraTable();
            M.AutoInit();
        }
    });
}