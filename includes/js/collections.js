var query = "select checkInId,roomNo,ORNumber,collection,date_format(date_collected, '%M %d, %Y') as date_collected from billing A inner join checkout B on A.checkInId = B.id where date_format(date_collected, '%Y-%m-%d') = curdate()";

$(document).ready(function () { 
    populateCollection();
});

function populateCollection(){
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getCollections.php',
        type: 'POST',
        data: {
            'query' : query
            // 'description' : search
        },
        dataType: 'json',
        success: function (data) {
            loopRoomCollections(data);
        }
    });
}

function loopRoomCollections(data) {
    $('#collectionTable').html("");
    for (var i = 0; i < data.length; i++) {
        var checkInId = data[i].checkInId;
        var roomNo = data[i].roomNo;
        var ORNumber = data[i].ORNumber;
        var collection = data[i].collection;
        var date_collected = data[i].date_collected;

        $('#collectionTable').append(createCollectionsTable(checkInId, roomNo, ORNumber, collection, date_collected));
    }
}

function createCollectionsTable(checkInId, roomNo, ORNumber, collection, date_collected) {
    var myCollections = '<tr>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + ORNumber + '</td>' +
        '<td>' + collection + '</td>' +
        '<td>' + date_collected + '</td>' +
        '<td><a class="btn btn-flat btn-2 tooltipped" data-tooltip="View" onclick="viewReceipt(' + checkInId +')" "><i class="material-icons">pageview</i></a></td>' +
        '</tr>'
    return myCollections;
}
function viewReceipt(checkInId){
    // $.ajax({
    //     url: 'pages/api/getCheckoutDetails.php',
    //     data: "roomNo=" + roomNo,
    //     dataType: 'json',
    //     success: function (data) {
            window.open("pages/pdf/billingReceiptCollection.php?checkInId=" + checkInId);
    //     }
    // });
}
function changeQuery(){
    if ($('#from').val() != "" || $('#from').val() != ""){
        var from = $('#from').val();
        var to = $('#to').val();
        from = getMyDate(from);
        to = getMyDate(to);
        query = "select checkInId,roomNo,ORNumber,collection,date_format(date_collected, '%M %d, %Y') as date_collected from billing A inner join checkout B on A.checkInId = B.id where date_format(date_collected, '%Y-%m-%d') >= '"+ from +"' and date_format(date_collected, '%Y-%m-%d') <= '"+ to +"'";
        populateCollection();
    }
    else{
        displayMessage("","Please Fill in the Date");
    }
    
}