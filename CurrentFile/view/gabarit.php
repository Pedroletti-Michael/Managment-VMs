<?php
    $version = '0.652';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="../images/favicon-32x32.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <script rel="javascript" src="../view/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="../view/css/styles.css">
    <link rel="stylesheet" href="../view/bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../view/bootstrap-4.4.1-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../view/bootstrap-4.4.1-dist/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../view/css/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <script rel="javascript" src="../view/js/script.js"></script>
    <script rel="javascript" src="../view/js/alert.js"></script>
    <script rel="javascript" src="../view/js/searchBox.js"></script>
    <script rel="javascript" src="../view/js/sortTable.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body>
<?php if (isset($_SESSION['userType'])): ?>
<!-------------------------- Gabarit for phones ------------------------------->
<nav class="display-phone w-100">
    <button type="button" class="rounded-circle bg-dark m-auto fixed-bottom center_icon" style="height: 55px; width: 55px;bottom: 10px!important;" onclick="closePhoneMenu()" id="buttonClose">
        <svg class="bi bi-x m-auto" width="40px" height="40px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: lightgray;">
            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
        </svg>
    </button>
    <button type="button" class="rounded-circle bg-dark m-auto fixed-bottom center_icon" style="height: 55px; width: 55px;bottom: 10px!important;" onclick="openPhoneMenu()" id="buttonOpen">
        <svg class="bi bi-filter" width="40px" height="40px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: lightgray;">
            <path fill-rule="evenodd" d="M6 10.5a.5.5 0 01.5-.5h3a.5.5 0 010 1h-3a.5.5 0 01-.5-.5zm-2-3a.5.5 0 01.5-.5h7a.5.5 0 010 1h-7a.5.5 0 01-.5-.5zm-2-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
        </svg>
    </button>
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-bottom w-100" style="display:none;bottom: 0; z-index: 999" id="phoneMenu">
        <!-- Search form -->
        <div class="w-100">
            <form method="post" action="../index.php?action=research" class="btn-group search-responsive w-100">
                <img src="../images/VRAI-LOGO.png" style="height: 44px; width: auto">
                <input class="form-control form-control-light w-100 rounded-0" style="font-size: 20px" name="inputResearch" type="text" placeholder="Recherche" aria-label="Recherche" <?php if(!isset($_SESSION['userType']) && $_SESSION == null){echo 'disabled'; } ?>>
            </form>
        </div>
        <hr color="lightgrey" style="height: 1px;" class="w-75">
        <div class="w-100 m-auto text-center pt-1">
            <?php if ($_GET['action'] == "home"): ?>
                <a href="index.php?action=home" class="alert-link active color-lightgrey text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Mes VM</a></h5></a>
            <?php else : ?>
                <a href="index.php?action=home" class="color-lightgrey text-decoration-none"><h5 class="color-lightgrey">Mes VM</h5></a>
            <?php endif; ?>
        </div>
        <div class="w-100 m-auto text-center pt-1">
            <?php if ($_GET['action'] == "form"): ?>
                <a class="alert-link active color-lightgrey text-decoration-none" href="index.php?action=form"><h5 class="color-lightgrey"><a class="menu-phone-selected">Formulaire</a></h5></a>
            <?php else : ?>
                <a class="color-lightgrey text-decoration-none" href="index.php?action=form"><h5 class="color-lightgrey pb-0">Formulaire</h5></a>
            <?php endif; ?>
        </div>
        <?php if ($_SESSION['userType'] != 1): ?>
            <div class="w-100 m-auto text-center pt-1">
                <!----------------- renewalVM ---------------->
                <?php if ($_GET['action'] == "renewalVM"): ?>
                    <a href="index.php?action=renewalVM" class="alert-link active text-decoration-none">
                        <h5 class="color-lightgrey">
                            <?php
                            if(isset($_SESSION['countRenewalVM'])){
                                echo '<span class="badge badge-light mr-1">'. $_SESSION['countRenewalVM'] .'</span>';
                            }
                            ?>
                            <a class="menu-phone-selected">
                                Renouvellements
                            </a>
                        </h5>
                    </a>
                <?php else : ?>
                    <a href="index.php?action=renewalVM" class="text-decoration-none">
                        <h5 class="color-lightgrey">
                            <?php
                            if(isset($_SESSION['countRenewalVM'])){
                                echo '<span class="badge badge-light mr-1">'. $_SESSION['countRenewalVM'] .'</span>';
                            }
                            ?>
                            Renouvellements
                        </h5>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="w-100 fixed-bottom d-inline-block" style="bottom: 20px">
            <div class="float-left w-50 text-decoration-none pl-2">
                <a href="mailto:helpdesk@heig-vd.ch?subject=Plateforme GVM : [Titre de votre message]">
                    <h5 class="color-lightgrey">Contactez-nous</h5>
                </a>
            </div>
            <div class="float-right w-50 text-decoration-none text-right pr-4">
                <?php if ($_GET['action'] == "signIn"): ?>
                    <?php if(isset($_SESSION['userType'])): ?>
                        <a href="index.php?action=signOut" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Déconnexion</a></h5></a>
                    <?php else : ?>
                        <a href="index.php?action=signIn" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Se connecter</a></h5></a>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if(isset($_SESSION['userType'])): ?>
                        <a href="index.php?action=signOut"><h5 style="color: lightgray">Déconnexion</h5></a>
                    <?php else : ?>
                        <a href="index.php?action=signIn"><h5 style="color: lightgray">Se connecter</h5></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="w-100 text-center pt-1" style="margin-bottom: 80px">
        <?php if(isset($_SESSION['userType']) && $_SESSION['userType']==1 || $_SESSION['userType']==2):?>
            <hr color="lightgrey" style="height: 1px;" class="w-50">
            <?php if($_SESSION['userType']==2): ?>
                <!----------------- allVM ---------------->
                <?php if ($_GET['action'] == "allVM"): ?>
                    <a href="index.php?action=allVM" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Inventaire VM</a></h5></a>
                <?php else : ?>
                    <a href="index.php?action=allVM" class="text-decoration-none"><h5 class="color-lightgrey">Inventaire VM</h5></a>
                <?php endif; ?>
            <?php else : ?>
                <!----------------- allVM ---------------->
                <?php if ($_GET['action'] == "allVM"): ?>
                    <a href="index.php?action=allVM" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Inventaire VM</a></h5></a>
                <?php else : ?>
                    <a href="index.php?action=allVM" class="text-decoration-none"><h5 class="color-lightgrey">Inventaire VM</h5></a>
                <?php endif; ?>
            
                <!----------------- confirmationVM ---------------->
                <?php if ($_GET['action'] == "confirmationVM"): ?>
                    <a href="index.php?action=confirmationVM" class="alert-link active text-decoration-none">
                        <h5 class="color-lightgrey">
                            <?php
                            if(isset($_SESSION['countConfirmationVM'])){
                                echo '<span class="badge badge-light mr-1">'. $_SESSION['countConfirmationVM'] .'</span>';
                            }
                            ?>
                            <a class="menu-phone-selected">Demandes</a>
                        </h5>
                    </a>
                <?php else : ?>
                    <a href="index.php?action=confirmationVM" class="text-decoration-none">
                        <h5 class="color-lightgrey">
                            <?php
                            if(isset($_SESSION['countConfirmationVM'])){
                                echo '<span class="badge badge-light mr-1">'. $_SESSION['countConfirmationVM'] .'</span>';
                            }
                            ?>
                            Demandes
                        </h5>
                    </a>
                <?php endif; ?>
                <!----------------- renewalVM ---------------->
                <?php if ($_GET['action'] == "renewalVM"): ?>
                    <a href="index.php?action=renewalVM" class="alert-link active text-decoration-none">
                        <h5 class="color-lightgrey">
                            <?php
                            if(isset($_SESSION['countRenewalVM'])){
                                echo '<span class="badge badge-light mr-1">'. $_SESSION['countRenewalVM'] .'</span>';
                            }
                            ?>
                            <a class="menu-phone-selected">
                                Renouvellements
                            </a>
                        </h5>
                    </a>
                <?php else : ?>
                    <a href="index.php?action=renewalVM" class="text-decoration-none">
                        <h5 class="color-lightgrey">
                            <?php
                            if(isset($_SESSION['countRenewalVM'])){
                                echo '<span class="badge badge-light mr-1">'. $_SESSION['countRenewalVM'] .'</span>';
                            }
                            ?>
                            Renouvellements
                        </h5>
                    </a>
                <?php endif; ?>
                <hr color="lightgrey" style="height: 1px;" class="w-75">
                <!----------------- formAdmin ---------------->
                <?php if ($_GET['action'] == "formAdmin"): ?>
                    <a class="alert-link active text-decoration-none" href="index.php?action=formAdmin"><h5 class="color-lightgrey"><a class="menu-phone-selected">Formulaire administrateur</a></h5></a>
                <?php else : ?>
                    <a class="text-decoration-none" href="index.php?action=formAdmin"><h5 class="color-lightgrey">Formulaire administrateur</h5></a>
                <?php endif; ?>
                <!----------------- formManagement ---------------->
                <?php if ($_GET['action'] == "formManagement"): ?>
                    <a class="alert-link active text-decoration-none" href="index.php?action=formManagement&array=entity"><h5 class="color-lightgrey"><a class="menu-phone-selected">Gestion du formulaire</a></h5></a>
                <?php else : ?>
                    <a class="text-decoration-none" href="index.php?action=formManagement&array=entity"><h5 class="color-lightgrey">Gestion du formulaire</h5></a>
                <?php endif; ?>
                <!----------------- updateUser ---------------->
                <?php if ($_GET['action'] == "displayManagementUser"): ?>
                    <a class="alert-link active text-decoration-none" href="index.php?action=displayManagementUser"><h5 class="color-lightgrey"><a class="menu-phone-selected">Gestion des utilisateurs</a></h5></a>
                <?php else : ?>
                    <a href="index.php?action=displayManagementUser" class="text-decoration-none"><h5 class="color-lightgrey">Gestion des utilisateurs</h5></a>
                <?php endif; ?>
                <!----------------- alertManagement ---------------->
                <?php if ($_GET['action'] == "displayAlertManagementPage"): ?>
                    <a class="alert-link active text-decoration-none" href="index.php?action=displayAlertManagementPage"><h5 class="color-lightgrey"><a class="menu-phone-selected">Gestion des alertes</a></h5></a>
                <?php else : ?>
                    <a href="index.php?action=displayAlertManagementPage" class="text-decoration-none"><h5 class="color-lightgrey">Gestion des alertes</h5></a>
                <?php endif; ?>
            <?php endif;?>
        <?php endif; ?>
        </div>
    </div>
</nav>
<!-------------------------- Gabarit desktop  ------------------------------->
<!---------- Bar top menu ---------------------->
    <nav class="display-1000 display-laptop">
        <div class="d-inline-block w-100 fixed-top p-0 shadow" style="background-color: #e30613; height: 48px;">
            <!---------- Menu burger ---------------->
            <div class="float-left mt-2 ml-2 pl-1" type="button" onclick="openLeftMenu()">
                <svg width="35px" height="35px" viewBox="0 0 16 16" class="bi bi-list" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>

            <!--------------- Icone notification ------------------>
            <?php if($_SESSION['userType'] == 1) : ?>
            <div class="float-left mt-2 pt-1 ml-2 pl-1 w3-dropdown-hover h-100">
                <!------------ Notifications ------------------>
                <div class="menu-notifs w3-dropdown-content bg-dark p-2 text-white" id="menu_notifs" style="display: none;">
                    <div class="w-100 text-center pb-1 title-notif">
                        <a><strong>Notifications</strong></a>
                        <div class="float-right" type="button" onclick="closeNotifMenu()">
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x position-static float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-top: -0.3em;">
                                <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                            </svg>
                        </div>
                    </div>
                    <?php
                        foreach ($_SESSION['fiveNotifications'] as $notif){
                            echo '
                                <div class="w-100 notif btn-group-vertical text-left">
                                    '.$notif.'
                                </div>
                            ';
                        }
                    ?>
                    <div class="mt-1"><a href="index.php?action=viewAllNotification" class="text-decoration-none text-white"><strong>Voir toutes les notifications</strong></a></div>
                </div>
                <div type="button" onclick="openNotifMenu()">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bell-fill mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                    </svg>
                </div>
            </div>
            <?php endif; ?>
            <div class="float-left">
                <!-- Search form -->
                <div class="d-flex justify-content-center ml-2">
                    <form method="post" action="../index.php?action=research">
                        <div class="searchbar" id="searchBar">
                            <input class="search_input" type="text" name="inputResearch" placeholder="Recherche...">
                            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="float-right text-center mr-3 w-auto" style="margin-top: 0.5rem !important;" id="hide_signIn">
                <h6><a class="responsive-phone-hidden text-decoration-none" href="index.php?action=signOut" style="color: white;">
                        Déconnexion
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-door-closed ml-1" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2zm1 0v13h8V2H4z"/>
                            <path d="M7 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            <path fill-rule="evenodd" d="M1 15.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </a></h6>
            </div>
            <div class="m-auto text-center h-100" style="width: 150px" id="hide_title">
                <h4 class="m-auto font-weight-bold text-white" style="margin-top: 0.6rem!important">Gestion VM</h4>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left border-right border-light position-fixed" style="display:block;left:0;z-index: 950; top: 48px; width: 240px; transition: width 0.5s" id="leftMenu">
            <div class="w-100 pt-2" style="height: 40px;" id="hidden_1">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                    <span>Mon Compte</span>
                </h6>
            </div>
            <!----------------- home ---------------->
            <a href="index.php?action=home" class="text-decoration-none text-light">
                <?php if ($_GET['action'] == "home"): ?>
                    <div class="w-100 pt-2 pl-2" style="height: 40px;">
                <?php else : ?>
                    <div class="w-100 pt-2 pl-2" style="height: 40px;">
                <?php endif; ?>
                        <svg class="bi bi-house pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_1">
                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg>
                        <a href="index.php?action=home" class="text-decoration-none text-light w3-animate-right" id="hidden_2">Mes VM</a>
                    </div>
            </a>
            <!----------------- form ---------------->
            <a href="index.php?action=form" class="text-decoration-none text-light">
                <?php if ($_GET['action'] == "form"): ?>
                    <div class="w-100 pt-2 pl-2" style="height: 40px;">
                <?php else : ?>
                    <div class="w-100 pt-2 pl-2" style="height: 40px;">
                <?php endif; ?>
                        <svg class="bi bi-file-text pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_2">
                            <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
                            <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <a href="index.php?action=form" class="text-decoration-none text-light w3-animate-right" id="hidden_3">Formulaire</a>
                    </div>
            </a>
            <!----------------- renewalVM (user) ---------------->
            <?php if ($_SESSION['userType'] != (1 || 2)): ?>
            <a href="index.php?action=renewalVM" class="text-decoration-none text-light">
            <?php if ($_GET['action'] == "renewalVM"): ?>
                <div class="w-100 pt-2 pl-2" style="height: 40px;">
            <?php else : ?>
                <div class="w-100 pt-2 pl-2" style="height: 40px;">
            <?php endif; ?>
                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-clockwise pb-1 mr-1 icons_transition_width" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_3">
                        <path fill-rule="evenodd" d="M3.17 6.706a5 5 0 0 1 7.103-3.16.5.5 0 1 0 .454-.892A6 6 0 1 0 13.455 5.5a.5.5 0 0 0-.91.417 5 5 0 1 1-9.375.789z"/>
                        <path fill-rule="evenodd" d="M8.147.146a.5.5 0 0 1 .707 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 1 1-.707-.708L10.293 3 8.147.854a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <?php
                    if(isset($_SESSION['countRenewalVM'])){
                        echo '<span class="badge badge-light mr-1" style="font-size: 13px" id="hidden_4">'. $_SESSION['countRenewalVM'] .'</span>';
                    }
                    ?>
                    <a href="index.php?action=renewalVM" class="text-decoration-none text-light w3-animate-right" id="hidden_5">Renouvellements</a>
                </div>
            </a>
            <?php else : ?>
            <a id="hidden_5"></a><a id="hidden_4"></a><a id="icons_3"></a>
            <?php endif; ?>

            <!--------------- Admins views ----------------->
            <?php if(isset($_SESSION['userType']) && $_SESSION['userType']==1 || $_SESSION['userType']==2):?>
            <div class="w-100 pt-2" style="height: 40px;" id="hidden_6">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                    <span>Gestion</span>
                </h6>
            </div>
                <!---- allVM ----->
                <a href="index.php?action=allVM" class="text-decoration-none text-light">
                    <?php if ($_GET['action'] == "allVM"): ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php else : ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php endif; ?>
                            <svg class="bi bi-house pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_4">
                                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                            </svg>
                            <a href="index.php?action=allVM" class="text-decoration-none text-light w3-animate-right" id="hidden_7">Inventaire VM</a>
                        </div>
                </a>

                <!---- confirmationVM ----->
                <a href="index.php?action=confirmationVM" class="text-decoration-none text-light">
                    <?php if ($_GET['action'] == "confirmationVM"): ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php else : ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php endif; ?>
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-files pb-1 mr-1 icons_transition_width" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_5">
                                <path fill-rule="evenodd" d="M3 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3z"/>
                                <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                            </svg>
                            <?php
                            if(isset($_SESSION['countConfirmationVM'])){
                                echo '<span class="badge badge-light mr-1" style="font-size: 13px" id="hidden_8">'. $_SESSION['countConfirmationVM'] .'</span>';
                            }
                            ?>
                            <a href="index.php?action=confirmationVM" class="text-decoration-none text-light w3-animate-right" id="hidden_9">Demandes</a>
                        </div>
                </a>
                <!---- renewalVM (admin) ----->
                <a href="index.php?action=confirmationVM" class="text-decoration-none text-light">
                    <?php if ($_GET['action'] == "renewalVM"): ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php else : ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php endif; ?>
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-clockwise pb-1 mr-1 icons_transition_width" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_6">
                                <path fill-rule="evenodd" d="M3.17 6.706a5 5 0 0 1 7.103-3.16.5.5 0 1 0 .454-.892A6 6 0 1 0 13.455 5.5a.5.5 0 0 0-.91.417 5 5 0 1 1-9.375.789z"/>
                                <path fill-rule="evenodd" d="M8.147.146a.5.5 0 0 1 .707 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 1 1-.707-.708L10.293 3 8.147.854a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            <?php
                            if(isset($_SESSION['countRenewalVM'])){
                                echo '<span class="badge badge-light mr-1" style="font-size: 13px" id="hidden_10">'. $_SESSION['countRenewalVM'] .'</span>';
                            }
                            ?>
                            <a href="index.php?action=renewalVM" class="text-decoration-none text-light w3-animate-right" id="hidden_11">Renouvellements</a>
                        </div>
                </a>


                <div class="w-100 pt-2" style="height: 40px;" id="hidden_12">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                        <span>Admin</span>
                    </h6>
                </div>

                <!----------------- formAdmin ---------------->
                <a href="index.php?action=formAdmin" class="text-decoration-none text-light">
                    <?php if ($_GET['action'] == "formAdmin"): ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php else : ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php endif; ?>
                            <svg class="bi bi-file-text pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_7">
                                <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
                                <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            <a href="index.php?action=formAdmin" class="text-decoration-none text-light w3-animate-right" id="hidden_13">Formulaire administrateur</a>
                        </div>
                </a>
                <!----------------- formManagement ---------------->
                <a href="index.php?action=formManagement" class="text-decoration-none text-light">
                    <?php if ($_GET['action'] == "formManagement"): ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php else : ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php endif; ?>
                            <svg class="bi bi-wrench pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_8">
                                <path fill-rule="evenodd" d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019L13 11l-.471.242-.529.026-.287.445-.445.287-.026.529L11 13l.242.471.026.529.445.287.287.445.529.026L13 15l.471-.242.529-.026.287-.445.445-.287.026-.529L15 13l-.242-.471-.026-.529-.445-.287-.287-.445-.529-.026z"/>
                            </svg>
                            <a href="index.php?action=formManagement" class="text-decoration-none text-light w3-animate-right" id="hidden_14">Gestion du formulaire</a>
                        </div>
                </a>
                <!----------------- displayManagementUser ---------------->
                <a href="index.php?action=displayManagementUser" class="text-decoration-none text-light">
                    <?php if ($_GET['action'] == "displayManagementUser"): ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php else : ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php endif; ?>
                            <svg class="bi bi-people pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_9">
                                <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.995-.944v-.002.002zM7.022 13h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zm7.973.056v-.002.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                            <a href="index.php?action=displayManagementUser" class="text-decoration-none text-light w3-animate-right" id="hidden_15">Gestion des utilisateurs</a>
                        </div>
                </a>
                <!----------------- displayAlertManagementPage ---------------->
                <a href="index.php?action=displayAlertManagementPage" class="text-decoration-none text-light">
                    <?php if ($_GET['action'] == "displayAlertManagementPage"): ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php else : ?>
                        <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <?php endif; ?>
                            <svg class="bi bi-alarm pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_10">
                                <path fill-rule="evenodd" d="M8 15A6 6 0 1 0 8 3a6 6 0 0 0 0 12zm0 1A7 7 0 1 0 8 2a7 7 0 0 0 0 14z"/>
                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.053.224l-1.5 3a.5.5 0 1 1-.894-.448L7.5 8.882V5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                                <path fill-rule="evenodd" d="M11.646 14.146a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1-.708.708l-1-1a.5.5 0 0 1 0-.708zm-7.292 0a.5.5 0 0 0-.708 0l-1 1a.5.5 0 0 0 .708.708l1-1a.5.5 0 0 0 0-.708zM5.5.5A.5.5 0 0 1 6 0h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                <path d="M7 1h2v2H7V1z"/>
                            </svg>
                            <a href="index.php?action=displayAlertManagementPage" class="text-decoration-none text-light w3-animate-right" id="hidden_16">Gestion des alertes</a>
                        </div>
                </a>
            <?php else : ?>
                <a id="hidden_16"></a><a id="hidden_6"></a><a id="hidden_7"></a><a id="hidden_8"></a><a id="hidden_9"></a><a id="hidden_10"></a><a id="hidden_11"></a><a id="hidden_12"></a><a id="hidden_13"></a><a id="hidden_14"></a><a id="hidden_15"></a>
                <a id="icons_4"></a><a id="icons_5"></a><a id="icons_6"></a><a id="icons_7"></a><a id="icons_8"></a><a id="icons_9"></a><a id="icons_10"></a>
            <?php endif; ?>
            <!-- Logo HEIG-VD -->
                <a href="https://heig-vd.ch/" style="z-index: 99999">
                    <img src="../images/VRAI-LOGO.png" class="mb-5 mt-5" style="width: 65px; height: auto;z-index: 99999; transition: width 0.5s" id="logo-heig">
                </a>
            <!----------------- mailto:helpdesk@heig-vd.ch ---------------->
            <a class="text-decoration-none text-light" href="mailto:helpdesk@heig-vd.ch?subject=Plateforme GVM : [Titre de votre message]">
                <div class="w-100 pt-2 pl-2" style="height: 40px;">
                    <svg class="bi bi-envelope pb-1 mr-1 icons_transition_width" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" id="icons_11">
                        <path fill-rule="evenodd" d="M14 3H2a1 1 0 00-1 1v8a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1zM2 2a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M.071 4.243a.5.5 0 01.686-.172L8 8.417l7.243-4.346a.5.5 0 01.514.858L8 9.583.243 4.93a.5.5 0 01-.172-.686z" clip-rule="evenodd"/>
                        <path d="M6.752 8.932l.432-.252-.504-.864-.432.252.504.864zm-6 3.5l6-3.5-.504-.864-6 3.5.504.864zm8.496-3.5l-.432-.252.504-.864.432.252-.504.864zm6 3.5l-6-3.5.504-.864 6 3.5-.504.864z"/>
                    </svg>
                    <a class="text-decoration-none text-light w3-animate-right" href="mailto:helpdesk@heig-vd.ch?subject=Plateforme GVM : [Titre de votre message]" id="hidden_17">Contactez-nous</a>
                </div>
            </a>
            <!----------------- Version ---------------->
            <div class="w-100 pt-3 pl-2 mb-5" style="height: 40px;bottom: 10px!important">
                <a class="text-decoration-none text-light" id="hidden_18" href="https://github.com/Pedroletti-Michael/Managment-VMs">Version : <?= $version; ?></a>
            </div>
        </div>
    </nav>
<?php endif; ?>
<?php if ($_GET['action'] == "signIn"): ?>
<main id="main" role="main">
        <?php else: ?>
<main id="main" role="main" class="mt-5 padding-left" style="transition: padding-left 0.5s;">
        <?php endif; ?>
        <?= $contenu; ?>
    </main>
</body>

</html>
