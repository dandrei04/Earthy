function activateLogin() {
    if($(window).width() >= 1000) {
        
        document.getElementById("background-over-login").style.width = "0";
        document.getElementById("center-login").className = "center-login-after";
        document.getElementById("login-box").className = "login-box-after";
        document.getElementById("internet-login").className = "internet-login-after";
        document.getElementById("google-login").className = "google-login-after";
        document.getElementById("fb-login").className = "fb-login-after";
        document.getElementById("or-title-login").className = "or-title-login-after";
        document.getElementById("login-link").className = "login-link-after";


        document.getElementById("background-over-signup").style.width = "100%";
        document.getElementById("center-signup").className = "center-signup-before";
        document.getElementById("signup-box").className = "signup-box-before";
        document.getElementById("internet-signup").className = "internet-signup-before";
        document.getElementById("google-signup").className = "google-signup-before";
        document.getElementById("fb-signup").className = "fb-signup-before";
        document.getElementById("or-title-signup").className = "or-title-signup-before";

        document.getElementById("planet").style.transform = "rotate(0deg)";
        document.getElementById("planet").style.boxShadow = "9px 9px 5px 0 rgba(68, 59, 31, 0.4), -2px -1px 5px 0 rgba(256, 256, 256, 0.4)";
    }
    else {
        activateLogin_responsive();
    }
}


function activateLogin_responsive() {
    document.getElementById("login-signup").style.marginLeft = "-100vw";

    document.getElementById("background-over-login").style.width = "0";
    document.getElementById("center-login").className = "center-login-after";
    document.getElementById("login-box").className = "login-box-after";
    document.getElementById("internet-login").className = "internet-login-after";
    document.getElementById("google-login").className = "google-login-after";
    document.getElementById("fb-login").className = "fb-login-after";
    document.getElementById("or-title-login").className = "or-title-login-after";
    document.getElementById("login-link").className = "login-link-after";


    document.getElementById("background-over-signup").style.width = "100%";
    document.getElementById("center-signup").className = "center-signup-before";
    document.getElementById("signup-box").className = "signup-box-before";
    document.getElementById("internet-signup").className = "internet-signup-before";
    document.getElementById("google-signup").className = "google-signup-before";
    document.getElementById("fb-signup").className = "fb-signup-before";
    document.getElementById("or-title-signup").className = "or-title-signup-before";

    document.getElementById("planet").style.transform = "rotate(0deg)";
    document.getElementById("planet").style.boxShadow = "9px 9px 5px 0 rgba(68, 59, 31, 0.4), -2px -1px 5px 0 rgba(256, 256, 256, 0.4)";

    document.getElementById("login-link-button").style.display = "none";
    document.getElementById("signup-link-button").style.display = "block";
}