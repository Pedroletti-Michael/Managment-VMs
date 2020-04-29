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
    <link rel="stylesheet" type="text/css" href="../view/css/styles.css">
    <link rel="stylesheet" href="../view/bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../view/bootstrap-4.4.1-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../view/bootstrap-4.4.1-dist/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../view/css/dashboard.css">
    <link rel="stylesheet" href="../view/css/">
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <script rel="javascript" src="../view/js/jquery.js"></script>
    <script rel="javascript" src="../view/js/script.js"></script>
    <script rel="javascript" src="../view/js/searchBox.js"></script>
    <script rel="javascript" src="../view/js/sortTable.js"></script>

    <!--Théo-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body>
<!-------------------------- Gabarit phone ------------------------------->
<nav class="display-phone navbar navbar-dark header-top fixed-top flex-lg-nowrap p-0 shadow w-100 navbar-expand-lg" style="background-color: #e30613;flex-wrap: nowrap !important; height: 48px">
    <div class="logo-responsive navbar-brand mr-0 p-0 font-weight-bold float-left" href="#" style="font-family: 'Century Gothic'">
        <img src="../images/LOGO-PHONE.png" style="height: 48px; width: auto">
    </div>
    <form method="post" action="../index.php?action=research" class="btn-group search-responsive float-left" style="padding-top: 5px">
        <input class="form-control form-control-light" style="width: calc(100%-50px)" name="inputResearch" type="text" placeholder="Recherche" aria-label="Recherche">
        <button type="submit" class="btn btn-success rounded-0" style="width: 30px">></button>
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
        <a class="title">Public</a>
        <!----------------- home ---------------->
        <?php if ($_GET['action'] == "home"): ?>
            <a href="index.php?action=home" class="alert-link active">Mes VM's</a>
        <?php else : ?>
            <a href="index.php?action=home">Mes VM's</a>
        <?php endif; ?>
        <!----------------- form ---------------->
        <?php if ($_GET['action'] == "form"): ?>
            <a class="last alert-link active" href="index.php?action=form">Formulaire</a>
        <?php else : ?>
            <a class="last" href="index.php?action=form">Formulaire</a>
        <?php endif; ?>

        <?php if(isset($_SESSION['userType']) && $_SESSION['userType']==1):?>
            <a class="title">Admin</a>
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
            <!----------------- formManagement ---------------->
            <?php if ($_GET['action'] == "formManagement"): ?>
                <a class="last alert-link active" href="index.php?action=formManagement">Gestion du formulaire</a>
            <?php else : ?>
                <a class="last" href="index.php?action=formManagement">Gestion du formulaire</a>
            <?php endif; ?>
            <!----------------- vm ---------------->
            <!--
            <a class="title">Base de données</a>
            <?php if ($_GET['action'] == "vm"): ?>
                <a href="index.php?action=vm" class="alert-link active">vm</a>
            <?php else : ?>
                <a href="index.php?action=vm">vm</a>
            <?php endif; ?>
            -->
            <!----------------- user ---------------->
            <!--
            <?php if ($_GET['action'] == "user"): ?>
                <a href="index.php?action=user" class="alert-link active">user</a>
            <?php else : ?>
                <a href="index.php?action=user">user</a>
            <?php endif; ?>
            <!----------------- entity ---------------->
            <!--
            <?php if ($_GET['action'] == "entity"): ?>
                <a href="index.php?action=entity" class="alert-link active">entity</a>
            <?php else : ?>
                <a href="index.php?action=entity">entity</a>
            <?php endif; ?>
            <!----------------- os ---------------->
            <!--
            <?php if ($_GET['action'] == "os"): ?>
                <a href="index.php?action=os" class="alert-link active">os</a>
            <?php else : ?>
                <a href="index.php?action=os">os</a>
            <?php endif; ?>
            <!----------------- snapshot ---------------->
            <!--
            <?php if ($_GET['action'] == "snapshot"): ?>
                <a href="index.php?action=snapshot" class="alert-link active">snapshot</a>
            <?php else : ?>
                <a href="index.php?action=snapshot">snapshot</a>
            <?php endif; ?>
            <!----------------- backup ---------------->
            <!--
            <?php if ($_GET['action'] == "backup"): ?>
                <a href="index.php?action=backup" class="alert-link active">backup</a>
            <?php else : ?>
                <a href="index.php?action=backup">backup</a>
            <?php endif; ?>
            <!----------------- pricing ---------------->
            <!--
            <?php if ($_GET['action'] == "pricing"): ?>
                <a href="index.php?action=pricing" class="alert-link active">pricing</a>
            <?php else : ?>
                <a href="index.php?action=pricing">pricing</a>
            <?php endif; ?>
            -->
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
        <button type="submit" class="btn btn-success rounded-0" style="width: 120px">Rechercher</button>
    </form>
    <!------ Sign In / Sign Out ------->
    <div class="signIn-responsive float-right text-center">
        <?php if(isset($_SESSION['userType'])): ?>
            <a class="nav-link responsive-phone-hidden" href="index.php?action=signOut" style="color: white">Déconnexion</a>
        <?php else : ?>
            <a class="nav-link responsive-phone-hidden" href="index.php?action=signIn" style="color: white">Se connecter</a>
        <?php endif; ?>
    </div>

    <nav class="col-md-2 d-none d-md-block sidebar bg-dark sidenav animate pt-0" id="SideBar" style="max-width: 200px; z-index: 1;display: block!important;">
        <div class="sidebar-sticky">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                <span>Public</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "home"): ?>
                    <a class="nav-link active" href="index.php?action=home">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=home">
                            <?php endif; ?>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Mes VM's
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
            <?php if(isset($_SESSION['userType']) && $_SESSION['userType']==1):?>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Admin</span>
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
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
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
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Renouvellements
                        </a>
                </li>
            </ul>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "formManagement"): ?>
                    <a class="nav-link active" href="index.php?action=formManagement">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=formManagement">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            Gestion du formulaire
                        </a>
                </li>
            </ul>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "refreshUser"): ?>
                    <a class="nav-link active" href="index.php?action=refreshUser">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=refreshUser">
                            <?php endif; ?>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Actualiser utilisateurs
                        </a>
                </li>
            </ul>
                <!--
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Base de données</span>
            </h6>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "vm"): ?>
                    <a class="nav-link active" href="index.php?action=vm">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=vm">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            vm
                        </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "user"): ?>
                    <a class="nav-link active" href="index.php?action=user">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=user">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            user
                        </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "entity"): ?>
                    <a class="nav-link active" href="index.php?action=entity">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=entity">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            entity
                        </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "os"): ?>
                    <a class="nav-link active" href="index.php?action=os">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=os">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            os
                        </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "snapshot"): ?>
                    <a class="nav-link active" href="index.php?action=snapshot">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=snapshot">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            snapshot
                        </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "backup"): ?>
                    <a class="nav-link active" href="index.php?action=backup">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=backup">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            backup
                        </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <?php if ($_GET['action'] == "pricing"): ?>
                    <a class="nav-link active" href="index.php?action=pricing">
                        <?php else : ?>
                        <a class="nav-link" href="index.php?action=pricing">
                            <?php endif; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            pricing
                        </a>
                </li>
            </ul>
            -->
            <?php endif; ?>
        </div>
    </nav>
</nav>
<!-------------------------- Gabarit normal ------------------------------->
<div class="responsive-menu-max container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar" style="max-width: 200px">
            <div class="sidebar-sticky border-right border-light">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                    <span>Public</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "home"): ?>
                        <a class="nav-link active" href="index.php?action=home">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=home">
                                <?php endif; ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Mes VM's
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
                <?php if(isset($_SESSION['userType']) && $_SESSION['userType']==1):?>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Admin</span>
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
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
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
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Renouvellements
                            </a>
                    </li>
                </ul>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "formManagement"): ?>
                        <a class="nav-link active" href="index.php?action=formManagement">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=formManagement">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Gestion du formulaire
                            </a>
                    </li>
                </ul>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "refreshUser"): ?>
                        <a class="nav-link active" href="index.php?action=refreshUser">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=refreshUser">
                                <?php endif; ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Actualiser utilisateurs
                            </a>
                    </li>
                </ul>
                    <!--
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Base de données</span>
                </h6>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "vm"): ?>
                        <a class="nav-link active" href="index.php?action=vm">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=vm">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                vm
                            </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "user"): ?>
                        <a class="nav-link active" href="index.php?action=user">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=user">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                user
                            </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "entity"): ?>
                        <a class="nav-link active" href="index.php?action=entity">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=entity">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                entity
                            </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "os"): ?>
                        <a class="nav-link active" href="index.php?action=os">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=os">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                os
                            </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "snapshot"): ?>
                        <a class="nav-link active" href="index.php?action=snapshot">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=snapshot">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                snapshot
                            </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "backup"): ?>
                        <a class="nav-link active" href="index.php?action=backup">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=backup">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                backup
                            </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <?php if ($_GET['action'] == "pricing"): ?>
                        <a class="nav-link active" href="index.php?action=pricing">
                            <?php else : ?>
                            <a class="nav-link" href="index.php?action=pricing">
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                pricing
                            </a>
                    </li>
                </ul>
                -->
                <?php endif; ?>
            </div>
        </nav>
    </div>
</div>
<main id="main" role="main" class="padding-left h-100 w-100 mt-5">
    <?= $contenu; ?>
</main>
</body>
</html>
