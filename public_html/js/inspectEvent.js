// Toggle between description and details 
function chooseDescription() {
    document.getElementById("choose-description").style.backgroundColor = "#79DBB8";
    document.getElementById("choose-description").style.color = "#000000";

    document.getElementById("underline-bar").style.left = "0";
    document.getElementById("underline-bar").style.width = "125px";

    document.getElementById("choose-details").style.backgroundColor = "#5CA68B";

    document.getElementById("inspect-info-details").style.display = "none";
    document.getElementById("inspect-info-text").style.display = "block";
}

function chooseDetails(id) {
    document.getElementById("choose-details").style.backgroundColor = "#79DBB8";
    document.getElementById("choose-details").style.color = "#000000";

    document.getElementById("underline-bar").style.left = "125px";
    document.getElementById("underline-bar").style.width = "100px";
    
    document.getElementById("choose-description").style.backgroundColor = "#5CA68B";

    document.getElementById("inspect-info-details").style.display = "block";
    document.getElementById("inspect-info-text").style.display = "none";
}

// Check All 
function checkAll(number_rows) {
    for (i = 0; i < number_rows; i++) {
       document.getElementsByClassName("inputcheck")[i].checked = document.getElementById("check-all").checked;
    }
}

// Inspect Event to collect points 
function inspectEvent(event_id) {
    $("#inspectEvent").load("includes/inspectEvent.inc.php", {
        event_id: event_id
    });
}
