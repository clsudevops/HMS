function changePage(i, returnfunction){
    curpage = i
    console.log(curpage);
    window[returnfunction](i);
}

function changeRight(returnfunction, noOfPage){
    if (curpage < Math.floor(noOfPage)){
        curpage = parseInt(curpage) + 1;
        window[returnfunction](curpage);  
    }
}

function changeLeft(returnfunction) {
    console.log(curpage);
    if (curpage > 1) {
        curpage = parseInt(curpage) - 1;
        window[returnfunction](curpage);
    }
}

function createMyPagination(noOfPage, returnfunction) {
    // console.log(noOfPage);
    if(Math.floor(noOfPage) > 1){
        $('#pagination').html("");
        $('#pagination').append(createPagination(noOfPage, returnfunction));
        $("#page_" + curpage).addClass("active");
    }
    else{
        $('#pagination').html("");
    }
}

function createPagination(noOfPage, returnfunction) {
    var myPagination = '<li class="" id="move-left" onclick="changeLeft( \'' + returnfunction + '\')"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';

    for (var i = 1; i <= noOfPage; i++) {
        myPagination = myPagination + '<li class="waves-effect" onclick="changePage(\'' + i + '\', \'' + returnfunction + '\')" id="page_' + i + '"><a>' + i + '</a></li>'
    }

    myPagination = myPagination + '<li id="move-right" class="waves-effect" onclick="changeRight( \'' + returnfunction + '\',\'' + noOfPage + '\')"><a href="#!"><i class="material-icons">chevron_right</i></a></li>'
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