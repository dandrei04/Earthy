// Toggle between 
function chooseAbout() {
    document.getElementById("progress").style.backgroundColor = "transparent";
    document.getElementById("progress").style.color = "#2695B8";
    document.getElementById("progress").style.textShadow = ".5px .5px #2695B8";

    document.getElementById("bar").style.width = "100px";
    document.getElementById("bar").style.left = "0";

    document.getElementById("future-events").style.backgroundColor = "transparent";
    document.getElementById("future-events").style.color = "#000000";
    document.getElementById("future-events").style.textShadow = ".5px .5px #ffffff";

    document.getElementById("about").style.display = "block";
    document.getElementById("myevents").style.display = "none";
}

function chooseEvents() {
    document.getElementById("future-events").style.backgroundColor = "transparent";
    document.getElementById("future-events").style.color = "#2695B8";
    document.getElementById("future-events").style.textShadow = ".5px .5px #2695B8";

    document.getElementById("bar").style.width = "150px";
    document.getElementById("bar").style.left = "100px";

    document.getElementById("progress").style.backgroundColor = "transparent";
    document.getElementById("progress").style.color = "#000000";
    document.getElementById("progress").style.textShadow = ".5px .5px #ffffff";

    document.getElementById("about").style.display = "none";
    document.getElementById("myevents").style.display = "block";
}

// Make gradient bar 
function fillBar(percentage) {
    document.getElementById("level-bar").style.background = "linear-gradient(to right, #e2264d " + percentage + "%, #AFCCB8 " + percentage + "%)";
}

// Make the openEvent_part 
window.onload = function() {
    document.onclick = function(e) {
        if (e.target.id == 'open_readEvent') {
            read_event = document.getElementById("readEvent");
            transparent_background = document.getElementById("over-background");

            read_event.style.top = "5rem";
            read_event.style.left = "50%";
            read_event.style.transform = "translateX(-50%)";
            read_event.style.opacity = "1";

            transparent_background.style.width = "100vw";
            transparent_background.style.height = "100vh";
        }
        else if (e.target.id == 'over-background'){
            read_event = document.getElementById("readEvent");
            transparent_background = document.getElementById("over-background");

            read_event.style.top = "0";
            read_event.style.left = "50%";
            read_event.style.transform = "translate(-50%, -100%)";
            read_event.style.opacity = "0";

            transparent_background.style.width = "0vw";
            transparent_background.style.height = "0vh";
        }
    }
}

// Read future events
function readEvent(event_id) {
    $(document).ready(function () {
    $("#readEvent").load("includes/readEvent.inc.php", {
        event_id: event_id
    });
    });
}

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

// Check if the current window is duplicate window 
$(document).ready(function () {
    if (window.IsDuplicate()) {
        alert("This is a duplicated window! Go back to your main window!");
        document.getElementsByTagName("body")[0].style.display = "none";
    }
});

// Resize if the width changes 
old_width = window.innerWidth;
window.onresize = function() { 
    new_width = window.innerWidth;

    if(Math.abs(old_width - new_width) >= 10) {
        old_width = new_width;
        this.location.reload();
    }
}
