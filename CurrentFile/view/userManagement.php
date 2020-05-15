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
            var usersBefore = <?= json_encode($allUsers); ?>;
            function transferUser(){
                var checkbox, i, y, usersAfter;
                checkbox = document.getElementsByClassName("checkBox");
                usersAfter= "";

                for(i = 0; i < checkbox.length; i++){
                    if(checkbox[i].checked){
                        for(y = 0; y < usersBefore.length; y++){
                            if(checkbox[i].name == "checkbox"+usersBefore[y]["user_id"]){
                                usersAfter = usersAfter + usersBefore[y]["user_id"] + ";";
                            }
                        }
                    }
                }
                document.getElementById("usersAfter").value = usersAfter;

            }
        </script>

        <meta charset="UTF-8">
        <title>Gestion VM - HEIG-VD</title>
    </head>
<body>

    <!--All VM-->
    <a href="index.php?action=refreshUser">
        <button type="button" class="btn btn-primary mb-1 mt-1 responsiveDisplay">
            <a>Actualiser la liste des utilisateurs</a>
        </button>
    </a>
    <input type="button" value="Retour en haut" id="navButton" class="btn btn-primary rounded-0 w-150-px position-fixed mt-1" style="right: 0.25rem;visibility: hidden" OnClick="goTo()">
    <form method="post" action="../index.php?action=saveModificationUser">
        <div class="table-responsive-xl">
            <table class="table table-hover allVM" id="tableInventoryUser">
                <thead class="thead-dark sticky-top">
                <tr>
                    <th name="goToButton" scope="col" style="width: 50px;"></th>
                    <th name="lastname" scope="col">lastname</th>
                    <th name="firstname" scope="col">firstname</th>
                    <th name="mail" scope="col">mail</th>
                    <th name="status" scope="col">status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allUsers as $value): ?>
                    <tr>
                        <td name="goToButton">
                            <input name="checkbox<?php echo $value['user_id']?>" class="checkBox" type="checkbox" <?php if($value['type'] == 1){echo 'checked'; } ?>>
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
        <input type="hidden" name="usersAfter" id="usersAfter">
        <a onclick="transferUser()">
            <button type="submit" class="btn btn-primary mb-1 mt-1 responsiveDisplay" id="bottom">
                Enregistrer les modifications apportées
            </button>
        </a>
    </form>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>