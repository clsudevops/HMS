// indexe php start

// function for creating rooms card
function createCardRoom(roomNo,floor, status, type, rate, checkoutDate){
    var myRoom = '<div class="col s6 m3" id="bedCardsContainer" style="padding-left:0px; padding-right:23px;">' +
                    '<div class="card bedCards" id="bedCards_'+ roomNo +'">' +
                        '<div class="seperate" onmouseover="test(\'' + roomNo + '\', \'' + type + '\', \'' + rate + '\')" onmouseleave="test1(\'' + roomNo + '\', \'' + checkoutDate + '\')">' +
                            '<p class="roomNo" id="room_' + roomNo + '">Room No ' + roomNo + '</p>' +
                            '<div class="card-image ' + status + '" id="img_' + roomNo + '">' +
                                '<img class="materialboxed" src="includes/images/bed1.png">' +
                            '</div>' +
                        '</div>' +
                        '<div class="card-action" id="content_' + roomNo + '">' +
                                status +
                        '</div>' +
                    '</div>' +
                '</div>'
    return myRoom;
}

// loop the rooms cards
function cardLoop(data) {
    for (var i = 0; i < data.length; i++) {
        var roomNo = data[i].roomNo;
        var floor = data[i].floor;
        var status = data[i].status;
        var type = data[i].type;
        var rate = data[i].rate;
        var checkoutDate = data[i].checkoutDate;

        $('#roomsList').append(createCardRoom(roomNo, floor, status, type, rate, checkoutDate));

        var myDateNow = getCurrentDate();
        var checkoutDate = getMyDate(checkoutDate);

        if (checkoutDate == myDateNow) {
            $("#img_" + roomNo).addClass("checkout");
            $("#content_" + roomNo).text("For Checkout");
        }

        if (checkoutDate == myDateNow || status == 'Occupied'){
            $("#bedCards_" + roomNo).wrap('<a class="roomLink" href="checkOut.php"></a>');
        }
        else{
            $("#bedCards_" + roomNo).wrap('<a class="roomLink" href="checkIn.php?roomNo='+ roomNo +'"></a>');
        }

    }
}

// function to sort the rooms by floor
function populateRoomsbyFloor() {
    var floor = $('#floor').val();
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getRoomList.php',
        data: "floor=" + floor,
        dataType: 'json',
        success: function (data) {
            cardLoop(data);
        }
    });
}
// populate rooms by type
function populateRoomsbyType(id) {
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getRoombyType.php',
        data: "type=" + id,
        dataType: 'json',
        success: function (data) {
            cardLoop(data);
        }
    });
}

// function that sorts room by Status
function populateRoomsbyStatus(id) {
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getRoomList.php',
        data: "status=" + id,
        dataType: 'json',
        success: function (data) {
            cardLoop(data);
        }
    });
}

// populate rooms by todays checkout
function populateRoomsbyTodaysCheckout() {
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getTodaysRoomCheckout.php',
        data: "",
        dataType: 'json',
        success: function (data) {
            cardLoop(data);
        }
    });
}

// function to add count to rooms summary
function populateSummary() {
    $.ajax({
        url: 'pages/api/getRoomSummary.php',
        data: "",
        dataType: 'json',
        success: function (data) {
            $('#vacantCount').text(data[0].Vacant);
            $('#occupiedCount').text(data[0].Occupied);
            $('#cleaningCount').text(data[0].Cleaning);
            $('#maintenanceCount').text(data[0].Maintenance);
            $('#todaysCheckoutCount').text(data[0].TodaysCheckout);
        }
    });
}

// populate available rooms summary
function populateAvailableRooms(){
    $.ajax({
        url: 'pages/api/getAvailableRooms.php',
        data: "",
        dataType: 'json',
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                $('#bedTypes').append('<tr class="RoomFilter" id="' + data[i].type + '" onclick="typeFilter(\'' + data[i].type + '\')"><td style="width:196px">' + data[i].type + '</td><td>' + data[i].count +'</td></tr>');
            }
        }
    });
}
// initial loading
$(document).ready(function () {
    $(populateRoomsbyFloor);
    $(populateSummary);
    populateAvailableRooms();
});

//calls sort the rooms by floor
$("#searchGuest").change(function () {
    $('#roomsList').html("");
    $(populateRoomsbyFloor);
});

// Sort by Room status
$(".status").click(function () {
    var id = this.id;
    $('#roomsList').html("");
    populateRoomsbyStatus(id);
});

//Sort by checkin out today
$("#checkingOut").click(function () {
    $('#roomsList').html("");
    populateRoomsbyTodaysCheckout();
});

// sort by room type
function typeFilter (type) {
    populateRoomsbyType(type);
}


// hovering details of room
function test(roomNo, type, rate) {
    $("#room_" + roomNo).text(type);
    $("#bedCards_" + roomNo).addClass('hoverable');
}
// mouse leave
function test1(roomNo, checkoutDate) {
    var myDateNow = getCurrentDate();
    var checkoutDate = getMyDate(checkoutDate);
    $("#room_" + roomNo).text('Room No ' + roomNo);
    
    if (checkoutDate == myDateNow) {
        $("#content_" + roomNo).text("For Checkout");
    }
}

// index.php js up to here