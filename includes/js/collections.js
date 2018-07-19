var query = "select roomNo,ORNumber,collection,date_collected from billing A inner join checkout B on A.checkInId = B.id";

$(document).ready(function () { 

});

function printCollection(){
    alert(query);
}

function changeQuery(){
    if ($('#from').val() != "" || $('#from').val() != ""){
        var from = $('#from').val();
        var to = $('#to').val();
        from = getMyDate(from);
        to = getMyDate(to);
        query = "select roomNo,ORNumber,collection,date_collected from billing A inner join checkout B on A.checkInId = B.id where date_collected between '" + from + "' and '" + to + "'";
    }
    else{
        displayMessage("","Please Fill in the Date");
    }
    
}

// function populateCollections(){
//     var search = $('#search').val();
//     $.ajax({
//         url: 'pages/api/getExtras.php',
//         data: "description=" + search,
//         dataType: 'json',
//         success: function (data) {
//             loopRoomTypes(data);
//             M.AutoInit();
//         }
//     });
// }
// function loopRoomTypes(data) {
//     $('#extraTable').html("");
//     for (var i = 0; i < data.length; i++) {
//         var id = data[i].id;
//         var description = data[i].description;
//         var cost = data[i].cost;

//         $('#extraTable').append(createExtraTable(id, description, cost));
//     }
// }

// function createExtraTable(id, description, cost) {
//     var myExtra = '<tr>' +
//         '<td>' + description + '</td>' +
//         '<td>' + cost + '</td>' +
//         '<td><a class="btn btn-flat btn-2 tooltipped" data-tooltip="Delete" onclick="deleteExtra(' + id + ')" "><i class="material-icons">delete</i></a></td>' +
//         '</tr>'
//     return myExtra;
// }