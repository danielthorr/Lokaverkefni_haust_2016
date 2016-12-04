$(document).ready(function() {
    $('#logout').click(function() {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "process.php",
            data: "action=logout",
            success: function(html) {
                if (html == 'true') {
                    window.location = "index.php";
                }
            }
        });
        e.preventDefault();
    });
});