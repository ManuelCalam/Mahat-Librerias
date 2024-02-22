<?php
    session_start();

    include "php/conexion.php";

    $idUsuario = $_SESSION['idUsuario'];

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['productId'])) {
            $productId = $_POST['productId'];
            // echo $productId;

             $sql = mysqli_query($con, "INSERT INTO carrito (id, usuario_id, producto_id, cantidad) VALUES 
             (0, '$idUsuario', '$productId', 1)");


            if($sql){
                echo '<script>alert("Producto agregado al carrito");</script>';
                echo '<script>window.location.href = "Productos.php";</script>';
            }
            else{
                echo '<script>alert("Error en agregar el producto al carrito");</script>';
            }

            // header("Location: carrito.php");
        } else {
            // Manejar el caso en el que no se proporciona el ID del producto
            echo 'Error: ID de producto no proporcionado';
        }
    } else {
        // Manejar el caso en el que la solicitud no es de tipo POST
        echo 'Error: Solicitud no válida';
    }

?>