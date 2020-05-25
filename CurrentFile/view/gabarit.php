<?php

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
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <script rel="javascript" src="../view/js/script.js"></script>
    <script rel="javascript" src="../view/js/searchBox.js"></script>
    <script rel="javascript" src="../view/js/sortTable.js"></script>

    <!--Théo-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body>
<?php if (isset($_SESSION['userType'])): ?>
<!-------------------------- Gabarit for phones ------------------------------->
<nav class="display-phone w-100">
    <button type="button" class="rounded-circle bg-dark m-auto fixed-bottom" style="height: 55px; width: 55px;bottom: 10px!important;" onclick="closePhoneMenu()" id="buttonClose">
        <svg class="bi bi-x" width="40px" height="40px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: lightgray;">
            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
        </svg>
    </button>
    <button type="button" class="rounded-circle bg-dark m-auto fixed-bottom" style="height: 55px; width: 55px;bottom: 10px!important;" onclick="openPhoneMenu()" id="buttonOpen">
        <svg class="bi bi-filter mt-1" width="40px" height="40px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: lightgray;">
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
                <a class="color-lightgrey text-decoration-none" href="index.php?action=form"><h5 class="color-lightgrey">Formulaire</h5></a>
            <?php endif; ?>
        </div>
        <div class="w-100 fixed-bottom" style="bottom: 20px">
            <div class="float-right mr-4 w-auto text-decoration-none">
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
        <div class="w-100 m-auto text-center pt-1">
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
                    <a href="index.php?action=confirmationVM" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Demandes</a></h5></a>
                <?php else : ?>
                    <a href="index.php?action=confirmationVM" class="text-decoration-none"><h5 class="color-lightgrey">Demandes</h5></a>
                <?php endif; ?>
                <!----------------- renewalVM ---------------->
                <?php if ($_GET['action'] == "renewalVM"): ?>
                    <a href="index.php?action=renewalVM" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Renouvellements</a></h5></a>
                <?php else : ?>
                    <a href="index.php?action=renewalVM" class="text-decoration-none"><h5 class="color-lightgrey">Renouvellements</h5></a>
                <?php endif; ?>
                <hr color="lightgrey" style="height: 1px;" class="w-75">
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
<!-------------------------- Gabarit max-width : 1000px ------------------------------->
<nav class="display-1000 navbar navbar-dark header-top fixed-top flex-lg-nowrap p-0 shadow w-100 navbar-expand-lg" style="background-color: #e30613;flex-wrap: nowrap !important; height: 48px">
    <div class="logo-responsive navbar-brand mr-0 p-0 font-weight-bold float-left" href="#" style="font-family: 'Century Gothic'">
        <img src="../images/VRAI-LOGO.png" style="height: 48px; width: auto">
        <a class="text-decoration-none ml-1" href="index.php?action=home" style="color: white; font-size: 11px">Gestion VM</a>
    </div>
    <form method="post" action="../index.php?action=research" class="btn-group search-responsive float-left" style="padding-top: 5px">
        <input class="form-control form-control-light" style="width: calc(100%-50px)" name="inputResearch" type="text" placeholder="Recherche" aria-label="Recherche">
        <button type="submit" class="btn btn-success rounded-0" style="width: 30px" <?php if(!isset($_SESSION['userType']) && $_SESSION == null){echo 'disabled'; } ?>>></button>
    </form>
    <div class="signIn-responsive float-right text-center float-left align-items-center" style="height: 48px;">
        <span class="navbar-toggler-icon float-right" style="margin: 14px" onclick="openNav()"></span>
    </div>
    <div id="mySidenav" class="sidenav">
        <!----------------- signIn ---------------->
        <?php if ($_GET['action'] == "signIn"): ?>
            <?php if(isset($_SESSION['userType'])): ?>
                <a href="index.php?action=signOut" class="alert-link active float-right pr-4">Déconnexion</a>
            <?php else : ?>
                <a href="index.php?action=signIn" class="alert-link active float-right pr-4">Se connecter</a>
            <?php endif; ?>
        <?php else : ?>
            <?php if(isset($_SESSION['userType'])): ?>
                <a href="index.php?action=signOut" class="float-right pr-4">Déconnexion</a>
            <?php else : ?>
                <a href="index.php?action=signIn" class="float-right pr-4">Se connecter</a>
            <?php endif; ?>
        <?php endif; ?>
        <a class="title">Mon compte</a>
        <!----------------- home ---------------->
        <?php if ($_GET['action'] == "home"): ?>
            <a href="index.php?action=home" class="alert-link active">Mes VM</a>
        <?php else : ?>
            <a href="index.php?action=home">Mes VM</a>
        <?php endif; ?>
        <!----------------- form ---------------->
        <?php if ($_GET['action'] == "form"): ?>
            <a class="alert-link active" href="index.php?action=form">Formulaire</a>
        <?php else : ?>
            <a href="index.php?action=form">Formulaire</a>
        <?php endif; ?>

        <?php if(isset($_SESSION['userType']) && $_SESSION['userType']==1 || $_SESSION['userType']==2):?>
            <?php if($_SESSION['userType']==2) :?>
                <a class="title">Gestion</a>
                <!----------------- allVM ---------------->
                <?php if ($_GET['action'] == "allVM"): ?>
                    <a href="index.php?action=allVM" class="alert-link active">Inventaire VM</a>
                <?php else : ?>
                    <a href="index.php?action=allVM">Inventaire VM</a>
                <?php endif; ?>
            <?php else : ?>
                <a class="title">Gestion</a>
                <!----------------- allVM ---------------->
                <?php if ($_GET['action'] == "allVM"): ?>
                    <a href="index.php?action=allVM" class="alert-link active">Inventaire VM</a>
                <?php else : ?>
                    <a href="index.php?action=allVM">Inventaire VM</a>
                <?php endif; ?>
                <!----------------- confirmationVM ---------------->
                <?php if ($_GET['action'] == "confirmationVM"): ?>
                    <a href="index.php?action=confirmationVM" class="alert-link active">Demandes</a>
                <?php else : ?>
                    <a href="index.php?action=confirmationVM">Demandes</a>
                <?php endif; ?>
                <!----------------- renewalVM ---------------->
                <?php if ($_GET['action'] == "renewalVM"): ?>
                    <a href="index.php?action=renewalVM" class="alert-link active">Renouvellements</a>
                <?php else : ?>
                    <a href="index.php?action=renewalVM">Renouvellements</a>
                <?php endif; ?>

                <a class="title">Admin</a>
                <!----------------- formManagement ---------------->
                <?php if ($_GET['action'] == "formManagement"): ?>
                    <a class="alert-link active" href="index.php?action=formManagement&array=entity">Gestion du formulaire</a>
                <?php else : ?>
                    <a href="index.php?action=formManagement&array=entity">Gestion du formulaire</a>
                <?php endif; ?>
                <!----------------- updateUser ---------------->
                <?php if ($_GET['action'] == "displayManagementUser"): ?>
                    <a class="alert-link active" href="index.php?action=displayManagementUser">Gestion des utilisateurs</a>
                <?php else : ?>
                    <a href="index.php?action=displayManagementUser">Gestion des utilisateurs</a>
                <?php endif; ?>
                <!----------------- alertManagement ---------------->
                <?php if ($_GET['action'] == "displayAlertManagementPage"): ?>
                    <a class="alert-link active" href="index.php?action=displayAlertManagementPage">Gestion des alertes</a>
                <?php else : ?>
                    <a href="index.php?action=displayAlertManagementPage">Gestion des alertes</a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</nav>
<!-------------------------- Gabarit responsive ------------------------------->
<nav class="display-laptop navbar navbar-dark header-top fixed-top flex-lg-nowrap p-0 shadow w-100 navbar-expand-lg" style="background-color: #e30613;flex-wrap: nowrap !important; ">
    <div class="logo-responsive navbar-brand mr-0 p-0" href="#">
        <img src="../images/VRAI-LOGO.png" style="height: 48px; width: auto">
        <a class="text-decoration-none ml-2" href="index.php?action=home" style="color: white; margin-top: 13px!important;">Gestion VM</a>
        <span class="responsive-menu-min navbar-toggler-icon float-right m-0 mr-3" style="margin-top: 13px!important;" onclick="Sidebar()"></span>
    </div>
    <!------ Search ------->
    <form method="post" action="../index.php?action=research" class="btn-group search-responsive">
        <input class="form-control form-control-light" style="width: calc(100%-120px)" name="inputResearch" type="text" placeholder="Recherche" aria-label="Recherche">
        <button type="submit" class="btn btn-success rounded-0" style="width: 120px" <?php if(!isset($_SESSION['userType']) && $_SESSION == null){echo 'disabled'; } ?>>Rechercher</button>
    </form>
    <!------ Sign In / Sign Out ------->
    <div class="signIn-responsive float-right text-center">
        <?php if(isset($_SESSION['userType'])): ?>
            <a class="nav-link responsive-phone-hidden" href="index.php?action=signOut" style="color: white">Déconnexion</a>
        <?php else : ?>
            <a class="nav-link responsive-phone-hidden" href="index.php?action=signIn" style="color: white">Se connecter</a>
        <?php endif; ?>
    </div>
</nav>
<!-------------------------- Gabarit normal ------------------------------->
<div class="responsive-menu-max container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar" style="max-width: 200px">
            <div class="sidebar-sticky border-right border-light">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                    <span>Mon Compte</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "home"): ?>
                        <a class="nav-link active" href="index.php?action=home">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=home">
                                <?php endif; ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Mes VM
                            </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "form"): ?>
                        <a class="nav-link active" href="index.php?action=form">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=form">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Formulaire
                            </a>
                    </li>
                </ul>
                <?php if(isset($_SESSION['userType']) && $_SESSION['userType']==1 || $_SESSION['userType']==2):?>
                    <?php if($_SESSION['userType']==2) : ?>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Gestion</span>
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <?php if ($_GET['action'] == "allVM"): ?>
                                <a class="nav-link active" href="index.php?action=allVM">
                                    <?php else : ?>
                                    <a class="nav-link" href="index.php?action=allVM">
                                        <?php endif; ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        Inventaire VM
                                    </a>
                            </li>
                        </ul>
                    <?php else : ?>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Gestion</span>
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <?php if ($_GET['action'] == "allVM"): ?>
                                <a class="nav-link active" href="index.php?action=allVM">
                                    <?php else : ?>
                                    <a class="nav-link" href="index.php?action=allVM">
                                        <?php endif; ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        Inventaire VM
                                    </a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <?php if ($_GET['action'] == "confirmationVM"): ?>
                                <a class="nav-link active" href="index.php?action=confirmationVM">
                                    <?php else : ?>
                                    <a class="nav-link" href="index.php?action=confirmationVM">
                                        <?php endif; ?>
                                        <?php
                                        if(isset($_SESSION['countConfirmationVM'])){
                                            echo '<span class="badge badge-light mr-1">'. $_SESSION['countConfirmationVM'] .'</span>';
                                        }
                                        else{
                                            echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>';
                                        }
                                        ?>
                                        Demandes
                                    </a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <?php if ($_GET['action'] == "renewalVM"): ?>
                                <a class="nav-link active" href="index.php?action=renewalVM">
                                    <?php else : ?>
                                    <a class="nav-link" href="index.php?action=renewalVM">
                                        <?php endif; ?>
                                        <?php
                                        if(isset($_SESSION['countRenewalVM'])){
                                            echo '<span class="badge badge-light mr-1">'. $_SESSION['countRenewalVM'] .'</span>';
                                        }
                                        else{
                                            echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>';
                                        }
                                        ?>
                                        Renouvellements
                                    </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Admin</span>
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <?php if ($_GET['action'] == "formManagement"): ?>
                                <a class="nav-link active" href="index.php?action=formManagement&array=entity">
                                    <?php else : ?>
                                    <a class="nav-link" href="index.php?action=formManagement&array=entity">
                                        <?php endif; ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        Gestion du formulaire
                                    </a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <?php if ($_GET['action'] == "displayManagementUser"): ?>
                                <a class="nav-link active" href="index.php?action=displayManagementUser">
                                    <?php else : ?>
                                    <a class="nav-link" href="index.php?action=displayManagementUser">
                                        <?php endif; ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        Gestion des utilisateurs
                                    </a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <?php if ($_GET['action'] == "displayAlertManagementPage"): ?>
                                <a class="nav-link active" href="index.php?action=displayAlertManagementPage">
                                    <?php else : ?>
                                    <a class="nav-link" href="index.php?action=displayAlertManagementPage">
                                        <?php endif; ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        Gestion des alertes
                                    </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</div>
<?php endif;?>
<main id="main" role="main" class="padding-left h-100 w-100 mt-5">
    <?= $contenu; ?>
</main>
</body>

</html>
