<?php

session_start();

include "conexion.php";

$correo = $_POST['Correo'];
$clave = $_POST['Clave'];

$sql = mysqli_query($con, "SELECT id, Correo, Clave FROM usuarios WHERE Correo = '".$correo."' AND Clave = '".$clave."' ");
$row = mysqli_num_rows($sql);

$sql2 = mysqli_query($con, "SELECT Correo, Clave FROM admins WHERE Correo = '".$correo."' AND Clave = '".$clave."' ");
$row2 = mysqli_num_rows($sql2);

if ($row == 1){

    // echo "Correo en sesión: " . $_SESSION['correo'];

    $fila = $sql->fetch_assoc();
    $_SESSION['correo'] = $correo;
    $_SESSION['idUsuario'] = $fila['id'];
    $_SESSION['rol'] = 0;
    $_SESSION['sesion'] = true;
    header("location: ../index.php");
    
    // var_dump($fila);

} 
elseif ($row2 == 1) {
    $fila = $sql2->fetch_assoc();
    $_SESSION['rol'] = 1;
    $_SESSION['sesion'] = true;
    header("location: ../admin/adminMenu.html");

}
else{
    
    header("location: ../login.html");
    echo '<script>alert("Usuario no encontrado");</script>';
}

?>