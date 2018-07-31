
function changePage(i, returnfunction){
    curpage = i
    // alert(returnfunction);
    window[returnfunction](i);
}
function createMyPagination(noOfPage, returnfunction) {
    $('#pagination').html("");
    $('#pagination').append(createPagination(noOfPage, returnfunction));
    $("#page_" + curpage).addClass("active");
}

function createPagination(noOfPage, returnfunction) {
    var myPagination = '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';

    for (var i = 1; i <= noOfPage; i++) {
        myPagination = myPagination + '<li class="waves-effect" onclick="changePage(\'' + i + '\', \'' + returnfunction + '\')" id="page_' + i + '"><a>' + i + '</a></li>'
    }

    myPagination = myPagination + '<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>'
    return myPagination;
}

function getPaginationData(table, filtering , returnfunction) {
    $.ajax({
        url: 'pages/api/getDataCount.php',
        data: {
            tableName: table,
            filtering: filtering,
        },
        dataType: 'json',
        success: function (data) {
            var noOfPage = 0
            if (data[0].count % 10 != 0) {
                noOfPage = (data[0].count / 10) + 1
            }
            else {
                noOfPage = (data[0].count / 10)
            }
            createMyPagination(noOfPage, returnfunction);
        }
    });
}