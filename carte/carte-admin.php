<?php
include '../db_connection.php';
$data = OpenCon();

if (isset($_POST["removeImage"])){
    $removeImage = $data -> prepare("DELETE FROM carte WHERE nom = :nom");
    $removeImage->bindValue(':nom', $_POST["itemID"]);
    $removeImage->execute();
}
if (isset($_FILES["imagePlat"])){
    if (move_uploaded_file($_FILES["imagePlat"]["tmp_name"], "../ImageCarte/".$_FILES["imagePlat"]["name"])) {
        $uploadImage = $data->prepare("INSERT INTO carte(image) VALUES(:image_path)");
        $imagePath = "../ImageCarte/".$_FILES["imagePlat"]["name"];
        $uploadImage->bindParam(":image_path", $imagePath);
        $uploadImage->execute();
        
        echo "Le fichier est valide, et a été téléchargé
           avec succès. Voici plus d'informations :\n";
    }
}
print_r($_FILES);

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="carte.css?v=<?php echo time(); ?>">
<title>La Carte</title>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="">
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
<div>
<input name="imagePlat" type="file" accept="image/png, image/jpeg">
</div>
<div>
    <input type="submit" name="envoyer image">
</div>
</form>

<?php 
$getCarte = $data->prepare("SELECT * FROM carte");
$getCarte->execute();
$carte = $getCarte->fetchAll();

if ($getCarte->rowCount() > 0) {
    for($i = 0; $i < count($carte); $i++){
?>  
        <div class="item-list">
            <p><?php echo $carte[$i]["nom"] ?></p>
            <p><?php echo $carte[$i]["ingredients"] ?></p>
            <p><?php echo $carte[$i]["prix"] ?>€ TTC</p>
            <img class="item-image" src="<?php echo $carte[$i]["image"] ?>" alt="item">
            <form method="post">
            <input type="hidden" name="itemID" value="<?php echo $carte[$i]["nom"]?>">
            <input type="submit" name="removeImage" value="supprimer">
            </form>
        </div>

        
        
        
        <?php   
    }
}
?>


</body>
</html>

<?php
$data = CloseCon($data);
?>