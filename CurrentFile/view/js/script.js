flag = 0;
val = "Windows";
var today = new Date();

function Sidebar() {
    if(flag == 1){
        document.getElementById("SideBar").style.width = "0px";
        flag = 0;
    }else if(flag == 0){
        document.getElementById("SideBar").style.width = "200px";
        flag = 1;
    }
}

function openNav() {
    if(flag == 1){
        document.getElementById("mySidenav").style.width = "0";
        flag = 0;
    }else if(flag == 0){
        document.getElementById("mySidenav").style.width = "100%";
        flag = 1;
    }
}

function checkOS(value){
    //osTypeFormControlSelect
    if (value === "Windows") {
        document.getElementById("linux").style.display = "none";
        document.getElementById("windows").style.display = "block";
    } else if (value === "Linux") {
        document.getElementById("windows").style.display = "none";
        document.getElementById("linux").style.display = "block";
    }
}

function goTo(){
    var navBtn = document.getElementById("navButton");
    if(navBtn.value == "Aller en bas"){
        window.location.href='#bottom';
    }
    else{
        window.location.href='#top';
    }
}

//Function used to check fields in form.php
function checkField(fieldName) {
    switch (fieldName) {
        case 'alertEndDate':
            var dateEnd = document.getElementById('inputEndDate').value;
            var splitedDateEnd = dateEnd.split('-');

            var dateStart = document.getElementById('inputComissioningDate').value;
            var splitedDateStart = dateStart.split('-');

            if(Date.UTC(splitedDateEnd[0], splitedDateEnd[1], splitedDateEnd[2]) <= Date.UTC(splitedDateStart[0], splitedDateStart[1], splitedDateStart[2])) {
                if(document.getElementById('inputEndDate').value !== '') {
                    document.getElementById('alertEndDate').style.display = '';
                    document.getElementById('submitButton').disabled = true
                }
                else {
                    document.getElementById('alertEndDate').style.display = 'none';
                    document.getElementById('submitButton').disabled = false
                }
            }
            else {
                document.getElementById('alertEndDate').style.display = 'none';
                document.getElementById('submitButton').disabled = false
            }
            break;
    }

}

// ------------------- w3schools -------------------------
function openRightMenu() {
    document.getElementById("rightMenu").style.display = "block";
}

function closeRightMenu() {
    document.getElementById("rightMenu").style.display = "none";
}

function openPhoneMenu() {
    document.getElementById("phoneMenu").style.display = "block";
    document.getElementById("buttonOpen").style.display = "none";
    document.getElementById("buttonClose").style.display = "block";
}

function closePhoneMenu() {
    document.getElementById("phoneMenu").style.display = "none";
    document.getElementById("buttonOpen").style.display = "block";
    document.getElementById("buttonClose").style.display = "none";
}