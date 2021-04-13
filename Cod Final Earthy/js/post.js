$(document).ready(function () {
    $("#heart").click(function() {
        
        if ($("#toggle-heart").prop("checked") == true) state = -1;
        else state = 1;

        $("#toggle-heart").load("like-event.inc.php", {
            state: state,
        });
    });
});