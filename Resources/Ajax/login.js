$(document).ready(function() {
   $('#loginform-in').submit(function(e) {
       e.preventDefault();

       $.ajax({
           type: "POST",
           url: "login_process.php",
           data: $('#loginform-in').serialize(),
           success: function(html) {
               if (html == 'true') {
                   setTimeout('window.location.href = "index-test.php"; ',4000);
               } else {
                   $('#login-error').css('display', 'inline', 'important');
                   $('#login-error').html("Wrong username or password");
               }
           },
           error: function() {
               alert("Failed");
           },
           /*beforeSend:function() {
               $('#login-error').css('display', 'inline', 'important');
               $('#login-error').html("Loading...");
           }*/
       });
       e.preventDefault();
       return false;
   });
});