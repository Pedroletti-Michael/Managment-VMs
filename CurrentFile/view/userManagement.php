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
    <!------------- Choix ------------>
    <div class="w-50-m m-auto responsiveDisplay pt-2">
        <div class="w-100 d-inline-block">
            <div class="w-20 float-left p-1" style="height: 50px">
                <!--All VM-->
                <a href="#">
                    <button type="button" class="btn btn-primary w-100 responsiveButton">
                        <h6>Toutes les VM</h6>
                    </button>
                </a>
            </div>
            <div class="w-20 float-left p-1" style="height: 50px">
                <!--Confirmed VM-->
                <a href="#">
                    <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(40,167,69,0.7); border-color: rgba(40,167,69,0.7);">
                        <h6>VM confirmées</h6>
                    </button>
                </a>
            </div>
            <div class="w-20 float-left p-1" style="height: 50px">
                <!--VM who need to be confirmed-->
                <a href="#">
                    <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(255,165,69,0.7); border-color: rgba(255,165,69,0.7);">
                        <h6>VM à confirmer</h6>
                    </button>
                </a>
            </div>
            <div class="w-20 float-left p-1" style="height: 50px">
                <!--VM to renew-->
                <a href="#">
                    <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(233,48,48,0.7); border-color: rgba(233,48,48,0.7);">
                        <h6>VM à renouveler</h6>
                    </button>
                </a>
            </div>
            <div class="w-20 float-left p-1" style="height: 50px">
                <!--Deleted VM-->
                <a href="#">
                    <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(90,90,90,0.7); border-color: rgba(90,90,90,0.7);">
                        <h6>VM supprimées</h6>
                    </button>
                </a>
            </div>
        </div>
    </div>
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
                            <input name="checkbox<?php echo $value['user_id']?>" type="checkbox" <?php if($value['type'] == 1){echo 'checked'; } ?>>
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
        <div class="w-50-m m-auto responsiveDisplay pt-2">
            <div class="w-100 d-inline-block">
                <div class="w-20 float-left p-1" style="height: 50px">
                    <button type="submit" class="btn btn-primary w-100 responsiveButton">
                        <h6>Enregistrer</h6>
                    </button>
                </div>
            </div>
        </div>
    </form>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>