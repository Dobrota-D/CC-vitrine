<?php
    function OpenCon(){

     $dbhost = "localhost";
     $dbuser = "root";
     $dbpass = "";
     $db = "cantineclub_bdd";
     $conn = new PDO("mysql:host={$dbhost};dbname={$db}", $dbuser, $dbpass) or die("Connect failed: %s\n". $conn -> error);
     
     return $conn;
     }
     
    function CloseCon($conn)
     {
     $conn = null;
     return $conn;
     }
       
    ?>