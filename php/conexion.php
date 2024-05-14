<?php

$servername = "10.0.0.5";
$database = "mahat";
$username = "mahat";
$password = "1234";

$con = mysqli_connect($servername, $username, $password, $database);

if(!$con){
    die("Fallo en la conexion" . mysqli_connect_error());
}
else{
    // echo "Conexion exitosa";
}

?>