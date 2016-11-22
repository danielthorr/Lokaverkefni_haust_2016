$(document).ready(function() {
   $('#login').click(function() {
       username = $('#username').val();
       password = $('#password').val();

       $.ajax({
           type: "POST",
           url: "process.php?action=login",
           data: "username=" + username + "&password=" + password,
           success: function(html) {
               if (html == 'true') {
                   window.location = "index-test.php";
               } else {
                   $('#login-error').css('display', 'inline', 'important');
                   $('#login-error').html("Wrong username or password");
               }
           },
           beforeSend:function() {
               $('#login-error').css('display', 'inline', 'important');
               $('#login-error').html("Loading...");
           }
       });
       return false;
   });
});