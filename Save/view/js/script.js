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
function smartList(val){
    if(val=="Windows"){
        document.getSelection("Linux").style.display="none";
        document.getElementsByName("Windows").style.display="contents";
        alert("The input value has changed. The new value is: " + val );
    }else if(val=="Linux / Ubuntu"){
        document.getElementsByName("Windows").style.display="none";
        document.getElementsByName("Linux").style.display="contents";
        alert("Pute pute pute tpeutpuet ueputpuet: " + val );
    }

}
