$(document).ready(function () {
    $(populateFoods());

    $("#submitFoods").on("click", function () {
        var menuName = $('#menuName').val();
        var servings = $('#servings').val();
        var cost = $('#cost').val();
        var price = $('#price').val();

        if (menuName != "" && servings != "" && cost != "" && price != "") {
            $.ajax({
                url: 'pages/api/insertFoods.php',
                type: "POST",
                data: "menuName=" + menuName + "&servings=" + servings + "&cost=" + cost + "&price=" + price,
                success: function () {
                    $('#menuName').val(""); $('#servings').val(""); $('#cost').val(""); $('#price').val("");
                    populateFoods()
                }
            });
        }
    });

    $("#searchFoods").on("click", function () {
        populateFoods();
    });
    $("#search").on("keyup", function () {
        populateFoods();
    });
});

function populateFoods() {
    var search = $('#search').val();
    $.ajax({
        url: 'pages/api/getFoods.php',
        data: "menu=" + search,
        dataType: 'json',
        success: function (data) {
            loopFoods(data);
            M.AutoInit();
        }
    });
}

function loopFoods(data) {
    $('#foodsTable').html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id;
        var menu = data[i].menuName;
        var servings = data[i].servings;
        var cost = data[i].cost;
        var price = data[i].sellingPrice;
        var status = data[i].status;

        $('#foodsTable').append(createFoodsTable(id, menu, servings, cost, price, status));
    }
}

function createFoodsTable(id, menu, servings, cost, price, status){
    var myRoomType = '<tr>' +
        '<td>' + menu + '</td>' +
        '<td>' + servings + '</td>' +
        '<td>' + cost + '</td>' +
        '<td>' + price + '</td>' +
        '<td><a class="btn btn-flat btn-2 tooltipped" data-tooltip="Delete" onclick="deleteFoods(' + id + ')" "><i class="material-icons">delete</i></a></td>' +
        '</tr>'
    return myRoomType;
}

function deleteFoods(id) {
    $.ajax({
        url: 'pages/api/deleteFoods.php',
        type: "POST",
        data: "id=" + id,
        success: function () {
            populateFoods();
            $.alert({
                title: 'Status',
                content: 'Menu Deleted Succesfully!!!',
                boxWidth: '40%',
                theme: 'dark',
                useBootstrap: false
            });
            M.AutoInit();
        }
    });
}
