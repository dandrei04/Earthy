// Choose profile pic 
function imagehover() {
    document.getElementById("image").style.filter = "brightness(80%)";
    document.getElementById("camera").style.opacity = "1";
}

function imagenohover() {
    document.getElementById("image").style.filter = "brightness(100%)";
    document.getElementById("camera").style.opacity = "0";
}

// Change image with JQuery 
function readURLnew(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#new_image").css("background-image", "url(" + e.target.result + ")");
        };

        reader.readAsDataURL(input.files[0]);
    }
}


