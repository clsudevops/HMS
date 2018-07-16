$('#sign_in').on("click",function(){
    var username = $('#username').val();
    var password = $('#password').val();
    if(username != "" && password != ""){
        $.ajax({
            url: 'pages/api/getLogin.php',
            data: {
                username: username,
                password: password
            },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.length != 0) {
                    var type = data[0].accountType;
                    $.ajax({
                        url: 'setSession.php',
                        data: {
                            username: username,
                            type: type
                        },
                        type: 'POST',
                        success: function (data) {
                            window.location = "index.php";
                        }
                    });
                }
                else {
                    displayMessage("", "Incorrect Username or Password");
                }
            }
        });
    }
    else{
        displayMessage("", "Please provide input for username or password");
    }
    
});