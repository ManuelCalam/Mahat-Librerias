<?php
    session_start();
    include "../php/conexion.php";
    

    $fila = array();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // var_dump($_POST);
        if (isset($_POST['buscar'])) {
            $titulo = $_POST['Titulo'];


            $sql = "SELECT * FROM productos WHERE Titulo COLLATE utf8_unicode_ci = '$titulo'";
            $result = $con->query($sql);


            if ($result->num_rows > 0) {
                // Recorrer los resultados y almacenar la tupla en el array
                $fila = $result->fetch_assoc();
                $_SESSION['dataProducto'] = $fila;
                // echo "Buscar encontro este id: " . $fila['id'];

            } else {
                echo '<script>alert("No se encontró el producto");</script>';

            }
        }

        if (isset($_POST['eliminar'])) {
            $fila = $_SESSION['dataProducto'];
            if (isset($_SESSION['dataProducto'])) {
                    $deleteThisProduct = $fila['id'];
                    $sql = "DELETE FROM productos WHERE id = '$deleteThisProduct'";
                    $result = mysqli_query($con, $sql);
                    // echo $fila['id'];
                    
                    if($result){
                        echo '<script>alert("Producto eliminado correctamente");</script>';
                        echo '<script>window.location.href = "eliminarProductos.php";</script>';
                        $_SESSION['dataProducto'] = null;

                    }
                    else{
                        echo '<script>alert("' . $error_message . '");</script>';
                        echo '<script>window.location.href = "eliminarProductos.php";</script>';
                    }
                mysqli_close($con);
            }
            else{
                echo '<script>alert("Producto no encontrado");</script>';
            }
        }

    }

    


    

    
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
                <li><a href="../php/logOut.php">Salir</a></li>    
                <li><a href="adminMenu.html">Administrar</a></li>                    
                <li><a href="../Productos.php">Productos</a></li>
                <li><a href="../index.php">Inicio</a></li> 
            </ul>
        </nav>
    </header>

    <section class="mainSection" id="singInSection">

        <h2>Eliminar Productos</h2>
        <form action="eliminarProductos.php" method="POST" enctype="multipart/form-data">
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
                <button id="loginButton" type="submit" name="buscar">Buscar Producto</button>
                <button id="dletProductBTN" type="submit" name="eliminar">Eliminar Producto</button>

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
        document.getElementById("imagenPrevia").src = "<?php echo '../'.$fila['Imagen']; ?>";
        document.getElementById("imagenPrevia").style.display = 'block';



        // Repite esto para cada columna que quieras mostrar
    </script>
    <?php
} else {
    // echo "No se encontraron resultados.";
}
?>

</html>


