<?php

    $conn = mysqli_connect("localhost","root","root","cantineclub_bdd");

    if($conn===false){
        die("Erreur: Non connecte au serveur ." . mysqli_connect_error());
    }
    
?>