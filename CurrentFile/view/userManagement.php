<?php
/**
 * Authors : Michael Pedroletti
 * CreationFile date : 08.05.2020
 **/
ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
        <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
        <script rel="javascript" src="../view/js/jquery.js"></script>
        <script rel="javascript" src="../view/js/script.js"></script>
        <script rel="javascript" src="../view/js/searchBox.js"></script>
        <meta charset="UTF-8">
        <title>Gestion VM - HEIG-VD</title>
    </head>
<body>

    <!--All VM-->
    <a href="index.php?action=refreshUser">
        <button type="button" class="btn btn-primary mb-1 mt-1 responsiveDisplay">
            Actualiser la liste des utilisateurs
        </button>
    </a>
    <a onclick="sortTableUser()">
        <button type="button" class="btn btn-primary mb-1 mt-1 responsiveDisplay" id="btnSort">
            Trier les noms (Z-A)
        </button>
    </a>
    <input type="button" value="Retour en haut" id="navButton" class="btn btn-primary rounded-0 w-150-px position-fixed mt-1" style="right: 0.25rem;visibility: hidden" OnClick="goTo()">
    <form method="post" action="../index.php?action=saveModificationUser" id="ascendant">
        <div class="table-responsive-xl">
            <table class="table table-hover allVM" id="tableInventoryUser" >
                <thead class="thead-dark sticky-top">
                <tr>
                    <th name="goToButton" scope="col" style="width: 50px;">Admin</th>
                    <th name="goToButton" scope="col" style="width: 50px;">Viewer</th>
                    <th name="lastname" scope="col">lastname</th>
                    <th name="firstname" scope="col">firstname</th>
                    <th name="mail" scope="col">mail</th>
                    <th name="status" scope="col">status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allUsersAsc as $value): ?>
                    <tr>
                        <td name="goToButton">
                            <input name="checkboxAsc<?php echo $value['user_id']?>" style="width: 50px;" class="checkBoxAsc" type="checkbox" <?php if($value['type'] == 1){echo 'checked'; } ?> onchange="if(document.getElementsByName('checkboxViewerAsc<?php echo $value['user_id']?>')[0].checked == true){document.getElementsByName('checkboxViewerAsc<?php echo $value['user_id']?>')[0].checked = false;}">
                        </td>
                        <td name="goToButton">
                            <input name="checkboxViewerAsc<?php echo $value['user_id']?>" style="width: 50px;" class="checkBoxViewerAsc" type="checkbox" <?php if($value['type'] == 2){echo 'checked'; } ?> onchange="if(document.getElementsByName('checkboxAsc<?php echo $value['user_id']?>')[0].checked == true){document.getElementsByName('checkboxAsc<?php echo $value['user_id']?>')[0].checked = false;}">
                        </td>
                        <td name="lastname<?php echo $value['user_id']?>"><?php echo $value['lastname']?></td>
                        <td name="firstname<?php echo $value['user_id']?>"><?php echo $value['firstname']?></td>
                        <td name="mail<?php echo $value['user_id']?>"><?php echo $value['mail']?></td>
                        <td name="type<?php echo $value['user_id']?>"><?php if($value['type'] == 0){echo 'utilisateur';}else{echo 'admin';}?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="usersAfterAsc" id="usersAfterAsc">
        <input type="hidden" name="usersViewerAfterAsc" id="usersViewerAfterAsc">
        <a onclick="transferUser(0)">
            <button type="submit" class="btn btn-primary mb-1 mt-1 responsiveDisplay" id="bottomAsc">
                Enregistrer les modifications apportées
            </button>
        </a>
    </form>
    <form method="post" action="../index.php?action=saveModificationUser" id="descendant" hidden>
        <div class="table-responsive-xl">
            <table class="table table-hover allVM" id="tableInventoryUser" >
                <thead class="thead-dark sticky-top">
                <tr>
                    <th name="goToButton" scope="col" style="width: 50px;">Admin</th>
                    <th name="goToButton" scope="col" style="width: 50px;">Viewer</th>
                    <th name="lastname" scope="col">lastname</th>
                    <th name="firstname" scope="col">firstname</th>
                    <th name="mail" scope="col">mail</th>
                    <th name="status" scope="col">status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allUsersDesc as $valueDesc): ?>
                    <tr>
                        <td name="goToButton">
                            <input name="checkboxDesc<?php echo $valueDesc['user_id']?>" style="width: 50px;" class="checkBoxDesc" type="checkbox" <?php if($valueDesc['type'] == 1){echo 'checked'; } ?> onchange="if(document.getElementsByName('checkboxViewerDesc<?php echo $value['user_id']?>')[0].checked == true){document.getElementsByName('checkboxViewerDesc<?php echo $value['user_id']?>')[0].checked = false;}">
                        </td>
                        <td name="goToButton">
                            <input name="checkboxViewerDesc<?php echo $valueDesc['user_id']?>" style="width: 50px;" class="checkBoxViewerDesc" type="checkbox" <?php if($valueDesc['type'] == 2){echo 'checked'; } ?> onchange="if(document.getElementsByName('checkboxDesc<?php echo $value['user_id']?>')[0].checked == true){document.getElementsByName('checkboxDesc<?php echo $value['user_id']?>')[0].checked = false;}">
                        </td>
                        <td name="lastname<?php echo $valueDesc['user_id']?>"><?php echo $valueDesc['lastname']?></td>
                        <td name="firstname<?php echo $valueDesc['user_id']?>"><?php echo $valueDesc['firstname']?></td>
                        <td name="mail<?php echo $valueDesc['user_id']?>"><?php echo $valueDesc['mail']?></td>
                        <td name="type<?php echo $valueDesc['user_id']?>"><?php if($valueDesc['type'] == 0){echo 'utilisateur';}else{echo 'admin';}?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="usersAfterDesc" id="usersAfterDesc">
        <input type="hidden" name="usersViewerAfterDesc" id="usersViewerAfterDesc">
        <a onclick="transferUser(1)">
            <button type="submit" class="btn btn-primary mb-1 mt-1 responsiveDisplay" id="bottomDesc">
                Enregistrer les modifications apportées
            </button>
        </a>
    </form>

    <script>
        var lastScrollTop = 0;

        $(window).scroll(function(event){
            var st = $(this).scrollTop();
            if (st > lastScrollTop){
                document.getElementById("navButton").value = "Aller en bas";
            } else {
                document.getElementById("navButton").value = "Retour en haut";
            }
            lastScrollTop = st;
            if (window.pageYOffset==0){
                document.getElementById("navButton").style.visibility="hidden";
            }else{
                document.getElementById("navButton").style.visibility="visible";
            }
        });
    </script>
    <script>
        function sortTableUser() {
            var btnSort = document.getElementById("btnSort");
            var tableAZ = document.getElementById("ascendant");
            var tableZA = document.getElementById("descendant");


            if(btnSort.innerText == "Trier les noms (A-Z)"){
                tableZA.hidden = true;
                tableAZ.hidden = false;
                btnSort.innerText = "Trier les noms (Z-A)";
            }
            else{
                tableAZ.hidden = true;
                tableZA.hidden = false;
                btnSort.innerText = "Trier les noms (A-Z)";
            }
        }
    </script>
    <script>
        var usersBefore = <?= json_encode($allUsers); ?>;
        function transferUser(n){
            var checkbox, i, y, usersAfter;
            //to know which table we need to select
            if(n == 1){
                checkbox = document.getElementsByClassName("checkBoxDesc");
                usersAfter= "";

                for(i = 0; i < checkbox.length; i++){
                    if(checkbox[i].checked){
                        for(y = 0; y < usersBefore.length; y++){
                            if(checkbox[i].name == "checkboxDesc"+usersBefore[y]["user_id"]){
                                usersAfter = usersAfter + usersBefore[y]["user_id"] + ";";
                            }
                        }
                    }
                }
                document.getElementById("usersAfterDesc").value = usersAfter;

                checkbox = document.getElementsByClassName("checkBoxViewerDesc");
                usersAfter= "";

                for(i = 0; i < checkbox.length; i++){
                    if(checkbox[i].checked){
                        for(y = 0; y < usersBefore.length; y++){
                            if(checkbox[i].name == "checkboxViewerDesc"+usersBefore[y]["user_id"]){
                                usersAfter = usersAfter + usersBefore[y]["user_id"] + ";";
                            }
                        }
                    }
                }
                document.getElementById("usersViewerAfterDesc").value = usersAfter;
            }
            else{
                checkbox = document.getElementsByClassName("checkBoxAsc");
                usersAfter= "";

                for(i = 0; i < checkbox.length; i++){
                    if(checkbox[i].checked){
                        for(y = 0; y < usersBefore.length; y++){
                            if(checkbox[i].name == "checkboxAsc"+usersBefore[y]["user_id"]){
                                usersAfter = usersAfter + usersBefore[y]["user_id"] + ";";
                            }
                        }
                    }
                }
                document.getElementById("usersAfterAsc").value = usersAfter;

                checkbox = document.getElementsByClassName("checkBoxViewerAsc");
                usersAfter= "";

                for(i = 0; i < checkbox.length; i++){
                    if(checkbox[i].checked){
                        for(y = 0; y < usersBefore.length; y++){
                            if(checkbox[i].name == "checkboxViewerAsc"+usersBefore[y]["user_id"]){
                                usersAfter = usersAfter + usersBefore[y]["user_id"] + ";";
                            }
                        }
                    }
                }
                document.getElementById("usersViewerAfterAsc").value = usersAfter;
            }
        }
    </script>
</body>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>