<?php

/**
 * Authors : Théo Cook
 * CreationFile date : 17.03.2020
 * ModifFile date : 31.03.2020
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script rel="javascript" src="../view/js/jquery.js"></script>
    <script rel="javascript" src="../view/js/script.js"></script>
    <script rel="javascript" src="../view/js/searchBox.js"></script>
    <meta charset="UTF-8">
    <title>Mes VM - HEIG-VD</title>
</head>
<body>
<div class="table-responsive-xl">

    <!--Confirmation command VM modal)-->
    <?php if (isset($_SESSION['$displayModalConfirm']) && $_SESSION['$displayModalConfirm'] == true) : ?>
        <div class="modal fade" id="confirmationCommandVM" tabindex="-1" role="dialog"
             aria-labelledby="confirmationCommandVM" aria-hidden="true">
            <div class="modal-dialog m-auto w-470-px" role="document" style="top: 45%;">
                <div class="modal-content w-100">
                    <div class="modal-body">
                        <div class="w-100">
                            <h6 class="float-left pt-2 text-center">Un e-mail de confirmation a été envoyé à vous et au
                                responsable technique de la VM</h6>
                            <button type="submit" class="btn btn-success float-right btn-close-phone"
                                    data-dismiss="modal">Fermer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>$('.modal').modal('show')</script>
        <?php unset($_SESSION['$displayModalConfirm']); endif; ?>
    <!--Modal send mail failed-->
    <?php if (isset($_SESSION['displayModalConfirmationFailed']) && $_SESSION['displayModalConfirmationFailed']) : ?>
        <div class="modal fade" id="confirmationMailFailed" tabindex="-1" role="dialog"
             aria-labelledby="confirmationMailFailed" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-danger justify-content-center">
                        <h5>Échec envoi e-mail</h5>
                    </div>

                    <div class="modal-body">
                        <h6>L’e-mail de confirmation n’a pas été envoyé. Contactez le <a
                                    href="mailto:helpdesk@heig-vd.ch?subject=Demande de VM : Erreur lors de la confirmation">helpdesk</a>.
                        </h6>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" data-dismiss="modal">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>$('.modal').modal('show')</script>
        <?php
        unset($_SESSION['displayModalConfirmationFailed']);
    endif;
    ?>
    <!--Modal request failed-->
    <?php if (isset($_SESSION['displayModalRequestFailed']) && $_SESSION['displayModalRequestFailed']) : ?>
        <div class="modal fade" id="requestFailed" tabindex="-1" role="dialog" aria-labelledby="requestFailed"
             aria-hidden="true">
            <div class="modal-dialog m-auto w-470-px" role="document" style="top: 45%;">
                <div class="modal-content w-100">
                    <div class="modal-body">
                        <div class="w-100">
                            <h6 class="float-left pt-2 text-center">Nous rencontrons actuellement un problème. Nous ne
                                pouvons donc prendre en compte votre commande. Veuillez réessayer plus tard.</h6>
                            <button type="submit" class="btn btn-success float-right btn-close-phone"
                                    data-dismiss="modal">Fermer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>$('.modal').modal('show')</script>
        <?php
        unset($_SESSION['displayModalRequestFailed']);
    endif;
    ?>
    <form method="post" action="../index.php?action=home">
        <!------------- Btn Filtrer ------------>
        <button type="button" class="btn btn-primary rounded-0 w-150-px position-fixed mt-1" style="right: 0.25rem;"
                onclick="openRightMenu()">
            Filtres
            <svg class="bi bi-filter-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M14 10.5a.5.5 0 00-.5-.5h-3a.5.5 0 000 1h3a.5.5 0 00.5-.5zm0-3a.5.5 0 00-.5-.5h-7a.5.5 0 000 1h7a.5.5 0 00.5-.5zm0-3a.5.5 0 00-.5-.5h-11a.5.5 0 000 1h11a.5.5 0 00.5-.5z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
        <!------------- Sidebar Options ------------>
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">
            <button type="button" onclick="closeRightMenu()" class="w-100 btn btn-danger rounded-0 text-left">Fermer
            </button>
            <!------------- Filter VM ------------>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle w-100 rounded-0 text-left" type="button" data-toggle="collapse" data-target="#collapseVM" aria-expanded="false" aria-controls="collapseExample">
                    Filtrer VM
                </button>
                <div class="collapse" id="collapseVM">
                    <div class="w-100">
                        <!--All VM-->
                        <a onclick="changeBodyTable(0)">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left">
                                <span class="badge badge-primary" id="numberOfVM"> </span>
                                Toutes les VM
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--Confirmed VM-->
                        <a onclick="changeBodyTable(1)">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left">
                            <span class="badge"
                                  style="background-color: rgba(40,167,69,0.7); border-color: rgba(40,167,69,0.7);"
                                  id="numberOfConfirmedVM"> </span>
                                VM en service
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--VM who need to be confirmed-->
                        <a onclick="changeBodyTable(2)">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left">
                            <span class="badge"
                                  style="background-color: rgba(255,165,69,0.7); border-color: rgba(255,165,69,0.7);"
                                  id="numberOfToBeConfirmedVM"> </span>
                                VM à confirmer
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--VM to renew-->
                        <a onclick="changeBodyTable(3)">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left">
                            <span class="badge"
                                  style="background-color: rgba(233,48,48,0.7); border-color: rgba(233,48,48,0.7);"
                                  id="numberOfRenewalVM"> </span>
                                VM à renouveler
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--Deleted VM-->
                        <a onclick="changeBodyTable(4)">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left">
                            <span class="badge"
                                  style="background-color: rgba(90,90,90,0.7); border-color: rgba(90,90,90,0.7);"
                                  id="numberOfDeletedVM"> </span>
                                VM supprimées
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <!------------- Filter fields ------------>
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle w-100 rounded-0 text-left" type="button" data-toggle="collapse" data-target="#collapseFields" aria-expanded="false" aria-controls="collapseExample">
                    Filtrer colonnes
                </button>
                <div class="collapse" id="collapseFields">
                    <button name="btnRowFilter" id="name" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('name')">
                        name
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="cluster" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('cluster')">
                        cluster
                    </button>
                    <button name="btnRowFilter" id="dateStart" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left"
                            onclick="filterRow('dateStart')">
                        dateStart
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="dateAnniversary" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left"
                            onclick="filterRow('dateAnniversary')">
                        dateAnniversary
                    </button>
                    <button name="btnRowFilter" id="dateEnd" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('dateEnd')">
                        dateEnd
                    </button>
                    <button name="btnRowFilter" id="desc" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('desc')">
                        description
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="ip" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('ip')">
                        ip
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="dnsName" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('dnsName')">
                        dnsName
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="redundance" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left"
                            onclick="filterRow('redundance')">
                        redundance
                    </button>
                    <button name="btnRowFilter" id="usage" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('usage')">
                        usageType
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="criticity" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left"
                            onclick="filterRow('criticity')">
                        criticity
                    </button>
                    <button name="btnRowFilter" id="cpu" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('cpu')">
                        cpu
                    </button>
                    <button name="btnRowFilter" id="ram" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('ram')">
                        ram
                    </button>
                    <button name="btnRowFilter" id="disk" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('disk')">
                        disk
                    </button>
                    <button name="btnRowFilter" id="network" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('network')">
                        network
                    </button>
                    <button name="btnRowFilter" id="domain" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('domain')">
                        domain
                    </button>
                    <button name="btnRowFilter" id="comment" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('comment')">
                        comment
                    </button>
                    <button name="btnRowFilter" id="customer" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('customer')">
                        customer
                    </button>
                    <button name="btnRowFilter" id="Ra" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('Ra')">
                        userRa
                    </button>
                    <button name="btnRowFilter" id="Rt" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('Rt')">
                        userRt
                    </button>
                    <button name="btnRowFilter" id="entity" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('entity')">
                        entity_id
                    </button>
                    <button name="btnRowFilter" id="os" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('os')">
                        os_id
                    </button>
                    <button name="btnRowFilter" id="snapshot" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('snapshot')">
                        snapshot_id
                    </button>
                    <button name="btnRowFilter" id="backup" type="button"
                            class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('backup')">
                        backup_id
                    </button>
                    <button id="" type="button" class="btn btn-secondary w-100 rounded-0 mb-0 border-0 text-left"
                            onclick="filterRow('displayAll')">
                        tout afficher
                    </button>
                    <button id="" type="button" class="btn btn-secondary w-100 rounded-0 mb-0 border-0 text-left"
                            onclick="filterRow('hideAll')">
                        tout enlever
                    </button>
                </div>
            </div>
            <!--Export VM to Excel-->
            <a href="index.php?action=exportToExcel">
                <button type="button" class="btn btn-success w-100 rounded-0 mb-0 text-left">
                    Exporter
                </button>
            </a>
        </div>
        <div class="pb-5"><!-- DONT DELETE THAT /!\ --> </div>
        <!--Snapshot Modal Window-->
        <div class="modal fade" id="modalSnapshot" tabindex="-1" role="dialog" aria-labelledby="modalSnapshot"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="w-100 p-3">
                        <div class="w-50 float-left p-1">
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Gold', 26)">
                                <h5>Gold</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Silver', 26)">
                                <h5>Silver</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Bronze', 26)">
                                <h5>Bronze</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Aucun', 26)">
                                <h5>Aucun</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('', 26)">
                                <h5>Tous</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Backup Modal Window-->
        <div class="modal fade" id="modalBackup" tabindex="-1" role="dialog" aria-labelledby="modalBackup"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="w-100 p-3">
                        <div class="w-50 float-left p-1">
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Gold', 27)">
                                <h5>Gold</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Silver', 27)">
                                <h5>Silver</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Bronze', 27)">
                                <h5>Bronze</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterForInventoryVm('Aucun', 27)">
                                <h5>Aucun</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('', 27)">
                                <h5>Tous</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover allVM" id="allVmBody" hidden>
            <thead class="thead-dark sticky-top">
            <tr>
                <th name="goToButton" scope="col" style="min-width: 88px;" onclick="sortTablePlus(0, 0)">Statut
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="0_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="name" scope="col" style="min-width: 90px;" onclick="sortTable(1, 0)">name
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="1_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px" name="cluster" scope="col" onclick="sortTable(2, 0)">cluster
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="2_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 120px" name="dateStart" scope="col" onclick="sortTable(4, 0)">dateStart
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="4_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 160px" name="dateAnniversary" scope="col"
                    onclick="sortTable(6, 0)">dateAnniversary
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="6_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="dateEnd" scope="col" style="min-width: 120px" onclick="sortTable(8, 0)">dateEnd
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="8_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 130px" name="desc" scope="col" onclick="sortTable(9, 0)">description
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="9_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 60px" name="ip" scope="col" onclick="sortTable(10, 0)">ip
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="10_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 115px;" name="dnsName" scope="col" onclick="sortTable(11, 0)">
                    dnsName
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="11_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 135px;" name="redundance" scope="col" onclick="sortTable(12, 0)">
                    redundance
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="12_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style=" min-width: 126px;" name="usage" scope="col" onclick="sortTable(13, 0)">usageType
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="13_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px;" name="criticity" scope="col" onclick="sortTable(14, 0)">
                    criticity
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="14_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="cpu" scope="col" onclick="sortNumberTable(15, 0)">cpu
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="15_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="ram" scope="col" onclick="sortNumberTable(16, 0)">ram
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="16_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 80px;" name="disk" scope="col" onclick="sortNumberTable(17, 0)">disk
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="17_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 105px;" name="network" scope="col" onclick="sortTable(18, 0)">network
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="18_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 107px;" name="domain" scope="col" onclick="sortTable(19, 0)">domain
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="19_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 115px;" name="comment" scope="col" onclick="sortTable(20, 0)">comment
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="20_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="customer" scope="col" onclick="sortTable(21, 0)">customer
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="21_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Ra" scope="col" onclick="sortTable(22, 0)">userRa
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="22_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Rt" scope="col" onclick="sortTable(23, 0)">userRt
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="23_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="entity" scope="col" onclick="sortTable(24, 0)">entity_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="24_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="os" style="min-width: 90px" scope="col" onclick="sortTable(25, 0)">os_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="25_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 145px" name="snapshot" scope="col" onclick="sortTable(26, 0)">snapshot_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="26_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalSnapshot">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
                <th style="min-width: 140px" name="backup" scope="col" onclick="sortTable(27, 0)">backup_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="27_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalBackup">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <!--AllVM-->
            <tbody>
            <?php foreach ($allVM as $value): ?>
                <tr>
                    <td name="goToButton" id="<?= $value['vmStatus']; ?>">
                        <div class="btn-group" role="group">
                            <a href="index.php?action=detailsVM&id=<?php echo $value['id'] ?>">
                                <button type="button" class="btn btn-primary"
                                        style="background-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>); border-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>);"><strong>+</strong></button>
                            </a>
                        </div>
                    </td>
                    <td name="name"><?php echo $value['name'] ?></td>
                    <td style="display: none" name="cluster"><?php echo $value['cluster']['name'] ?></td>
                    <td name="dateStart"
                        style="min-width: 100px"><?php echo date("d.m.Y", strtotime($value['dateStart'])) ?></td>
                    <td hidden name="strDateStart"><?= strtotime($value['dateStart']); ?></td>
                    <td style="display: none"
                        name="dateAnniversary"><?php if ($value['dateAnniversary'] == null || $value['dateAnniversary'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateAnniversary']));
                        } ?></td>
                    <td hidden name="strDateAnniversary"><?= strtotime($value['dateAnniversary']); ?></td>
                    <td name="dateEnd"
                        style="min-width: 100px"><?php if ($value['dateEnd'] == null || $value['dateEnd'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateEnd']));
                        } ?></td>
                    <td hidden name="strDateEnd"><?= strtotime($value['dateEnd']); ?></td>
                    <td name="desc"><?php if (strlen($value['description']) > 9) {
                            echo substr($value['description'], 0, 10) . "...";
                        } else {
                            echo substr($value['description'], 0, 10);
                        } ?></td>
                    <td style="display: none" name="ip"><?php echo $value['ip'] ?></td>
                    <td style="display: none" name="dnsName"><?php echo $value['dnsName'] ?></td>
                    <td style="display: none" name="redundance"><?php

                        //Verification for display name of the vm for redundance and not to display there ID
                        if ($value['redundance'] != null || $value['redundance'] != 'null' || $value['redundance'] != ' ') {
                            if (strstr($value['redundance'], '0') || strstr($value['redundance'], '1') || strstr($value['redundance'], '2') || strstr($value['redundance'], '3') || strstr($value['redundance'], '4') || strstr($value['redundance'], '5') || strstr($value['redundance'], '6') || strstr($value['redundance'], '7') || strstr($value['redundance'], '8') || strstr($value['redundance'], '9')) {
                                foreach (explode(";", $value['redundance']) as $redundanceVal) {
                                    foreach ($allVmName as $vmName) {
                                        if ($redundanceVal == $vmName['id']) {
                                            echo $vmName['name'] . '; ';
                                        }
                                    }
                                }
                            } else {
                                echo $value['redundance'];
                            }

                        }

                        ?></td>
                    <td name="usage"><?php echo $value['usageType'] ?></td>
                    <td style="display: none" name="criticity"><?php echo $value['criticity'] ?></td>
                    <td name="cpu"><?php echo $value['cpu'] ?></td>
                    <td name="ram"><?php echo $value['ram'] ?></td>
                    <td name="disk"><?php echo $value['disk'] ?></td>
                    <td name="network"><?php echo $value['network'] ?></td>
                    <td name="domain"><?php if ($value['domain'] == 1) {
                            echo 'oui';
                        } else {
                            echo 'non';
                        } ?></td>
                    <td name="comment"><?php if (strlen($value['comment']) > 9) {
                            echo substr($value['comment'], 0, 10) . "...";
                        } else {
                            echo substr($value['comment'], 0, 10);
                        } ?></td>
                    <td name="customer"><?php echo $value['customer'] ?></td>
                    <td name="Ra"><?php echo $value['userRa'] ?></td>
                    <td name="Rt"><?php echo $value['userRt'] ?></td>
                    <td name="entity"><?php echo $value['entity_id'] ?></td>
                    <td name="os"
                        style="min-width: 100px"><?php echo $value['os_id']['1'] . " " . $value['os_id'][0] ?></td>
                    <td name="snapshot" style="min-width: 130px"><?php echo $value['snapshot_id']['1'] ?></td>
                    <td name="backup" style="min-width: 120px"><?php echo $value['backup_id']['1'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <table class="table table-hover allVM" id="allValidatedVmBody">
            <thead class="thead-dark sticky-top">
            <tr>
                <th name="goToButton" scope="col" style="min-width: 88px;" onclick="sortTablePlus(0, 0)">Statut
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="0_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="name" scope="col" style="min-width: 90px;" onclick="sortTable(1, 0)">name
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="1_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px" name="cluster" scope="col" onclick="sortTable(2, 0)">cluster
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="2_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 120px" name="dateStart" scope="col" onclick="sortTable(4, 0)">dateStart
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="4_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 160px" name="dateAnniversary" scope="col"
                    onclick="sortTable(6, 0)">dateAnniversary
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="6_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="dateEnd" scope="col" style="min-width: 120px" onclick="sortTable(8, 0)">dateEnd
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="8_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 130px" name="desc" scope="col" onclick="sortTable(9, 0)">description
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="9_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 60px" name="ip" scope="col" onclick="sortTable(10, 0)">ip
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="10_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 115px;" name="dnsName" scope="col" onclick="sortTable(11, 0)">
                    dnsName
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="11_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 135px;" name="redundance" scope="col" onclick="sortTable(12, 0)">
                    redundance
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="12_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style=" min-width: 126px;" name="usage" scope="col" onclick="sortTable(13, 0)">usageType
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="13_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px;" name="criticity" scope="col" onclick="sortTable(14, 0)">
                    criticity
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="14_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="cpu" scope="col" onclick="sortNumberTable(15, 0)">cpu
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="15_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="ram" scope="col" onclick="sortNumberTable(16, 0)">ram
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="16_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 80px;" name="disk" scope="col" onclick="sortNumberTable(17, 0)">disk
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="17_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 105px;" name="network" scope="col" onclick="sortTable(18, 0)">network
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="18_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 107px;" name="domain" scope="col" onclick="sortTable(19, 0)">domain
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="19_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 115px;" name="comment" scope="col" onclick="sortTable(20, 0)">comment
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="20_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="customer" scope="col" onclick="sortTable(21, 0)">customer
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="21_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Ra" scope="col" onclick="sortTable(22, 0)">userRa
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="22_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Rt" scope="col" onclick="sortTable(23, 0)">userRt
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="23_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="entity" scope="col" onclick="sortTable(24, 0)">entity_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="24_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="os" style="min-width: 90px" scope="col" onclick="sortTable(25, 0)">os_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="25_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 145px" name="snapshot" scope="col" onclick="sortTable(26, 0)">snapshot_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="26_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalSnapshot">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
                <th style="min-width: 140px" name="backup" scope="col" onclick="sortTable(27, 0)">backup_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="27_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalBackup">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <!--allValidatedVM-->
            <tbody>
            <?php foreach ($allValidatedVM as $value): ?>
                <tr>
                    <td name="goToButton" id="<?= $value['vmStatus']; ?>">
                        <div class="btn-group" role="group">
                            <a href="index.php?action=detailsVM&id=<?php echo $value['id'] ?>">
                                <button type="button" class="btn btn-primary"
                                        style="background-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>); border-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>);"><strong>+</strong></button>
                            </a>
                        </div>
                    </td>
                    <td name="name"><?php echo $value['name'] ?></td>
                    <td style="display: none" name="cluster"><?php echo $value['cluster']['name'] ?></td>
                    <td name="dateStart"
                        style="min-width: 100px"><?php echo date("d.m.Y", strtotime($value['dateStart'])) ?></td>
                    <td hidden name="strDateStart"><?= strtotime($value['dateStart']); ?></td>
                    <td style="display: none"
                        name="dateAnniversary"><?php if ($value['dateAnniversary'] == null || $value['dateAnniversary'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateAnniversary']));
                        } ?></td>
                    <td hidden name="strDateAnniversary"><?= strtotime($value['dateAnniversary']); ?></td>
                    <td name="dateEnd"
                        style="min-width: 100px"><?php if ($value['dateEnd'] == null || $value['dateEnd'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateEnd']));
                        } ?></td>
                    <td hidden name="strDateEnd"><?= strtotime($value['dateEnd']); ?></td>
                    <td name="desc"><?php if (strlen($value['description']) > 9) {
                            echo substr($value['description'], 0, 10) . "...";
                        } else {
                            echo substr($value['description'], 0, 10);
                        } ?></td>
                    <td style="display: none" name="ip"><?php echo $value['ip'] ?></td>
                    <td style="display: none" name="dnsName"><?php echo $value['dnsName'] ?></td>
                    <td style="display: none" name="redundance"><?php
                        //Verification for display name of the vm for redundance and not to display there ID
                        if ($value['redundance'] != null || $value['redundance'] != 'null' || $value['redundance'] != ' ') {
                            if (strstr($value['redundance'], '0') || strstr($value['redundance'], '1') || strstr($value['redundance'], '2') || strstr($value['redundance'], '3') || strstr($value['redundance'], '4') || strstr($value['redundance'], '5') || strstr($value['redundance'], '6') || strstr($value['redundance'], '7') || strstr($value['redundance'], '8') || strstr($value['redundance'], '9')) {
                                foreach (explode(";", $value['redundance']) as $redundanceVal) {
                                    foreach ($allVmName as $vmName) {
                                        if ($redundanceVal == $vmName['id']) {
                                            echo $vmName['name'] . '; ';
                                        }
                                    }
                                }
                            } else {
                                echo $value['redundance'];
                            }
                        }
                        ?></td>
                    <td name="usage"><?php echo $value['usageType'] ?></td>
                    <td style="display: none" name="criticity"><?php echo $value['criticity'] ?></td>
                    <td name="cpu"><?php echo $value['cpu'] ?></td>
                    <td name="ram"><?php echo $value['ram'] ?></td>
                    <td name="disk"><?php echo $value['disk'] ?></td>
                    <td name="network"><?php echo $value['network'] ?></td>
                    <td name="domain"><?php if ($value['domain'] == 1) {
                            echo 'oui';
                        } else {
                            echo 'non';
                        } ?></td>
                    <td name="comment"><?php if (strlen($value['comment']) > 9) {
                            echo substr($value['comment'], 0, 10) . "...";
                        } else {
                            echo substr($value['comment'], 0, 10);
                        } ?></td>
                    <td name="customer"><?php echo $value['customer'] ?></td>
                    <td name="Ra"><?php echo $value['userRa'] ?></td>
                    <td name="Rt"><?php echo $value['userRt'] ?></td>
                    <td name="entity"><?php echo $value['entity_id'] ?></td>
                    <td name="os"
                        style="min-width: 100px"><?php echo $value['os_id']['1'] . " " . $value['os_id'][0] ?></td>
                    <td name="snapshot" style="min-width: 130px"><?php echo $value['snapshot_id']['1'] ?></td>
                    <td name="backup" style="min-width: 120px"><?php echo $value['backup_id']['1'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <table class="table table-hover allVM" id="allConfirmationVmBody" hidden>
            <thead class="thead-dark sticky-top">
            <tr>
                <th name="goToButton" scope="col" style="min-width: 88px;" onclick="sortTablePlus(0, 0)">Statut
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="0_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="name" scope="col" style="min-width: 90px;" onclick="sortTable(1, 0)">name
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="1_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px" name="cluster" scope="col" onclick="sortTable(2, 0)">cluster
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="2_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 120px" name="dateStart" scope="col" onclick="sortTable(4, 0)">dateStart
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="4_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 160px" name="dateAnniversary" scope="col"
                    onclick="sortTable(6, 0)">dateAnniversary
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="6_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="dateEnd" scope="col" style="min-width: 120px" onclick="sortTable(8, 0)">dateEnd
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="8_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 130px" name="desc" scope="col" onclick="sortTable(9, 0)">description
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="9_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 60px" name="ip" scope="col" onclick="sortTable(10, 0)">ip
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="10_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 115px;" name="dnsName" scope="col" onclick="sortTable(11, 0)">
                    dnsName
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="11_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 135px;" name="redundance" scope="col" onclick="sortTable(12, 0)">
                    redundance
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="12_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style=" min-width: 126px;" name="usage" scope="col" onclick="sortTable(13, 0)">usageType
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="13_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px;" name="criticity" scope="col" onclick="sortTable(14, 0)">
                    criticity
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="14_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="cpu" scope="col" onclick="sortNumberTable(15, 0)">cpu
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="15_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="ram" scope="col" onclick="sortNumberTable(16, 0)">ram
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="16_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 80px;" name="disk" scope="col" onclick="sortNumberTable(17, 0)">disk
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="17_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 105px;" name="network" scope="col" onclick="sortTable(18, 0)">network
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="18_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 107px;" name="domain" scope="col" onclick="sortTable(19, 0)">domain
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="19_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 115px;" name="comment" scope="col" onclick="sortTable(20, 0)">comment
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="20_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="customer" scope="col" onclick="sortTable(21, 0)">customer
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="21_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Ra" scope="col" onclick="sortTable(22, 0)">userRa
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="22_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Rt" scope="col" onclick="sortTable(23, 0)">userRt
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="23_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="entity" scope="col" onclick="sortTable(24, 0)">entity_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="24_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="os" style="min-width: 90px" scope="col" onclick="sortTable(25, 0)">os_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="25_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 145px" name="snapshot" scope="col" onclick="sortTable(26, 0)">snapshot_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="26_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalSnapshot">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
                <th style="min-width: 140px" name="backup" scope="col" onclick="sortTable(27, 0)">backup_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="27_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalBackup">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <!--allConfirmationVM-->
            <tbody>
            <?php foreach ($allConfirmationVM as $value): ?>
                <tr>
                    <td name="goToButton" id="<?= $value['vmStatus']; ?>">
                        <div class="btn-group" role="group">
                            <a href="index.php?action=detailsVM&id=<?php echo $value['id'] ?>">
                                <button type="button" class="btn btn-primary"
                                        style="background-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>); border-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>);"><strong>+</strong></button>
                            </a>
                        </div>
                    </td>
                    <td name="name"><?php echo $value['name'] ?></td>
                    <td style="display: none" name="cluster"><?php echo $value['cluster']['name'] ?></td>
                    <td name="dateStart"
                        style="min-width: 100px"><?php echo date("d.m.Y", strtotime($value['dateStart'])) ?></td>
                    <td hidden name="strDateStart"><?= strtotime($value['dateStart']); ?></td>
                    <td style="display: none"
                        name="dateAnniversary"><?php if ($value['dateAnniversary'] == null || $value['dateAnniversary'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateAnniversary']));
                        } ?></td>
                    <td hidden name="strDateAnniversary"><?= strtotime($value['dateAnniversary']); ?></td>
                    <td name="dateEnd"
                        style="min-width: 100px"><?php if ($value['dateEnd'] == null || $value['dateEnd'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateEnd']));
                        } ?></td>
                    <td hidden name="strDateEnd"><?= strtotime($value['dateEnd']); ?></td>
                    <td name="desc"><?php if (strlen($value['description']) > 9) {
                            echo substr($value['description'], 0, 10) . "...";
                        } else {
                            echo substr($value['description'], 0, 10);
                        } ?></td>
                    <td style="display: none" name="ip"><?php echo $value['ip'] ?></td>
                    <td style="display: none" name="dnsName"><?php echo $value['dnsName'] ?></td>
                    <td style="display: none" name="redundance"><?php
                        //Verification for display name of the vm for redundance and not to display there ID
                        if ($value['redundance'] != null || $value['redundance'] != 'null' || $value['redundance'] != ' ') {
                            if (strstr($value['redundance'], '0') || strstr($value['redundance'], '1') || strstr($value['redundance'], '2') || strstr($value['redundance'], '3') || strstr($value['redundance'], '4') || strstr($value['redundance'], '5') || strstr($value['redundance'], '6') || strstr($value['redundance'], '7') || strstr($value['redundance'], '8') || strstr($value['redundance'], '9')) {
                                foreach (explode(";", $value['redundance']) as $redundanceVal) {
                                    foreach ($allVmName as $vmName) {
                                        if ($redundanceVal == $vmName['id']) {
                                            echo $vmName['name'] . '; ';
                                        }
                                    }
                                }
                            } else {
                                echo $value['redundance'];
                            }
                        }
                        ?></td>
                    <td name="usage"><?php echo $value['usageType'] ?></td>
                    <td style="display: none" name="criticity"><?php echo $value['criticity'] ?></td>
                    <td name="cpu"><?php echo $value['cpu'] ?></td>
                    <td name="ram"><?php echo $value['ram'] ?></td>
                    <td name="disk"><?php echo $value['disk'] ?></td>
                    <td name="network"><?php echo $value['network'] ?></td>
                    <td name="domain"><?php if ($value['domain'] == 1) {
                            echo 'oui';
                        } else {
                            echo 'non';
                        } ?></td>
                    <td name="comment"><?php if (strlen($value['comment']) > 9) {
                            echo substr($value['comment'], 0, 10) . "...";
                        } else {
                            echo substr($value['comment'], 0, 10);
                        } ?></td>
                    <td name="customer"><?php echo $value['customer'] ?></td>
                    <td name="Ra"><?php echo $value['userRa'] ?></td>
                    <td name="Rt"><?php echo $value['userRt'] ?></td>
                    <td name="entity"><?php echo $value['entity_id'] ?></td>
                    <td name="os"
                        style="min-width: 100px"><?php echo $value['os_id']['1'] . " " . $value['os_id'][0] ?></td>
                    <td name="snapshot" style="min-width: 130px"><?php echo $value['snapshot_id']['1'] ?></td>
                    <td name="backup" style="min-width: 120px"><?php echo $value['backup_id']['1'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <table class="table table-hover allVM" id="allRenewalVmBody" hidden>
            <thead class="thead-dark sticky-top">
            <tr>
                <th name="goToButton" scope="col" style="min-width: 88px;" onclick="sortTablePlus(0, 0)">Statut
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="0_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="name" scope="col" style="min-width: 90px;" onclick="sortTable(1, 0)">name
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="1_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px" name="cluster" scope="col" onclick="sortTable(2, 0)">cluster
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="2_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 120px" name="dateStart" scope="col" onclick="sortTable(4, 0)">dateStart
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="4_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 160px" name="dateAnniversary" scope="col"
                    onclick="sortTable(6, 0)">dateAnniversary
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="6_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="dateEnd" scope="col" style="min-width: 120px" onclick="sortTable(8, 0)">dateEnd
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="8_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 130px" name="desc" scope="col" onclick="sortTable(9, 0)">description
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="9_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 60px" name="ip" scope="col" onclick="sortTable(10, 0)">ip
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="10_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 115px;" name="dnsName" scope="col" onclick="sortTable(11, 0)">
                    dnsName
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="11_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 135px;" name="redundance" scope="col" onclick="sortTable(12, 0)">
                    redundance
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="12_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style=" min-width: 126px;" name="usage" scope="col" onclick="sortTable(13, 0)">usageType
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="13_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px;" name="criticity" scope="col" onclick="sortTable(14, 0)">
                    criticity
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="14_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="cpu" scope="col" onclick="sortNumberTable(15, 0)">cpu
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="15_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="ram" scope="col" onclick="sortNumberTable(16, 0)">ram
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="16_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 80px;" name="disk" scope="col" onclick="sortNumberTable(17, 0)">disk
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="17_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 105px;" name="network" scope="col" onclick="sortTable(18, 0)">network
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="18_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 107px;" name="domain" scope="col" onclick="sortTable(19, 0)">domain
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="19_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 115px;" name="comment" scope="col" onclick="sortTable(20, 0)">comment
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="20_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="customer" scope="col" onclick="sortTable(21, 0)">customer
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="21_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Ra" scope="col" onclick="sortTable(22, 0)">userRa
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="22_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Rt" scope="col" onclick="sortTable(23, 0)">userRt
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="23_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="entity" scope="col" onclick="sortTable(24, 0)">entity_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="24_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="os" style="min-width: 90px" scope="col" onclick="sortTable(25, 0)">os_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="25_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 145px" name="snapshot" scope="col" onclick="sortTable(26, 0)">snapshot_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="26_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalSnapshot">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
                <th style="min-width: 140px" name="backup" scope="col" onclick="sortTable(27, 0)">backup_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="27_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalBackup">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <!--allRenewalVmBody-->
            <tbody>
            <?php foreach ($allRenewalVM as $value): ?>
                <tr>
                    <td name="goToButton" id="<?= $value['vmStatus']; ?>">
                        <div class="btn-group" role="group">
                            <a href="index.php?action=detailsVM&id=<?php echo $value['id'] ?>">
                                <button type="button" class="btn btn-primary"
                                        style="background-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>); border-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>);"><strong>+</strong></button>
                            </a>
                        </div>
                    </td>
                    <td name="name"><?php echo $value['name'] ?></td>
                    <td style="display: none" name="cluster"><?php echo $value['cluster']['name'] ?></td>
                    <td name="dateStart"
                        style="min-width: 100px"><?php echo date("d.m.Y", strtotime($value['dateStart'])) ?></td>
                    <td hidden name="strDateStart"><?= strtotime($value['dateStart']); ?></td>
                    <td style="display: none"
                        name="dateAnniversary"><?php if ($value['dateAnniversary'] == null || $value['dateAnniversary'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateAnniversary']));
                        } ?></td>
                    <td hidden name="strDateAnniversary"><?= strtotime($value['dateAnniversary']); ?></td>
                    <td name="dateEnd"
                        style="min-width: 100px"><?php if ($value['dateEnd'] == null || $value['dateEnd'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateEnd']));
                        } ?></td>
                    <td hidden name="strDateEnd"><?= strtotime($value['dateEnd']); ?></td>
                    <td name="desc"><?php if (strlen($value['description']) > 9) {
                            echo substr($value['description'], 0, 10) . "...";
                        } else {
                            echo substr($value['description'], 0, 10);
                        } ?></td>
                    <td style="display: none" name="ip"><?php echo $value['ip'] ?></td>
                    <td style="display: none" name="dnsName"><?php echo $value['dnsName'] ?></td>
                    <td style="display: none" name="redundance"><?php
                        //Verification for display name of the vm for redundance and not to display there ID
                        if ($value['redundance'] != null || $value['redundance'] != 'null' || $value['redundance'] != ' ') {
                            if (strstr($value['redundance'], '0') || strstr($value['redundance'], '1') || strstr($value['redundance'], '2') || strstr($value['redundance'], '3') || strstr($value['redundance'], '4') || strstr($value['redundance'], '5') || strstr($value['redundance'], '6') || strstr($value['redundance'], '7') || strstr($value['redundance'], '8') || strstr($value['redundance'], '9')) {
                                foreach (explode(";", $value['redundance']) as $redundanceVal) {
                                    foreach ($allVmName as $vmName) {
                                        if ($redundanceVal == $vmName['id']) {
                                            echo $vmName['name'] . '; ';
                                        }
                                    }
                                }
                            } else {
                                echo $value['redundance'];
                            }
                        }
                        ?></td>
                    <td name="usage"><?php echo $value['usageType'] ?></td>
                    <td style="display: none" name="criticity"><?php echo $value['criticity'] ?></td>
                    <td name="cpu"><?php echo $value['cpu'] ?></td>
                    <td name="ram"><?php echo $value['ram'] ?></td>
                    <td name="disk"><?php echo $value['disk'] ?></td>
                    <td name="network"><?php echo $value['network'] ?></td>
                    <td name="domain"><?php if ($value['domain'] == 1) {
                            echo 'oui';
                        } else {
                            echo 'non';
                        } ?></td>
                    <td name="comment"><?php if (strlen($value['comment']) > 9) {
                            echo substr($value['comment'], 0, 10) . "...";
                        } else {
                            echo substr($value['comment'], 0, 10);
                        } ?></td>
                    <td name="customer"><?php echo $value['customer'] ?></td>
                    <td name="Ra"><?php echo $value['userRa'] ?></td>
                    <td name="Rt"><?php echo $value['userRt'] ?></td>
                    <td name="entity"><?php echo $value['entity_id'] ?></td>
                    <td name="os"
                        style="min-width: 100px"><?php echo $value['os_id']['1'] . " " . $value['os_id'][0] ?></td>
                    <td name="snapshot" style="min-width: 130px"><?php echo $value['snapshot_id']['1'] ?></td>
                    <td name="backup" style="min-width: 120px"><?php echo $value['backup_id']['1'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <table class="table table-hover allVM" id="allDeletedVmBody" hidden>
            <thead class="thead-dark sticky-top">
            <tr>
                <th name="goToButton" scope="col" style="min-width: 88px;" onclick="sortTablePlus(0, 0)">Statut
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="0_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="0_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="name" scope="col" style="min-width: 90px;" onclick="sortTable(1, 0)">name
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="1_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px" name="cluster" scope="col" onclick="sortTable(2, 0)">cluster
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="2_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 120px" name="dateStart" scope="col" onclick="sortTable(4, 0)">dateStart
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="4_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 160px" name="dateAnniversary" scope="col"
                    onclick="sortTable(6, 0)">dateAnniversary
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="6_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="6_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="dateEnd" scope="col" style="min-width: 120px" onclick="sortTable(8, 0)">dateEnd
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="8_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="8_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 130px" name="desc" scope="col" onclick="sortTable(9, 0)">description
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="9_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="9_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 60px" name="ip" scope="col" onclick="sortTable(10, 0)">ip
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="10_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="10_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 115px;" name="dnsName" scope="col" onclick="sortTable(11, 0)">
                    dnsName
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="11_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="11_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 135px;" name="redundance" scope="col" onclick="sortTable(12, 0)">
                    redundance
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="12_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="12_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style=" min-width: 126px;" name="usage" scope="col" onclick="sortTable(13, 0)">usageType
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="13_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="13_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="display: none; min-width: 100px;" name="criticity" scope="col" onclick="sortTable(14, 0)">
                    criticity
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="14_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="14_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="cpu" scope="col" onclick="sortNumberTable(15, 0)">cpu
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="15_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="15_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 75px;" name="ram" scope="col" onclick="sortNumberTable(16, 0)">ram
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="16_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="16_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 80px;" name="disk" scope="col" onclick="sortNumberTable(17, 0)">disk
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="17_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="17_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 105px;" name="network" scope="col" onclick="sortTable(18, 0)">network
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="18_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="18_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 107px;" name="domain" scope="col" onclick="sortTable(19, 0)">domain
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="19_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="19_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 115px;" name="comment" scope="col" onclick="sortTable(20, 0)">comment
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="20_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="20_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="customer" scope="col" onclick="sortTable(21, 0)">customer
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="21_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="21_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Ra" scope="col" onclick="sortTable(22, 0)">userRa
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="22_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="22_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 95px;" name="Rt" scope="col" onclick="sortTable(23, 0)">userRt
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="23_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="23_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 110px;" name="entity" scope="col" onclick="sortTable(24, 0)">entity_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="24_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="24_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th name="os" style="min-width: 90px" scope="col" onclick="sortTable(25, 0)">os_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="25_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="25_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </th>
                <th style="min-width: 145px" name="snapshot" scope="col" onclick="sortTable(26, 0)">snapshot_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="26_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="26_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalSnapshot">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
                <th style="min-width: 140px" name="backup" scope="col" onclick="sortTable(27, 0)">backup_id
                    <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" id="27_none_all">
                        <path fill-rule="evenodd"
                              d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                    </svg>
                    <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_up_all">
                        <path fill-rule="evenodd"
                              d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                    <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="27_down_all">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                         viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                         data-target="#modalBackup">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <!--allDeletedVmBody-->
            <tbody>
            <?php foreach ($allDeletedVM as $value): ?>
                <tr>
                    <td name="goToButton" id="<?= $value['vmStatus']; ?>">
                        <div class="btn-group" role="group">
                            <a href="index.php?action=detailsVM&id=<?php echo $value['id'] ?>">
                                <button type="button" class="btn btn-primary"
                                        style="background-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>); border-color: rgba(<?php if ($value['vmStatus'] == 2) {
                                            echo '40,167,69,0.7';
                                        } elseif ($value['vmStatus'] == 0) {
                                            echo '255,165,69,0.7';
                                        } elseif ($value['vmStatus'] == 3) {
                                            echo '233,48,48,0.7';
                                        } else {
                                            echo '90,90,90,0.7';
                                        } ?>);"><strong>+</strong></button>
                            </a>
                        </div>
                    </td>
                    <td name="name"><?php echo $value['name'] ?></td>
                    <td style="display: none" name="cluster"><?php echo $value['cluster']['name'] ?></td>
                    <td name="dateStart"
                        style="min-width: 100px"><?php echo date("d.m.Y", strtotime($value['dateStart'])) ?></td>
                    <td hidden name="strDateStart"><?= strtotime($value['dateStart']); ?></td>
                    <td style="display: none"
                        name="dateAnniversary"><?php if ($value['dateAnniversary'] == null || $value['dateAnniversary'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateAnniversary']));
                        } ?></td>
                    <td hidden name="strDateAnniversary"><?= strtotime($value['dateAnniversary']); ?></td>
                    <td name="dateEnd"
                        style="min-width: 100px"><?php if ($value['dateEnd'] == null || $value['dateEnd'] == 'null') {
                            echo '';
                        } else {
                            echo date("d.m.Y", strtotime($value['dateEnd']));
                        } ?></td>
                    <td hidden name="strDateEnd"><?= strtotime($value['dateEnd']); ?></td>
                    <td name="desc"><?php if (strlen($value['description']) > 9) {
                            echo substr($value['description'], 0, 10) . "...";
                        } else {
                            echo substr($value['description'], 0, 10);
                        } ?></td>
                    <td style="display: none" name="ip"><?php echo $value['ip'] ?></td>
                    <td style="display: none" name="dnsName"><?php echo $value['dnsName'] ?></td>
                    <td style="display: none" name="redundance"><?php
                        //Verification for display name of the vm for redundance and not to display there ID
                        if ($value['redundance'] != null || $value['redundance'] != 'null' || $value['redundance'] != ' ') {
                            if (strstr($value['redundance'], '0') || strstr($value['redundance'], '1') || strstr($value['redundance'], '2') || strstr($value['redundance'], '3') || strstr($value['redundance'], '4') || strstr($value['redundance'], '5') || strstr($value['redundance'], '6') || strstr($value['redundance'], '7') || strstr($value['redundance'], '8') || strstr($value['redundance'], '9')) {
                                foreach (explode(";", $value['redundance']) as $redundanceVal) {
                                    foreach ($allVmName as $vmName) {
                                        if ($redundanceVal == $vmName['id']) {
                                            echo $vmName['name'] . '; ';
                                        }
                                    }
                                }
                            } else {
                                echo $value['redundance'];
                            }
                        }
                        ?></td>
                    <td name="usage"><?php echo $value['usageType'] ?></td>
                    <td style="display: none" name="criticity"><?php echo $value['criticity'] ?></td>
                    <td name="cpu"><?php echo $value['cpu'] ?></td>
                    <td name="ram"><?php echo $value['ram'] ?></td>
                    <td name="disk"><?php echo $value['disk'] ?></td>
                    <td name="network"><?php echo $value['network'] ?></td>
                    <td name="domain"><?php if ($value['domain'] == 1) {
                            echo 'oui';
                        } else {
                            echo 'non';
                        } ?></td>
                    <td name="comment"><?php if (strlen($value['comment']) > 9) {
                            echo substr($value['comment'], 0, 10) . "...";
                        } else {
                            echo substr($value['comment'], 0, 10);
                        } ?></td>
                    <td name="customer"><?php echo $value['customer'] ?></td>
                    <td name="Ra"><?php echo $value['userRa'] ?></td>
                    <td name="Rt"><?php echo $value['userRt'] ?></td>
                    <td name="entity"><?php echo $value['entity_id'] ?></td>
                    <td name="os"
                        style="min-width: 100px"><?php echo $value['os_id']['1'] . " " . $value['os_id'][0] ?></td>
                    <td name="snapshot" style="min-width: 130px"><?php echo $value['snapshot_id']['1'] ?></td>
                    <td name="backup" style="min-width: 120px"><?php echo $value['backup_id']['1'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>


</div>
<script>
    var allVm = <?= json_encode($allVM); ?>;
    var i;
    var allVmCount = allVm.length;
    var vmConfirmed = 0;
    var vmToBeConfirmed = 0;
    var vmRenew = 0;
    var vmDeleted = 0;
    for (i = 0; i < allVm.length; i++) {
        switch (allVm[i]['vmStatus']) {
            case '0':
                vmToBeConfirmed++;
                break;
            case '2':
                vmConfirmed++;
                break;
            case '3':
                vmRenew++;
                break;
            case '5':
                vmDeleted++;
                break;
        }
    }
    document.getElementById("numberOfVM").innerHTML = allVmCount;
    document.getElementById("numberOfConfirmedVM").textContent = vmConfirmed;
    document.getElementById("numberOfToBeConfirmedVM").innerText = vmToBeConfirmed;
    document.getElementById("numberOfRenewalVM").innerHTML = vmRenew;
    document.getElementById("numberOfDeletedVM").innerHTML = vmDeleted;
</script>

<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
