<?php
/**
 **/
ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Gestion form - HEIG-VD</title>
    </head>
    <body>
      <div class="container-fluid pt-3">
        <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">
            Gestion du formulare
        </h3>

        <!--Department / Institution / Service-->
        <div class="form-group" name="formulaire" id="form_Entity">
          <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service</label>
          <select multiple class="form-control mb-3" id="disFormControlSelect">
              <?php
              foreach ($entityNames as $value) {
                  echo "<option>".$value['entityName']."</option>";
              }
              ?>
          </select>

          <input type="text" class="form-control w-25 float-left" id="txt" name="txt" placeholder="texte">
          <button type="submit" class="btn btn-success float-left w-25" onclick="addBDD_Entity();">Ajouter</button>
          <button type="submit" class="btn btn-warning float-left w-25" onclick="">Modifier</button>
          <button type="submit" class="btn btn-danger float-left w-25" onclick="">Supprimer</button>
        </div>
          <!--OS-->
          <div class="form-group pt-5" name="formulaire">
              <label for="disFormControlSelect" class="font-weight-bold">OS</label>
              <select multiple class="form-control mb-3" id="disFormControlSelect">
                  <?php
                  foreach ($osNames as $value) {
                      echo "<option>".$value['osType']." ".$value['osName']."</option>";
                  }
                  ?>
              </select>

              <input type="text" class="form-control w-25 float-left" id="txt" name="txt" placeholder="texte">
              <button type="submit" class="btn btn-success float-left w-25" onclick="">Ajouter</button>
              <button type="submit" class="btn btn-warning float-left w-25" onclick="">Modifier</button>
              <button type="submit" class="btn btn-danger float-left w-25" onclick="">Supprimer</button>
          </div>

          <!--Snapshots-->
          <div class="form-group pt-5" name="formulaire">
              <label for="disFormControlSelect" class="font-weight-bold">Snapshots</label>
              <select multiple class="form-control mb-3" id="disFormControlSelect">
                  <?php
                  foreach ($snapshotPolicy as $value) {
                      echo "<option>".$value['policy']."</option>";
                  }
                  ?>
              </select>

              <input type="text" class="form-control w-25 float-left" id="txt" name="txt" placeholder="texte">
              <button type="submit" class="btn btn-success float-left w-25" onclick="">Ajouter</button>
              <button type="submit" class="btn btn-warning float-left w-25"onclick="">Modifier</button>
              <button type="submit" class="btn btn-danger float-left w-25"onclick="" >Supprimer</button>
          </div>

          <!--Backup-->
          <div class="form-group pt-5" name="formulaire">
              <label for="disFormControlSelect" class="font-weight-bold">Backup</label>
              <select multiple class="form-control mb-3" id="disFormControlSelect">
                  <?php
                  foreach ($backupPolicy as $value) {
                      echo "<option>".$value['policy']."</option>";
                  }
                  ?>
              </select>

              <input type="text" class="form-control w-25 float-left" id="txt" name="txt" placeholder="texte">
              <button type="submit" class="btn btn-success float-left w-25" onclick="">Ajouter</button>
              <button type="submit" class="btn btn-warning float-left w-25" onclick="">Modifier</button>
              <button type="submit" class="btn btn-danger float-left w-25" onclick="">Supprimer</button>
          </div>



<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>
