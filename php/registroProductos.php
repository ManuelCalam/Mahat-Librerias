<?php

    include "conexion.php";

    $titulo = $_POST['Titulo'];
    $autor = $_POST['Autor'];
    $editorial = $_POST['Editorial'];
    $genero = $_POST['Genero'];
    $sinopsis = $_POST['Sinopsis'];
    $precio = $_POST['Precio'];
    $cantidad = $_POST['Cantidad'];

    // Manejo del archivo de imagen
    $directorioDeImagenes = "Portadas";

    // Obtén el nombre del archivo proporcionado por el usuario
    $nombreArchivo = basename($_FILES["Imagen"]["name"]);
    

    // Combina el nombre del directorio con el nombre del archivo
    $ruta_imagen = $directorioDeImagenes . '/' . $nombreArchivo;
    
    //var_dump($_FILES);
    //echo $ruta_imagen;



    $sql = mysqli_query($con, "INSERT INTO productos (id, Titulo, Autor, Editorial, Genero, Sinopsis, Precio, 
    Cantidad, Imagen) VALUES (0, '$titulo', '$autor', '$editorial', '$genero', '$sinopsis', '$precio', '$cantidad', '$ruta_imagen')");


    if($sql){
        echo "Producto agregado agregado";
        header("location: ../admin/registrarProductos.html");
    }
    else{
        echo "Error en registrar producto" .$sql ."<br>" .mysqli_error($con);
    }

    mysqli_close($con);
?>