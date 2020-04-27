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
