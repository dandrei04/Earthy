// Check if the current window is duplicate window 
$(document).ready(function () {
    if (window.IsDuplicate()) {
        alert("This is a duplicated window! Go back to your main window!");
        document.getElementsByTagName("body")[0].style.display = "none";
    }
});

// Prob from old version - might delete later 
function changeSlide(id) {

    document.getElementById("events").style.display = "none";
    document.getElementById("achivs").style.display = "none";
    document.getElementById("notes").style.display = "none";

    if (id == 'ev') document.getElementById("events").style.display = "block";
    else if (id == 'ach') document.getElementById("achivs").style.display = "block";
    else document.getElementById("notes").style.display = "block";
}


// Ask before the user deletes an event/achiv/idea 
function confirm_before_delete(type, id) {
    if(confirm("Are you sure you want to delete it? You will never get it back!")) {
        document.getElementById(type + id).click();
    }
}


// Toggle on responsive mode 
function choose_divEvents() {
    document.getElementById("event-box").style.display = "block";
    document.getElementById("choose-div-top-bar2").style.display = "block";

    document.getElementById("achiv-box").style.display = "none";
    document.getElementById("choose-div-top-bar1").style.display = "none";
}


function choose_divAchivs() {
    document.getElementById("achiv-box").style.display = "block";
    document.getElementById("choose-div-top-bar1").style.display = "block";

    document.getElementById("event-box").style.display = "none";
    document.getElementById("choose-div-top-bar2").style.display = "none";
}

// Resize if the width changes 
old_width = window.innerWidth;
window.onresize = function() { 
    new_width = window.innerWidth;

    if(Math.abs(old_width - new_width) >= 10) {
        old_width = new_width;
        this.location.reload();
    }
}