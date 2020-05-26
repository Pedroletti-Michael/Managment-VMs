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
        <title>Gestion VM - HEIG-VD</title>
    </head>
    <body>
    <div class="table-responsive-xl">
        <table class="table table-hover allVM">
        <thead class="thead-dark sticky-top">
        <tr>
            <th scope="col" style="width: 50px"></th>
            <th scope="col">name</th>
            <th scope="col">os_id</th>
            <th scope="col">dateStart</th>
            <th scope="col">dateEnd</th>
            <th scope="col">usageType</th>
            <th scope="col">cpu</th>
            <th scope="col">ram</th>
            <th scope="col">disk</th>
            <th scope="col">network</th>
            <th scope="col">userRt</th>
            <th scope="col">entity_id</th>
            <th scope="col">creationDate</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($confirmationVM as $value): ?>
           <tr>
               <td>
                   <a href="index.php?action=detailsVM&id=<?php echo $value['id']?>"><button type="submit" class="btn btn-primary"><strong>+</strong></button></a>
               </td>
                <td><?php echo $value['name']?></a></td>
                <td style="min-width: 100px"><?php echo $value['os_id']['1']." ".$value['os_id']['0']?></td>
                <td style="min-width: 100px"><?php echo $value['dateStart']?></td>
                <td style="min-width: 100px"><?php echo $value['dateEnd']?></td>
                <td><?php echo $value['usageType']?></td>
                <td><?php echo $value['cpu']?></td>
                <td><?php echo $value['ram']?></td>
                <td><?php echo $value['disk']?></td>
                <td><?php echo $value['network']?></td>
                <td><?php echo $value['userRt']?></td>
                <td><?php echo $value['entity_id']?></td>
                <td><?php echo $value['timestampAdd']?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    </div>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>