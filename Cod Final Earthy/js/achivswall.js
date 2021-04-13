function heartAchiv(achiv_id) {
    var input = document.getElementById(achiv_id + 'heart').children[0];
    var label = document.getElementById(achiv_id + 'heart').children[1];
    var state;

    if (input.checked == true) {
        input.checked = false;
        label.className = "uncheckedheart";
        state = -1;
        label.innerHTML = "<img src=\"images/black_heart.png\">";
    }
    else {
        input.checked = true;
        label.className = "checkedheart";
        state = 1;
        label.innerHTML = "<img src=\"images/red_heart.png\">";
    }

    $("#heart-counter"+achiv_id).load("includes/like-achiv.inc.php", {
        state: state,
        achiv_id: achiv_id
    });
}   

var achivs = 4;
function showMore() {

    achivs += 4;
    $("#achivs-posts").load("includes/moreAchivs.inc.php", {
        achivs: achivs 
    })

}
