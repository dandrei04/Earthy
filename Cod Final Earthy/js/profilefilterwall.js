
filter_state1=0;
filter_state2=0;

function openFilter(type) {

    if (type == 1) {

        if (filter_state1%2 == 0) {
            filter_state1++;
            document.getElementById("filter-form1").style.height="300px";
            document.getElementById("filter-form1").style.borderBottom = "7px solid #D6D6D6";
        }

        else {
            filter_state1++;
            document.getElementById("filter-form1").style.height="0";
            document.getElementById("filter-form1").style.borderBottom = "none";
        }
    }

    else {
        if (filter_state2%2 == 0) {
            filter_state2++;
            document.getElementById("filter-form2").style.height="120px";
            document.getElementById("filter-form2").style.borderBottom = "7px solid #D6D6D6";
        }

        else {
            filter_state2++;
            document.getElementById("filter-form2").style.height="0";
            document.getElementById("filter-form2").style.borderBottom = "none";
        }
    }
}

