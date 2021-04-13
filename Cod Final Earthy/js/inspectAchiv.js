// Inspect Achiv to collect points 
function inspectAchiv(achiv_id) {
    $("#inspectAchiv").load("includes/inspectAchiv.inc.php", {
        achiv_id: achiv_id
    });
}
