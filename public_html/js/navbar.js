counter_nav = 0;

$(document).ready(function(){
	$('#open-nav').click(function() {
		$(this).toggleClass('open');
        
        counter_nav++;

        if (counter_nav % 2 == 1) {
            document.getElementById("sidenavbar").style.visibility = "visible";
            document.getElementById("sidenavbar").style.width = "200px";
            document.getElementById("sidenavbar").style.padding = "1rem 1rem";
        }
        else {
            document.getElementById("sidenavbar").style.visibility = "hidden";
            document.getElementById("sidenavbar").style.width = "0px";
            document.getElementById("sidenavbar").style.padding = "1rem 0";
        }
    });
});