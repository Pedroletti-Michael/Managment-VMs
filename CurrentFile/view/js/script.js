flag = 1;
function Sidebar() {
    if(flag == 1){
        document.getElementById("SideBar").style.width = "200px";
        flag = 0;
    }else if(flag == 0){
        document.getElementById("SideBar").style.width = "0px";
        flag = 1;
    }
}