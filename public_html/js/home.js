document.addEventListener("DOMContentLoaded", function() {
    new_posLeft = document.getElementById("body").offsetLeft;
    width = document.getElementById("body").offsetWidth;

    document.getElementById("top10").style.left = 25+ new_posLeft + width + "px";
    document.getElementById("sidenavbar2").style.visibility = "visible";


    posLeft = document.getElementById("sidenavbar1").offsetLeft;
    document.getElementById("sidenavbar2").style.left = posLeft + "px";
    document.getElementById("sidenavbar2").style.visibility = "visible";
});

window.onresize = function(event) {
    new_posLeft = document.getElementById("body").offsetLeft;
    width = document.getElementById("body").offsetWidth;

    document.getElementById("top10").style.left = 25+ new_posLeft + width + "px";
    document.getElementById("sidenavbar2").style.visibility = "visible";


    posLeft = document.getElementById("sidenavbar1").offsetLeft;
    document.getElementById("sidenavbar2").style.left = posLeft + "px";
    document.getElementById("sidenavbar2").style.visibility = "visible";
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