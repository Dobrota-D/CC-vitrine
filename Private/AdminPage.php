<?php 

require("db.php");
require("upload_image.php"); 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">

    <label>Nom du plat</label>
    <input type="text" name="NomDuPlat" required><br><br>

    <label>Description du plat</label>
    <input type="text" name="DescDuPlat" required><br><br>

    <label>Prix</label>
    <input type="text" name="PrixDuPlat" required><br><br>
    
    <label>Photo du plat</label>
    <input type="file" name="PhotoDuPlat" accept="image/png, image/jpeg" required><br><br>

    <label></label>
    <input type="submit" value="Valider" name="btnValider">

    </form><br>

    <div>Liste des plats<br><br>
        <table>
            <tr>
                <th>Nom du plat</th>    
                <th>Description du plat</th>
                <th>Prix du plat</th>
                <th>Photo du plat</th>
                <th>Action</th>
            </tr>
            <?php 
                $query = mysqli_query($conn,"SELECT * FROM carte");

                while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                    echo '<tr><td> '.$row["nom"].'</td>';            
                    echo '<td> '.$row["ingredients"].'</td>';
                    echo '<td> '.$row["prix"].'</td>';
                    echo '<td> <img src="picture/'.$row["photo"].'" width="100" height="100"/></td>';
                    echo '<td> <button> <a href="?delete='.$row["id_item"].'&picture='.$row["photo"].'"> Supprimer </a></button></td>';
                    '</tr>';
                }
            ?>
        </table>
    </div>

</body>
</html>