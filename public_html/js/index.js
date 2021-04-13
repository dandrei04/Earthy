$(document).ready(function() {
    // Make the curved title 
    var suma = 91;

    for (i = 1; i <= 17; i++) {
        suma -= 10;
        document.getElementsByClassName('chara')[i-1].style.transform = "rotate(" + suma + "deg)";;
    }
});

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