<?php

$servername = "localhost";
$database = "mahat";
$username = "root";
$password = "";

$con = mysqli_connect($servername, $username, $password, $database);

if(!$con){
    die("Fallo en la conexion" . mysqli_connect_error());
}
else{
    // echo "Conexion exitosa";
}

?>