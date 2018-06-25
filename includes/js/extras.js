$(document).ready(function () {
    $(populateExtras());

    $("#submitExtra").on("click", function () {
        var description = $('#description').val();
        var cost = $('#cost').val();
        if (description != "" && cost != "") {
            $.ajax({
                url: 'pages/api/insertExtras.php',
                type: "POST",
                data: "description=" + description + "&cost=" + cost,
                success: function () {
                    $('#description').val("");
                    $('#cost').val("");
                    populateExtras();
                }
            });
        }
    });

    $("#search").on("keyup", function () {
        populateExtras();
    });
});

function populateExtras() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getExtras.php',
        data: "description=" + search,
        dataType: 'json',
        success: function (data) {
            loopRoomTypes(data);
            M.AutoInit();
        }
    });
}

function loopRoomTypes(data) {
    $('#extraTable').html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id;
        var description = data[i].description;
        var cost = data[i].cost;

        $('#extraTable').append(createExtraTable(id, description, cost));
    }
}

function createExtraTable(id, description, cost) {
    var myExtra = '<tr>' +
        '<td>' + description + '</td>' +
        '<td>' + cost + '</td>' +
        '<td><a class="btn btn-flat btn-2 tooltipped" data-tooltip="Delete" onclick="deleteExtra(' + id + ')" "><i class="material-icons">delete</i></a></td>' +
        '</tr>'
    return myExtra;
}

function deleteExtra(id) {
    $.ajax({
        url: 'pages/api/deleteExtras.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateExtras();
            M.AutoInit();
        }
    });
}
