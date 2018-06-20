// indexe php start

// function to sort the rooms by floor
function populateRoomsbyFloor() {
    var floor = $('#floor').val();
    $('#roomsList').html("");
    $.ajax({
        url: 'pages/api/getRoomList.php',
        data: "floor=" + floor,
        dataType: 'json',
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                var roomNo = data[i].roomNo;
                var status = data[i].status;
                var type = data[i].type;
                var rate = data[i].rate;
                var checkoutDate = data[i].checkoutDate;

                $('#roomsList').append(
                    '<div class="col s6 m3">' +
                        '<div class="card bedCards">' +
                            '<div class="seperate" onmouseover="test(\'' + roomNo + '\', \'' + type + '\', \'' + rate + '\')" onmouseleave="test1(\'' + roomNo + '\', \'' + status + '\')">' +
                                '<p class="roomNo" id="room_' + roomNo + '">Room No ' + roomNo + '</p>' +
                                '<div class="card-image ' + status + '" id="img_'+ roomNo +'">' +
                                    '<img class="materialboxed" src="includes/images/bed1.png">' +
                                '</div>' +
                                '<div class="card-content" id="content_' + roomNo + '" style="text-align:center;">' +
                                    status +
                                '</div>' +
                            '</div>' +
                            '<div class="card-action">' +
                                '<a class="btn-floating btn-flat btn-small waves-effect light-green lighten-2"><i class="material-icons">done</i></a>' +
                                '<a class="btn-floating btn-flat btn-small waves-effect light-blue lighten-2"><i class="material-icons">delete_sweep</i></a>' +
                                '<a class="btn-floating btn-flat btn-small waves-effect orange lighten-2"><i class="material-icons">launch</i></a>' +
                            '</div>' +
                        '</div>' +
                    '</div>'
                );
                
                // $("#img_"+ roomNo).addClass("checkout");
            }
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
            for (var i = 0; i < data.length; i++) {
                var roomNo = data[i].roomNo;
                var status = data[i].status;
                var type = data[i].type;
                var rate = data[i].rate;

                $('#roomsList').append(
                    '<div class="col s6 m3">' +
                    '<div class="card bedCards">' +
                    '<div class="seperate" onmouseover="test(\'' + roomNo + '\', \'' + type + '\', \'' + rate + '\')" onmouseleave="test1(\'' + roomNo + '\', \'' + status + '\')">' +
                    '<p class="roomNo" id="room_' + roomNo + '">Room No ' + roomNo + '</p>' +
                    '<div class="card-image ' + status + '" >' +
                    '<img class="materialboxed" src="includes/images/bed1.png">' +
                    '</div>' +
                    '<div class="card-content" id="content_' + roomNo + '" style="text-align:center;">' +
                    status +
                    '</div>' +
                    '</div>' +
                    '<div class="card-action">' +
                    '<a class="btn-floating btn-flat btn-small waves-effect light-green lighten-2"><i class="material-icons">done</i></a>' +
                    '<a class="btn-floating btn-flat btn-small waves-effect light-blue lighten-2"><i class="material-icons">delete_sweep</i></a>' +
                    '<a class="btn-floating btn-flat btn-small waves-effect orange lighten-2"><i class="material-icons">launch</i></a>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );
            }
        }
    });
}
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
        }
    });
}
// initial loading
$(document).ready(function () {
    $(populateRoomsbyFloor);
    $(populateSummary);
});

//calls sort the rooms by floor
$("#floor").change(function () {
    $('#roomsList').html("");
    $(populateRoomsbyFloor);
});

// Sort by Room status
$("#vacant").click(function () {
    var id = this.id;
    $('#roomsList').html("");
    populateRoomsbyStatus(id);
});
$("#occupied").click(function () {
    var id = this.id;
    $('#roomsList').html("");
    populateRoomsbyStatus(id);
});
$("#cleaning").click(function () {
    var id = this.id;
    $('#roomsList').html("");
    populateRoomsbyStatus(id);
});
$("#maintenance").click(function () {
    var id = this.id;
    $('#roomsList').html("");
    populateRoomsbyStatus(id);
});

// hovering details of room
function test(roomNo, type, rate) {
    $("#room_" + roomNo).text(type);
    $("#content_" + roomNo).text('Php ' + rate);
}
function test1(roomNo, status) {
    $("#room_" + roomNo).text('Room No ' + roomNo);
    $("#content_" + roomNo).text(status);
}

// index.php js up to here