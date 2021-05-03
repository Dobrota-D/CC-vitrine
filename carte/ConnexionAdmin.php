<?php

require_once "../db_connection.php";
$bdd = OpenCon();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Se connecter</title>
</head>
<body>
<?php


if (isset($_POST['valider'])){ 

    if(!isset($_POST['pseudo'])){ 
    }
    else if(!isset($_POST['motdepasse'])){ 
    } 
        else { 
            $pseudo = htmlentities ($_POST['pseudo'], ENT_QUOTES, "UTF-8");
            $motdepasse = $_POST['motdepasse'];
            $verif_id_mdp = $bdd -> prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo AND motdepasse = :motdepasse");
            $verif_id_mdp -> bindValue(':pseudo', $pseudo);
            $verif_id_mdp -> bindValue(':motdepasse', $motdepasse);
            $verif_id_mdp -> execute();
            $result_verif = $verif_id_mdp -> fetch();


            if($result_verif){ 
                header("Location: carte-admin.php");
            }
            else{ 
                echo "<script>alert('Pseudo ou mot de passe éronné')</script>";
            }
    }
}

$bdd = CloseCon($bdd);

    ?>
    <br>
    <p class="text-center"> Remplissez le formulaire ci-dessous pour vous connecter</p>
        <br>
        <br>
        <form method="post" action="ConnexionAdmin.php">

            <div class="col-4">
                <label for="formGroupExampleInput">pseudo</label>
                <input type="text" name="pseudo"class="form-control"placeholder="pseudo" required>
            </div>
            <br>
            <div class="col-4">
                <label for="formGroupExampleInput2">motdepasse</label>
                <input type="password" name="motdepasse"class="form-control"placeholder="mot de passe" required>
            </div>
            <br>
            <br>
            <div class="bouton1">
            <input type="submit" name="valider" class="btn btn-outline-secondary" value="Connexion" required>
            </div>
        </form>
        <br>
        <a class="retour" href="index.php">Retour au menu</a>
</body>
</html>

