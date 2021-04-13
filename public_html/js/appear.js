window.onload = function() {
    document.onclick = function(e) {
        if (e.target.id == 'openEvent') {
            event = document.getElementById("event");
            transparent_background = document.getElementById("transparent-background");
            sidenav = document.getElementById("sidenavbar");

            event.style.top = "2rem";
            event.style.left = "50%";
            event.style.transform = "translateX(-50%)";
            event.style.opacity = "1";

            transparent_background.style.width = "100%";
            transparent_background.style.height = "110vh";
            transparent_background.style.position = "fixed";

            if (counter_nav % 2 == 1) {
                sidenav.style.visibilty = "hidden";
                sidenav.style.width = "0px";
                sidenav.style.padding = "1rem 0";
                counter_nav++;
                $('#open-nav').toggleClass('open');
            }
        }
        else if (e.target.id == 'openAchiv') {
            achievement = document.getElementById("achievement");
            transparent_background = document.getElementById("transparent-background");
            sidenav = document.getElementById("sidenavbar");

            achievement.style.top = "6rem";
            achievement.style.left = "50%";
            achievement.style.transform = "translateX(-50%)";
            achievement.style.opacity = "1";

            transparent_background.style.width = "100%";
            transparent_background.style.height = "110vh";
            transparent_background.style.position = "fixed";

            if (counter_nav % 2 == 1) {
                sidenav.style.visibilty = "hidden";
                sidenav.style.width = "0px";
                sidenav.style.padding = "1rem 0";
                counter_nav++;
                $('#open-nav').toggleClass('open');
            }
        }
        else if(e.target.id == 'open_inspectEvent') {
            inspect_event = document.getElementById("inspectEvent");
            transparent_background = document.getElementById("transparent-background");
            sidenav = document.getElementById("sidenavbar");

            inspect_event.style.top = "5rem";
            inspect_event.style.left = "50%";
            inspect_event.style.transform = "translateX(-50%)";
            inspect_event.style.opacity = "1";

            transparent_background.style.width = "100%";
            transparent_background.style.height = "110vh";
            transparent_background.style.position = "fixed";
            
            if (counter_nav % 2 == 1) {
                sidenav.style.visibilty = "hidden";
                sidenav.style.width = "0px";
                sidenav.style.padding = "1rem 0";
                counter_nav++;
                $('#open-nav').toggleClass('open');
            }
        }
        else if(e.target.id == 'open_inspectAchiv') {
            inspect_achiv = document.getElementById("inspectAchiv");
            transparent_background = document.getElementById("transparent-background");
            sidenav = document.getElementById("sidenavbar");

            inspect_achiv.style.top = "5rem";
            inspect_achiv.style.left = "50%";
            inspect_achiv.style.transform = "translateX(-50%)";
            inspect_achiv.style.opacity = "1";

            transparent_background.style.width = "100%";
            transparent_background.style.height = "110vh";
            transparent_background.style.position = "fixed";

            if (counter_nav % 2 == 1) {
                sidenav.style.visibilty = "hidden";
                sidenav.style.width = "0px";
                sidenav.style.padding = "1rem 0";
                counter_nav++;
                $('#open-nav').toggleClass('open');
            }
        }
        else if (e.target.id == 'transparent-background' || e.target.id == 'cancel') {
            
            inspect_event = document.getElementById("inspectEvent");
            inspect_achiv = document.getElementById("inspectAchiv");
            event = document.getElementById("event");
            achievement = document.getElementById("achievement");
            transparent_background = document.getElementById("transparent-background");
            
            inspect_achiv.style.top = "0";
            inspect_achiv.style.left = "50%";
            inspect_achiv.style.transform = "translate(-50%, -100%)";
            inspect_achiv.style.opacity = "0";

            inspect_event.style.top = "0";
            inspect_event.style.left = "50%";
            inspect_event.style.transform = "translate(-50%, -100%)";
            inspect_event.style.opacity = "0";

            event.style.top = "0";
            event.style.left = "50%";
            event.style.transform = "translate(-50%, -100%)";
            event.style.opacity = "0";

            achievement.style.top = "0";
            achievement.style.left = "50%";
            achievement.style.transform = "translate(-50%, -100%)";
            achievement.style.opacity = "0";
            
            transparent_background.style.width = "0";
            transparent_background.style.height = "0";
            transparent_background.style.position = "fixed";
        }
    }
}
