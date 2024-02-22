<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    ini_set('display_errors', 0);
    function getAllProducts(){
        include 'php/conexion.php';


        $sql = "SELECT * FROM productos";
        $result = $con->query($sql);

        $productos = array();

        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y agregarlos al array de productos
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }  
        
        $con->close();

        return $productos;
    }

    $productos = getAllProducts();

    
    // var_dump(getAllProducts());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahat | Productos</title>
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
                    
                <li><a id="a_shoppingCart" href="Carrito.php" style="display: none;"><img id="img_shoppingCart" src="shoppingCart.png" alt=""></a></li>  
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
        <div class="productSections">
                <div class="productDiv defaultProduct" >
                    <div class="productDiv_Title">
                        <h3>It</h3>
                    </div>
                    

                    <div class="imgProduct">
                        <img src="Portadas/It - Stephen King.jpg" alt="">
                    </div>

                    <div class="productDiv_Author">
                        <h4>Stephen King</h4>
                    </div>

                    <div class="productDiv_Price">
                        <h5>$232.00</h5>
                    </div>

                    <div class="productDiv_Button">
                        <button class="addToCart_Button" type="submit">Agregar al carrito</button>
                    </div>
            </div>

        </div>

    </section>

    <footer>
            <div class="footerDiv">Jose Manuel Calam Manzanilla</div>
            <div class="footerDiv">4to P</div>
            <div class="footerDiv">Desarrollo Web | Bases de Datos</div>      
    </footer>

    <script>
            var productos = <?php echo json_encode($productos); ?>;

            function updateInterface(){
                var productSections = document.querySelector('.productSections');
                
                var defaultProducts = document.querySelectorAll('.defaultProduct');
                    defaultProducts.forEach(function(product) {
                        product.style.display = 'none';
                });

                productos.forEach(function(producto) {
                    var productDiv = document.createElement('div');
                    productDiv.className = 'productDiv';
                    // ... (genera dinámicamente el HTML para cada producto)

                    var titleDiv = document.createElement('div');
                    titleDiv.className = 'productDiv_Title';
                    titleDiv.innerHTML = '<h3>' + producto.Titulo + '</h3>';
                    productDiv.appendChild(titleDiv);

                    var imgDiv = document.createElement('div');
                    imgDiv.className = 'imgProduct';
                    imgDiv.innerHTML = '<img src="' + producto.Imagen + '" alt="' + producto.Nombre + '">';
                    productDiv.appendChild(imgDiv);

                    var authorDiv = document.createElement('div');
                    authorDiv.className = 'productDiv_Author';
                    authorDiv.innerHTML = '<h4>' + producto.Autor + '</h4>';
                    productDiv.appendChild(authorDiv);

                    var priceDiv = document.createElement('div');
                    priceDiv.className = 'productDiv_Price';
                    priceDiv.innerHTML = '<h5>$' + producto.Precio + '</h5>';
                    productDiv.appendChild(priceDiv);

                    var buttonDiv = document.createElement('div');
                    buttonDiv.className = 'productDiv_Button';
                    buttonDiv.innerHTML = '<form action="agregarCarrito.php" method="post">' +
                        '<input type="hidden" name="productId" value="' + producto.id + '">' +
                        '<button class="addToCart_Button" type="submit">Agregar al carrito</button>' +
                      '</form>';
                 
                     productDiv.appendChild(buttonDiv);

                    // Agregar el productDiv al contenedor principal
                    productSections.appendChild(productDiv);
                });
            }
            document.addEventListener('DOMContentLoaded', updateInterface);

    </script>

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