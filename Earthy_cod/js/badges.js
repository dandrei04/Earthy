function activateBadge(id) {
    for (i=1; i<=10; i++) {
        if (document.getElementById("input_ck" + i)) {
            document.getElementById("input_ck" + i).checked = false;
        }
    }    

    document.getElementById("input_ck" + id).checked = true;
}

function chooseBadge(id, badge_distinction) {
    $("#ajax-load-div-badge").load("includes/chooseBadge.inc.php", {
        badge_distinction: badge_distinction 
    });
    activateBadge(id);
}

