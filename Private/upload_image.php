<?php 
    require("db.php");

    $photo = "";

    if(isset($_POST['btnValider'])){
        
        $nom = $_POST['NomDuPlat'];
        $desc = $_POST['DescDuPlat'];
        $prix = $_POST['PrixDuPlat'];

        $photo = $_FILES['PhotoDuPlat']['name'];
        $upload = "Picture/" .$photo;

        move_uploaded_file($_FILES['PhotoDuPlat']['tmp_name'], $upload);

        $sql = "INSERT INTO carte(nom,ingredients,prix,photo) VALUES ('$nom', '$desc', '$prix', '$photo' )";

        if(mysqli_query($conn,$sql)){
            echo "Image Ajouter";
        }else {
            echo "Erreur durant l'ajout de l'image";
        }
    }

    if(isset($_GET['delete'])){

        $sql = "DELETE FROM carte WHERE id_item='".$_GET["delete"]."'";

        if(mysqli_query($conn,$sql)){
            unlink("Picture/".$_GET['picture']);

            echo 'Image supprimer avec succes';

            header('Refresh:0,AdminPage.php');
        }
        else{
            echo "Erreur durant la supression de l'image";
        }
    }
?>