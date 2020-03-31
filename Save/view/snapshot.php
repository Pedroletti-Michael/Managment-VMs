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
        <meta charset="UTF-8">
        <title>Table snapshot - HEIG-VD</title>
    </head>
    <body>
    <div class="pr-3 pt-3">
        <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">Base de données - Table - snapshot</h3>

        <table class="table">
            <thead>
            <tr>
                <th class="w-25" scope="col">Key</th>
                <th class="w-25" scope="col">Name</th>
                <th class="w-25" scope="col">Type</th>
                <th class="w-25" scope="col"><a class="float-right pr-4">Modifier/Supprimer</a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">PK</th>
                <td>user_id</td>
                <td>int</td>
                <td>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning disabled" disabled>Modifier</button>
                        <button type="button" class="btn btn-danger disabled" disabled>Supprimer</button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>type</td>
                <td>short</td>
                <td>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning">Modifier</button>
                        <button type="button" class="btn btn-danger">Supprimer</button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>lastname</td>
                <td>varchar</td>
                <td>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning">Modifier</button>
                        <button type="button" class="btn btn-danger">Supprimer</button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>firstname</td>
                <td>varchar</td>
                <td>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning">Modifier</button>
                        <button type="button" class="btn btn-danger">Supprimer</button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>mail</td>
                <td>email</td>
                <td>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning">Modifier</button>
                        <button type="button" class="btn btn-danger">Supprimer</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-success w-100">Ajouter un attribut</button>
    </div>

<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>