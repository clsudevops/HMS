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
        var checkoutDate = data[i].checkOutDate;
        var curdate = data[i].curdate;

        $('#roomsList').append(createCardRoom(roomNo, floor, status, type, rate, checkoutDate));

        var myDateNow = getCurrentDate();
        var myCheckoutDate = getMyDate(checkoutDate);

        var date1 = new Date(curdate);
        var date2 = new Date(checkoutDate);

        // console.log(myCheckoutDate);

        if (myDateNow == myCheckoutDate) {
            $("#img_" + roomNo).addClass("checkout");
            $("#content_" + roomNo).text("For Checkout");
        }

        if (myCheckoutDate != "1970-01-01"){
            if (date1 > date2) {
                $("#img_" + roomNo).addClass("penalty");
                $("#content_" + roomNo).text("Penalty");
                // $("#content_" + roomNo).text(checkoutDate);
            }
        }

        if (checkoutDate == myDateNow || status == 'Occupied'){
            $("#bedCards_" + roomNo).wrap('<a class="roomLink" href="roomStatus.php?roomNo='+ roomNo + '"></a>');
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
function populateRoomsbyAvailableType(id) {
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getAvailableRooms.php',
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
// populate rooms with penalty status
function populateRoomsbyPenalty() {
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getPenaltyRooms.php',
        data: "",
        dataType: 'json',
        success: function (data) {
            cardLoop(data);
        }
    });
}
function populateRoomsbyRoomNoSearch(roomNo) {
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getRoomNoSearch.php',
        data: "roomNo=" + roomNo,
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
            $('#penaltyCount').text(data[0].Penalty);
        }
    });
}

// populate available rooms summary
function populateAvailableRoomsCount(){
    $.ajax({
        url: 'pages/api/getAvailableRoomsCount.php',
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
    populateAvailableRoomsCount();
});

//calls sort the rooms by floor
$("#floor").change(function () {
    $(populateRoomsbyFloor);
});

// Sort by Room status
$(".status").click(function () {
    var id = this.id;
    populateRoomsbyStatus(id);
    $(populateSummary);
});

//Sort by checkin out today
$("#checkingOut").click(function () {
    populateRoomsbyTodaysCheckout();
});
$("#penalty").click(function () {
    populateRoomsbyPenalty();
});
// search by room No
$("#searchRoomNo").on("click",function () {
    var roomNo = $('#search').val();
    // alert(roomNo);
    populateRoomsbyRoomNoSearch(roomNo);
});
// sort by room type
function typeFilter (type) {
    populateRoomsbyAvailableType(type);
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