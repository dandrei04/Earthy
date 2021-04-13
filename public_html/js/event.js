// Choose profile pic 
function imagehover() {
    document.getElementById("image").style.filter = "brightness(80%)";
    document.getElementById("camera").style.opacity = "1";
}

function imagenohover() {
    document.getElementById("image").style.filter = "brightness(100%)";
    document.getElementById("camera").style.opacity = "0";
}


// Make event to appear/disappear
function openEvent() {
    event = document.getElementById("event");
    transparent_background = document.getElementById("transparent-background");

    event.style.top = "2rem";
    event.style.left = "50%";
    event.style.transform = "translateX(-50%)";
    event.style.opacity = "1";

    transparent_background.style.width = "100%";
    transparent_background.style.height = "100%";
    transparent_background.style.position = "fixed";  
}


// Change image with JQuery 
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#image").css("background-image", "url(" + e.target.result + ")");
        };

        reader.readAsDataURL(input.files[0]);
    }
}


// The time input 
var i;
for(i=0;i<=23;i++) {
    var option = document.createElement("option");
    option.value = i;
    
    if (i < 10) { option.innerHTML = '0' + i;}
    else option.innerHTML = i;

    document.getElementById("hour").appendChild(option);
}


for(i=0;i<=59;i++) {
    var option = document.createElement("option");
    option.value = i;
    
    if (i < 10) { option.innerHTML = '0' + i;}
    else option.innerHTML = i;

    document.getElementById("minute").appendChild(option);
}
