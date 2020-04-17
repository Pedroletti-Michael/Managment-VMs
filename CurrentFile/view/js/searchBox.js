function displayIntoInputRa(value) {
    document.getElementById("inputRAName").value = value;
}

function displayIntoInputTm(value) {
    document.getElementById("inputTMName").value = value;
}

function searchFunctionRa() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("inputRAName");
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
    input = document.getElementById("inputTMName");
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