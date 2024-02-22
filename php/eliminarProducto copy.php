<?php

    
    include "conexion.php";

    $titulo = $_POST['Titulo'];
    // $autor = $_POST['Autor'];
    // $editorial = $_POST['Editorial'];
    // $genero = $_POST['Genero'];
    // $sinopsis = $_POST['Sinopsis'];
    // $precio = $_POST['Precio'];
    // $cantidad = $_POST['Cantidad'];

    // Manejo del archivo de imagen
    // $directorioDeImagenes = "../Portadas";

    // // Obtén el nombre del archivo proporcionado por el usuario
    // $nombreArchivo = basename($_FILES["Imagen"]["name"]);
    

    // Combina el nombre del directorio con el nombre del archivo
    // $ruta_imagen = $directorioDeImagenes . '/' . $nombreArchivo;
    
    //var_dump($_FILES);
    //echo $ruta_imagen;

    // Puedes validar aquí si el archivo realmente existe en el directorio antes de continuar

    $sql = "SELECT * FROM productos WHERE Titulo COLLATE utf8_unicode_ci = '$titulo'";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
        // Recorrer los resultados y almacenar la tupla en el array
        $fila = $result->fetch_assoc();


    } else {
        //echo "No se encontraron coincidencias.";
    }


    

    mysqli_close($con);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../index.css">
</head>
<body>
    <header>
        <nav>
            <input type="checkbox" id="click">
            <label for="click" class="btn">
                <i class="fa-solid fa-bars"></i>
            </label>
            <a href="#"><img src="../Mahat_Logo.png" class="Logo"></a>


            <ul>
                <li><a href="#">Salir</a></li>    
                <li><a href="../mostrarBitacora.php">Ver Bitacora</a></li> 
                <li><a href="adminMenu.html">Administrar</a></li>                    
                <li><a href="../Productos.php">Productos</a></li>
                <li><a href="../index.php">Inicio</a></li> 
            </ul>
        </nav>
    </header>

    <section class="mainSection" id="singInSection">

        <h2>Eliminar Productos</h2>
        <form action="../php/eliminarProducto.php" method="POST" enctype="multipart/form-data">
            <div>
                
                

                <input type="text" id="Titulo" name="Titulo" placeholder="Título" class="productForm"> <br>

                <input type="text" id="Autor" name="Autor" placeholder="Autor" class="productForm" disabled> <br>

                <input type="text" id="Editorial" name="Editorial" placeholder="Editorial" class="productForm" disabled> <br>

                <input type="text" id="Genero" name="Genero" placeholder="Genero" class="productForm" disabled> <br>

                <input type="text" id="Sinopsis" name="Sinopsis" placeholder="Sinopsis" class="productForm" disabled> <br>

                <input type="number" id="Precio" name="Precio" placeholder="Precio" class="productForm" disabled> <br>

                <input type="number" id="Cantidad" name="Cantidad" placeholder="En existencias" class="productForm" disabled>

                <input type="file" name="Imagen" id="Imagen" accept="image/*" required disabled>

                <img id="imagenPrevia" src="#" alt="Previsualización de la imagen" style="display:none; max-width: 50%; max-height: auto; margin: 0em 1.4em;">


               
            </div>

            <div>
                <button id="loginButton" type="submit">Buscar Producto</button>
                <button id="loginButton" type="submit">Eliminar Producto</button>

            </div>
        </form>
    </section>

    <footer>
            <div class="footerDiv">Jose Manuel Calam Manzanilla</div>
            <div class="footerDiv">4to P</div>
            <div class="footerDiv">Desarrollo Web | Bases de Datos</div>      
    </footer>
</body>

<script>
    document.getElementById('Imagen').addEventListener('change', mostrarPrevisualizacion);

    function mostrarPrevisualizacion() {
        var input = document.getElementById('Imagen');
        var preview = document.getElementById('imagenPrevia');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);


            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    
</script>

<?php
if (isset($fila)) {
    ?>
    <script>
        // Asignar valores a los campos de entrada usando JavaScript
        document.getElementById("Titulo").value = "<?php echo $fila['Titulo']; ?>";
        document.getElementById("Autor").value = "<?php echo $fila['Autor']; ?>";
        document.getElementById("Editorial").value = "<?php echo $fila['Editorial']; ?>";
        document.getElementById("Genero").value = "<?php echo $fila['Genero']; ?>";
        document.getElementById("Sinopsis").value = "<?php echo $fila['Sinopsis']; ?>";
        document.getElementById("Precio").value = "<?php echo $fila['Precio']; ?>";
        document.getElementById("Cantidad").value = "<?php echo $fila['Cantidad']; ?>";
        document.getElementById("imagenPrevia").src = "<?php echo $fila['Imagen']; ?>";
        document.getElementById("imagenPrevia").style.display = 'block';



        // Repite esto para cada columna que quieras mostrar
    </script>
    <?php
} else {
    echo "No se encontraron resultados.";
}
?>

</html>


