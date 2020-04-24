function displayIntoInputRa(idNb, value) {
    var id = "liRa" + idNb;
    document.getElementById("inputRANam").value = value;
    document.getElementById("inputRAName").value = document.getElementById(id).value;
}

function displayIntoInputTm(idNb, value) {
    var id = "liTm" + idNb;
    document.getElementById("inputTMNam").value = value;
    document.getElementById("inputTMName").value = document.getElementById(id).value;
}

function displayIntoInputRedundance(value) {
    document.getElementById("editRedundance").value = value;
}

function searchFunctionRa() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("inputRANam");
    filter = input.value.toUpperCase();
    ul = document.getElementById("raNameUl");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function searchFunctionTm() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("inputTMNam");
    filter = input.value.toUpperCase();
    ul = document.getElementById("tmNameUl");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function searchFunctionRedundance() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("editRedundance");
    filter = input.value.toUpperCase();
    ul = document.getElementById("redundanceUl");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function filterForInventoryVm(which) {
    var input, filter, table, tr, td, i, txtValue;
    input = which;
    filter = input.toUpperCase();
    table = document.getElementById("tableInventoryVm");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[17];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}