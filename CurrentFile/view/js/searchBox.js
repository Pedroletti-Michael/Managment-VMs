function displayIntoInput(value, whichInput) {
    if(whichInput == 1){
        document.getElementById("inputTMName").value = value;
    }
    if(whichInput == 2){
        document.getElementById("inputRAName").value = value;
    }
}

function searchFunction(value) {
    var input, filter, ul, li, a, i, txtValue;
    if(value == 1){
        input = document.getElementById("inputTMName");
        filter = input.value.toUpperCase();
        ul = document.getElementById("tmNameUl");
    }
    if(value == 2){
        input = document.getElementById("inputRAName");
        filter = input.value.toUpperCase();
        ul = document.getElementById("raNameUl");
    }
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