<?php 
    require_once("../dbconfig/connection.php");

    $database = Connection::getInstance();
            
    $reponse = $database->findAll("SELECT * FROM country");
?>
    
<h1>Mi primer reporte</h1>
<p>Hemos creado nuestro reporte usando PHP y HTML.</p>

<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Country Name</td>
            <td>Short Description</td>
            <td>Long Description</td>
        </tr>
    </thead>
    <?php foreach($reponse as $key => $value): ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['countryName']; ?></td>
            <td><?php echo $value['shortDesc']; ?></td>
            <td><?php echo $value['longDesc']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>