function getCurrentDate(){
    var d = new Date();

    var month = d.getMonth() + 1;
    var day = d.getDate();

    var currentDate =
         d.getFullYear() + '-' +
        (('' + month).length < 2 ? '0' : '') + month + '-' +
        (('' + day).length < 2 ? '0' : '') + day;

    return currentDate;
}
function getCurdate1(){
    var d = new Date();

    var month = d.getMonth() + 1;
    var day = d.getDate();

    var currentDate =
        (('' + month).length < 2 ? '0' : '') + month + '-' +
        (('' + day).length < 2 ? '0' : '') + day + '-' +
        d.getFullYear();

    return currentDate;
}

function getMyDate(date1){

    var today = new Date(date1);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    
    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    } 

    mydate = yyyy + '-' + mm + '-' + dd;
    return mydate;
}

function getMyDateTime(date1) {

    var today = new Date(date1);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    mydate = yyyy + '-' + mm + '-' + dd + ' 23:59:59';
    return mydate;
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function displayMessage(title, content){
    $.alert({
        title: title,
        content: content,
        theme: 'material',
        boxWidth: '35%',
        useBootstrap: false,
    });
}

function convert(x){
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function parseDate(str) {
    var mdy = str.split('/');
    return new Date(mdy[2], mdy[0] - 1, mdy[1]);
}

function datediff(first, second) {
    return Math.round((second - first) / (1000 * 60 * 60 * 24));
}

function removeComma(str){
    var mystr = str.replace(",", "");
    return mystr;
}

function forPagination(table, filter, returnFunction) {
    $.getScript("includes/js/pagination.js", function () { getPaginationData(table, filter, returnFunction); });
}