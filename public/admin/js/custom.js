$(document).ready(function() {
  
  $("#register-form").on('click',function (event) {
    var username = $("#username").val();
    var password = $("#Password").val();

    $.ajax({
        type: "POST",
        url: 'http://165.22.219.135/fluidad/public/index.php/ApiController/UserRegister',
        // url: 'http://68.183.80.153:5000/v1/user/login',
        // url: 'http://localhost:8080/index.php/ApiController/UserRegister',
        data: {username: username,password: password},
        dataType:"json",//return type expected as json
        success: function(response){
          console.log(response);
        },
    });        
  });



});