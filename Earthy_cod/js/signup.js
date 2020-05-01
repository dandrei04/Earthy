function activateSignup() {

    console.log("DA");

    if($(window).width() >= 1000) {
        
        document.getElementById("background-over-login").style.width = "100%";
        document.getElementById("center-login").className = "center-login-before";
        document.getElementById("login-box").className = "login-box-before";
        document.getElementById("internet-login").className = "internet-login-before";
        document.getElementById("google-login").className = "google-login-before";
        document.getElementById("fb-login").className = "fb-login-before";
        document.getElementById("or-title-login").className = "or-title-login-before";
        document.getElementById("login-link").className = "login-link-before";


        document.getElementById("background-over-signup").style.width = "0";
        document.getElementById("center-signup").className = "center-signup-after";
        document.getElementById("signup-box").className = "signup-box-after";
        document.getElementById("internet-signup").className = "internet-signup-after";
        document.getElementById("google-signup").className = "google-signup-after";
        document.getElementById("fb-signup").className = "fb-signup-after";
        document.getElementById("or-title-signup").className = "or-title-signup-after";

        document.getElementById("planet").style.transform = "rotate(+180deg)";
        document.getElementById("planet").style.boxShadow = "9px -9px 5px 0 rgba(68, 59, 31, 0.4), -2px -1px 5px 0 rgba(256, 256, 256, 0.4)";
    
    }
    else {
        activateSignup_responsive();
    }
}


function activateSignup_responsive() {
    document.getElementById("login-signup").style.marginLeft = "0";

    document.getElementById("background-over-login").style.width = "100%";
    document.getElementById("center-login").className = "center-login-before";
    document.getElementById("login-box").className = "login-box-before";
    document.getElementById("internet-login").className = "internet-login-before";
    document.getElementById("google-login").className = "google-login-before";
    document.getElementById("fb-login").className = "fb-login-before";
    document.getElementById("or-title-login").className = "or-title-login-before";
    document.getElementById("login-link").className = "login-link-before";


    document.getElementById("background-over-signup").style.width = "0";
    document.getElementById("center-signup").className = "center-signup-after";
    document.getElementById("signup-box").className = "signup-box-after";
    document.getElementById("internet-signup").className = "internet-signup-after";
    document.getElementById("google-signup").className = "google-signup-after";
    document.getElementById("fb-signup").className = "fb-signup-after";
    document.getElementById("or-title-signup").className = "or-title-signup-after";

    document.getElementById("planet").style.transform = "rotate(+180deg)";
    document.getElementById("planet").style.boxShadow = "9px -9px 5px 0 rgba(68, 59, 31, 0.4), -2px -1px 5px 0 rgba(256, 256, 256, 0.4)";

    document.getElementById("signup-link-button").style.display = "none";
    document.getElementById("login-link-button").style.display = "block";
}
