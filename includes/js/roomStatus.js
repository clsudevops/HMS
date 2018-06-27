var roomNo = getUrlParameter('roomNo');

$(document).ready(function () {    
    getRoomDatails(roomNo);
    populateExtras();
    populateAddedExtraTable()
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
            // loopRoomDetails(data);
            // M.AutoInit();
            // var checkInId = data[0].checkInId;
            // return checkInId;
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
        '<a class="btn btn-1 tooltipped" id="Delete" onclick="deleteAddedExtra(\'' + id + '\')" data-tooltip="Delete" style="margin-right:5px;"><i class="material-icons">delete</i></a>' +
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