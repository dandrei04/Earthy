function heartEvent(event_id) {
    var input = document.getElementById(event_id + 'heart').children[0];
    var label = document.getElementById(event_id + 'heart').children[1];
    var state;

    if (input.checked == true) {
        input.checked = false;
        label.className = "uncheckedheart";
        state = -1;
        label.innerHTML = "<img src=\"images/black_heart.png\">";
    }
    else {
        input.checked = true;
        label.className = "checkedheart";
        state = 1;
        label.innerHTML = "<img src=\"images/red_heart.png\">";
    }

    $("#heart-counter"+event_id).load("includes/like-event.inc.php", {
        state: state,
        event_id: event_id
    });
}   


function goingEvent(event_id) {
    var input = document.getElementById(event_id + 'going').children[0];
    var label = document.getElementById(event_id + 'going').children[1];
    var state;

    if (input.checked == true) {
        input.checked = false;
        label.className = "uncheckedgoing";
        state = -1;
        label.innerHTML = "<img src=\"images/black_going.png\">";
    }
    else {
        input.checked = true;
        label.className = "checkedgoing";
        state = 1;
        label.innerHTML = "<img src=\"images/yellow_going.png\">";
    }

    $("#going-counter"+event_id).load("includes/going-event.inc.php", {
        state: state,
        event_id: event_id
    });
}   

// Show More Events
var events = 4;
function showMore() {

    events += 4;
    $("#events-posts").load("includes/moreEvents.inc.php", {
       events: events 
    })

}


// Toggle between description and details 
function chooseDescription(id) {
    document.getElementById("choose-description" + id).style.backgroundColor = "#79DBB8";
    document.getElementById("choose-description" + id).style.color = "#000000";

    document.getElementById("underline-bar" + id).style.left = "0";
    document.getElementById("underline-bar" + id).style.width = "125px";

    document.getElementById("choose-details" + id).style.backgroundColor = "#5CA68B";

    document.getElementById("center-info-details" + id).style.display = "none";
    document.getElementById("center-info-text" + id).style.display = "block";
}

function chooseDetails(id) {
    document.getElementById("choose-details" + id).style.backgroundColor = "#79DBB8";
    document.getElementById("choose-details" + id).style.color = "#000000";

    document.getElementById("underline-bar" + id).style.left = "125px";
    document.getElementById("underline-bar" + id).style.width = "100px";
    
    document.getElementById("choose-description" + id).style.backgroundColor = "#5CA68B";

    document.getElementById("center-info-details" + id).style.display = "block";
    document.getElementById("center-info-text" + id).style.display = "none";
}