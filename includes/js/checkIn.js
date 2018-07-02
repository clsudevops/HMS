function populateRoomDetails() {
    var roomNo = $('#room_no').val();
    $('#room_type').val("");
    $('#floor').val("");
    $('#rate').val("");
    $('#rateperhour').val("");

    $.ajax({
        url: 'pages/api/getRoomDetails.php',
        data: "roomNo=" + roomNo,
        dataType: 'json',
        success: function (data) {
            $('#room_type').val(data[0].type);
            $('#floor').val(data[0].floor);
            $('#rate').val(data[0].rate);
            $('#rateperhour').val(data[0].rateperhour);
        }
    });
}
$(document).ready(function () {
    populateRoomDetails();
    $('#room_no').blur(function () {
        populateRoomDetails();
    });
    $('#forPersonal').on('click',function(){
        $('.forCompanyDiv').css("display", "none");
    });
    $('#forCompany').on('click', function () {
        $('.forCompanyDiv').css("display", "block");
    });
});