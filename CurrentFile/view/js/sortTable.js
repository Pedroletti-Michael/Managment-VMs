//These function (sortTable and sortNumberTable) can only be used in table with id == tableInventoryVm
function sortTable(n, whichTable) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0, last_n;

    if(whichTable == 0){
        if(document.getElementById("allVmBody").hidden == false){
            table = document.getElementById("allVmBody");
        }
        else if(document.getElementById("allValidatedVmBody").hidden == false){
            table = document.getElementById("allValidatedVmBody");
        }
        else if(document.getElementById("allConfirmationVmBody").hidden == false){
            table = document.getElementById("allConfirmationVmBody");
        }
        else if(document.getElementById("allRenewalVmBody").hidden == false){
            table = document.getElementById("allRenewalVmBody");
        }
        else if(document.getElementById("allNonRenewalVmBody") == false){
            table = document.getElementById("allNonRenewalVmBody");
        }
        else if(document.getElementById("allDeletedVmBody").hidden == false){
            table = document.getElementById("allDeletedVmBody");
        }
    }
    else if(whichTable == 1){
        table = document.getElementById("tableInventoryUser");
    }
    else if(whichTable == 2){
        table = document.getElementById("confirmationTable");
    }
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
    numberOfClick(n,dir);
}

function sortNumberTable(n, whichTable) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    if(whichTable == 0){
        if(document.getElementById("allVmBody").hidden == false){
            table = document.getElementById("allVmBody");
        }
        else if(document.getElementById("allValidatedVmBody").hidden == false){
            table = document.getElementById("allValidatedVmBody");
        }
        else if(document.getElementById("allConfirmationVmBody").hidden == false){
            table = document.getElementById("allConfirmationVmBody");
        }
        else if(document.getElementById("allRenewalVmBody").hidden == false){
            table = document.getElementById("allRenewalVmBody");
        }
        else if(document.getElementById("allNonRenewalVmBody") == false){
            table = document.getElementById("allNonRenewalVmBody");
        }
        else if(document.getElementById("allDeletedVmBody").hidden == false){
            table = document.getElementById("allDeletedVmBody");
        }
    }
    else if(whichTable == 1){
        table = document.getElementById("tableInventoryUser");
    }
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
    numberOfClick(n,dir);
}


function sortTablePlus(n, which){
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    if(which == 0){
        if(document.getElementById("allVmBody").hidden == false){
            table = document.getElementById("allVmBody");
        }
        else if(document.getElementById("allValidatedVmBody").hidden == false){
            table = document.getElementById("allValidatedVmBody");
        }
        else if(document.getElementById("allConfirmationVmBody").hidden == false){
            table = document.getElementById("allConfirmationVmBody");
        }
        else if(document.getElementById("allRenewalVmBody").hidden == false){
            table = document.getElementById("allRenewalVmBody");
        }
        else if(document.getElementById("allNonRenewalVmBody") == false){
            table = document.getElementById("allNonRenewalVmBody");
        }
        else if(document.getElementById("allDeletedVmBody").hidden == false){
            table = document.getElementById("allDeletedVmBody");
        }
    }
    else if(which == 1){
        table = document.getElementById("tableInventoryUser");
    }

    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (Number(x.id) > Number(y.id)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (Number(x.id) < Number(y.id)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
    numberOfClick(n,dir);
}

function numberOfClick(n,dir){
    if(document.getElementById("allVmBody").hidden == false){
        for (var i = 0; i < 28; i++){
            if (i == 3){i = 4;}
            if (i == 5){i = 6;}
            if (i == 7){i = 8;}
            if(i == n){
                if(dir == "asc"){
                    document.getElementById(n + "_none_all").style.display = "none";
                    document.getElementById(n + "_up_all").style.display = "none";
                    document.getElementById(n + "_down_all").style.display = "inline";
                }
                if(dir == "desc"){
                    document.getElementById(n + "_none_all").style.display = "none";
                    document.getElementById(n + "_down_all").style.display = "none";
                    document.getElementById(n + "_up_all").style.display = "inline";
                }
            }else{
                document.getElementById(i + "_none_all").style.display = "inline";
                document.getElementById(i + "_up_all").style.display = "none";
                document.getElementById(i + "_down_all").style.display = "none";
            }
        }
    }
    else if(document.getElementById("allValidatedVmBody").hidden == false){
        for (var i = 0; i < 28; i++){
            if (i == 3){i = 4;}
            if (i == 5){i = 6;}
            if (i == 7){i = 8;}
            if(i == n){
                if(dir == "asc"){
                    document.getElementById(n + "_none_validate").style.display = "none";
                    document.getElementById(n + "_up_validate").style.display = "none";
                    document.getElementById(n + "_down_validate").style.display = "inline";
                }
                if(dir == "desc"){
                    document.getElementById(n + "_none_validate").style.display = "none";
                    document.getElementById(n + "_down_validate").style.display = "none";
                    document.getElementById(n + "_up_validate").style.display = "inline";
                }
            }else{
                document.getElementById(i + "_none_validate").style.display = "inline";
                document.getElementById(i + "_up_validate").style.display = "none";
                document.getElementById(i + "_down_validate").style.display = "none";
            }
        }
    }
    else if(document.getElementById("allConfirmationVmBody").hidden == false){
        for (var i = 0; i < 28; i++){
            if (i == 3){i = 4;}
            if (i == 5){i = 6;}
            if (i == 7){i = 8;}
            if(i == n){
                if(dir == "asc"){
                    document.getElementById(n + "_none_confirmation").style.display = "none";
                    document.getElementById(n + "_up_confirmation").style.display = "none";
                    document.getElementById(n + "_down_confirmation").style.display = "inline";
                }
                if(dir == "desc"){
                    document.getElementById(n + "_none_confirmation").style.display = "none";
                    document.getElementById(n + "_down_confirmation").style.display = "none";
                    document.getElementById(n + "_up_confirmation").style.display = "inline";
                }
            }else{
                document.getElementById(i + "_none_confirmation").style.display = "inline";
                document.getElementById(i + "_up_confirmation").style.display = "none";
                document.getElementById(i + "_down_confirmation").style.display = "none";
            }
        }
    }
    else if(document.getElementById("allRenewalVmBody").hidden == false){
        for (var i = 0; i < 28; i++){
            if (i == 3){i = 4;}
            if (i == 5){i = 6;}
            if (i == 7){i = 8;}
            if(i == n){
                if(dir == "asc"){
                    document.getElementById(n + "_none_renewal").style.display = "none";
                    document.getElementById(n + "_up_renewal").style.display = "none";
                    document.getElementById(n + "_down_renewal").style.display = "inline";
                }
                if(dir == "desc"){
                    document.getElementById(n + "_none_renewal").style.display = "none";
                    document.getElementById(n + "_down_renewal").style.display = "none";
                    document.getElementById(n + "_up_renewal").style.display = "inline";
                }
            }else{
                document.getElementById(i + "_none_renewal").style.display = "inline";
                document.getElementById(i + "_up_renewal").style.display = "none";
                document.getElementById(i + "_down_renewal").style.display = "none";
            }
        }
    }
    else if(document.getElementById("allDeletedVmBody").hidden == false){
        for (var i = 0; i < 28; i++){
            if (i == 3){i = 4;}
            if (i == 5){i = 6;}
            if (i == 7){i = 8;}
            if(i == n){
                if(dir == "asc"){
                    document.getElementById(n + "_none_delete").style.display = "none";
                    document.getElementById(n + "_up_delete").style.display = "none";
                    document.getElementById(n + "_down_delete").style.display = "inline";
                }
                if(dir == "desc"){
                    document.getElementById(n + "_none_delete").style.display = "none";
                    document.getElementById(n + "_down_delete").style.display = "none";
                    document.getElementById(n + "_up_delete").style.display = "inline";
                }
            }else{
                document.getElementById(i + "_none_delete").style.display = "inline";
                document.getElementById(i + "_up_delete").style.display = "none";
                document.getElementById(i + "_down_delete").style.display = "none";
            }
        }
    }


}