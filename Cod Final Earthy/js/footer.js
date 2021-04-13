window.onresize = function(event) {
    //document.location.reload(true);
}
  
var opacity = [-1, 1, 2, 3, 1, 3, 2, 1, 2, 3, 2, 1, 2, 3, 1, 2, 3, 1, 2, 1, 2, 1, 2, 1, 2, 3, 2, 1, 3, 2, 1, 2, 3, 1, 2, 3, 1, 2];
var height = [0, 16, 52, 5, 38, 8, 57, 12, 59, 12, 44, 10, 60, 19, 69, 6, 43, 12, 55, 22, 63, 3, 34, 68, 16, 56, 19, 60, 19, 68, 16, 55, 21, 61, 2, 46, 6, 50];
var left = [0, -446, -346, -222, -91, 8, 170, 299, 395, 558, 654, 774, 910, 998, 1110, 1266, 1380, 1465, 1608, 1708, 1844, 1993, 2074, 2198, 2341, 2479, 2540, 2678, 2821, 2945, 3046, 3180, 3280, 3382, 3493, 3641, 3755, 3879];

var width = document.getElementById("footer").offsetWidth;
var actualX = -4, i=1, addX = 0;


while(actualX <= width*2) {

    if(i==38) {
        addX = actualX;
        i=1;
    }

    var mountain = document.createElement("div");
    var mountain_top = document.createElement("div");
    var mountain_cap1 = document.createElement("div");
    var mountain_cap2 = document.createElement("div");
    var mountain_cap3 = document.createElement("div");
    
    mountain.className = "mountain";
    mountain_top.className = "mountain-top";
    mountain_cap1.className = "mountain-cap-1";
    mountain_cap2.className = "mountain-cap-2";
    mountain_cap3.className = "mountain-cap-3";

    mountain.appendChild(mountain_top);
    mountain_top.appendChild(mountain_cap1);
    mountain_top.appendChild(mountain_cap2);
    mountain_top.appendChild(mountain_cap3);

    mountain.style.left = addX + left[i] + "px";
    actualX = addX + left[i];
    mountain.style.bottom = "-" + height[i] + "px";

    if (opacity[i] == 1) {
        mountain.style.filter = "brightness(100%)";
        mountain.style.zIndex = "3";
    }
    else if (opacity[i] == 2) {
        mountain.style.filter = "brightness(90%)";
        mountain.style.zIndex = "2";
    }
    else {
        mountain.style.filter = "brightness(80%)";
        mountain.style.zIndex = "1";

    }

    document.getElementById("footer").appendChild(mountain);
    i++;
}
