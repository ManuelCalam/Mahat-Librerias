<?php
    session_start();

    function getCarritoProducts(){
        include 'php/conexion.php';

        $idUsuario = $_SESSION['idUsuario'];
        $sql = "SELECT productos.*, carrito.cantidad FROM carrito
                INNER JOIN productos ON carrito.producto_id = productos.id
                WHERE carrito.usuario_id = $idUsuario";
        $result = $con->query($sql);

        $productosCarrito = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productosCarrito[] = $row;
            }
        }

        $con->close();

        return $productosCarrito;
    }

    $productosCarrito = getCarritoProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
                           integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
                           crossorigin="anonymous" referrerpolicy="no-refferer">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <header>

        <nav>
            <input type="checkbox" id="click">
            <label for="click" class="btn">
                <i class="fa-solid fa-bars"></i>
            </label>
            <a href="#"><img src="Mahat_Logo.png" class="Logo"></a>

            <ul>        
                    
                <li><a id="a_shoppingCart" style="display: none;" href="Carrito.php"><img id="img_shoppingCart" src="shoppingCart.png" alt=""></a></li>  
                <li><a href="php/logOut.php">Salir</a></li>
                <li><a style="display: none;" id="li_Administrar" href="admin/adminMenu.html">Administrar</a></li>                                 
                <li><a id="li_Login" href="Login.html">Login</a></li>
                <li><a id="li_Registrar" href="Registrar.html">Registrarse</a></li>
                <li><a  href="Productos.php">Productos</a></li>
                <li><a href="index.php">Inicio</a></li> 
            </ul>
        </nav>
    </header>

    <section class="mainSection">
    <?php foreach ($productosCarrito as $productoCarrito) : ?>
            <div class="div_productoCarrito">
                <div class="div_imgCarrito">
                    <img src="<?php echo $productoCarrito['Imagen']; ?>" alt="<?php echo $productoCarrito['Titulo']; ?>">
                </div>
                
                <div class="div_Carrito-NombreProducto">
                    <h3><?php echo $productoCarrito['Titulo']; ?></h3>
                    <h4><?php echo $productoCarrito['Autor']; ?></h4>
                    <h4><?php echo $productoCarrito['Editorial']; ?></h4>
                </div>

                <div class="div_Carrito-precioProducto">
                    <h4><?php echo '$' . $productoCarrito['Precio']; ?></h4>
                </div>

                <div class="div_Carrito-cantidad">
                    <!-- <h4>Cantidad: <?php echo $productoCarrito['cantidad']; ?></h4> -->
                    <h4>Cantidad: </h4><input type="number" id="Cantidad" value="<?php echo $productoCarrito['cantidad']; ?>">
                </div>
            </div>
        <?php endforeach; ?>

        <a href="php/confirmarCompra.php"><button class="addToCart_Button">Completar Compra</button></a>

    </section>

    <footer>
            <div class="footerDiv">Jose Manuel Calam Manzanilla</div>
            <div class="footerDiv">4to P</div>
            <div class="footerDiv">Desarrollo Web | Bases de Datos</div>      
    </footer>


    <?php
        if ($_SESSION['sesion']) {
    ?>
        <script>
            
                // Código JavaScript para ocultar un elemento por su ID
                document.getElementById('li_Registrar').style.display = 'none';
                document.getElementById('li_Login').style.display = 'none';
                document.getElementById('a_shoppingCart').style.display = 'block';

                
            
        </script>
    <?php
            if ($_SESSION['rol'] == 1) { ?>
                <script>
            
                 
                document.getElementById('li_Administrar').style.display = 'block';
                document.getElementById('a_shoppingCart').style.display = 'none';

                
            
                </script>
    <?php
            } else {
                // //echo "no eres admin";
            }
        }
    ?>
</body>
</html>