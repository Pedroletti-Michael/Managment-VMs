flag = 0;
val = "Windows";
var today = new Date();
var flag = 1;

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
        document.getElementById("domainEINET").disabled = false;
    } else if (value === "Linux") {
        document.getElementById("windows").style.display = "none";
        document.getElementById("linux").style.display = "block";
        document.getElementById("domainEINET").checked = false;
        document.getElementById("domainEINET").disabled = true;
    }
}

function goTo(){
    var navBtn = document.getElementById("navButton");
    if(navBtn.value == "Aller en bas"){
        if(document.getElementById("btnSort").innerText == "Trier les noms (A-Z)"){
            window.location.href='#bottomDesc';
        }
        else{
            window.location.href='#bottomAsc';
        }
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

//Function to change the body of the table in InventoryVM (allVM.php)
function changeBodyTable(n){
    var allVm, validatedVm, confirmationVm, renewalVm, deletedVm, nonRenewableVm;
    allVm = document.getElementById("allVmBody");
    validatedVm = document.getElementById("allValidatedVmBody");
    confirmationVm = document.getElementById("allConfirmationVmBody");
    renewalVm = document.getElementById("allRenewalVmBody");
    deletedVm = document.getElementById("allDeletedVmBody");
    nonRenewableVm = document.getElementById("allNonRenewalVmBody");

    switch(n){
        case 0:
            allVm.hidden = false;
            validatedVm.hidden = true;
            confirmationVm.hidden = true;
            renewalVm.hidden = true;
            deletedVm.hidden = true;
            nonRenewableVm.hidden = true;
            break;
        case 1:
            allVm.hidden = true;
            validatedVm.hidden = false;
            confirmationVm.hidden = true;
            renewalVm.hidden = true;
            deletedVm.hidden = true;
            nonRenewableVm.hidden = true;
            break;
        case 2:
            allVm.hidden = true;
            validatedVm.hidden = true;
            confirmationVm.hidden = false;
            renewalVm.hidden = true;
            deletedVm.hidden = true;
            nonRenewableVm.hidden = true;
            break;
        case 3:
            allVm.hidden = true;
            validatedVm.hidden = true;
            confirmationVm.hidden = true;
            renewalVm.hidden = false;
            deletedVm.hidden = true;
            nonRenewableVm.hidden = true;
            break;
        case 4:
            allVm.hidden = true;
            validatedVm.hidden = true;
            confirmationVm.hidden = true;
            renewalVm.hidden = true;
            deletedVm.hidden = false;
            nonRenewableVm.hidden = true;
            break;
        case 5:
            allVm.hidden = true;
            validatedVm.hidden = true;
            confirmationVm.hidden = true;
            renewalVm.hidden = true;
            deletedVm.hidden = true;
            nonRenewableVm.hidden = false;
            break;
        default:
            allVm.hidden = true;
            validatedVm.hidden = false;
            confirmationVm.hidden = true;
            renewalVm.hidden = true;
            deletedVm.hidden = true;
            nonRenewableVm.hidden = true;
            break;
    }
    document.getElementById("allVMFilterButton").style.backgroundColor ="#6c757d";
    document.getElementById("inUseVMFilterButton").style.backgroundColor ="#6c757d";
    document.getElementById("toBeConfirmedVMFilterButton").style.backgroundColor ="#6c757d";
    document.getElementById("renewableVMFilterButton").style.backgroundColor ="#6c757d";
    document.getElementById("deletedVMFilterButton").style.backgroundColor ="#6c757d";
    document.getElementById("nonRenewableVMFilterButton").style.backgroundColor ="#6c757d";


    if (n == 0){
        document.getElementById("allVMFilterButton").style.backgroundColor ="#5a6268";
    }
    if (n == 1){
        document.getElementById("inUseVMFilterButton").style.backgroundColor ="#5a6268";
    }
    if (n == 2){
        document.getElementById("toBeConfirmedVMFilterButton").style.backgroundColor ="#5a6268";
    }
    if (n == 3){
        document.getElementById("renewableVMFilterButton").style.backgroundColor ="#5a6268";
    }
    if (n == 4){
        document.getElementById("deletedVMFilterButton").style.backgroundColor ="#5a6268";
    }
    if (n == 5){
        document.getElementById("nonRenewableVMFilterButton").style.backgroundColor ="#5a6268";
    }
}


// ------------------- w3schools -------------------------
function openRightMenu() {
    document.getElementById("rightMenu").style.display = "block";
}

function closeRightMenu() {
    document.getElementById("rightMenu").style.display = "none";
}

function openLeftMenu() {
    if (flag == 0){
        document.getElementById("leftMenu").style.width = "200px";
        for(var i = 1 ; i < 18 ; i++){
            document.getElementById('hidden_'+i).style.display = "inline";
        }
        document.getElementsByClassName("bi")
        flag = 1;
    }else{
        document.getElementById("leftMenu").style.width = "52px";
        for(var e = 1 ; e < 18 ; e++){
            document.getElementById('hidden_' + e).style.display = "none";
        }
        flag = 0;
    }
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