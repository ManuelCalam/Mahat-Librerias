<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">

 



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

                <li><a id="a_shoppingCart" style="display: none;" href="carrito.php"><img id="img_shoppingCart" src="shoppingCart.png" alt=""></a></li>  
                <li><a href="php/logOut.php">Salir</a></li>
                <li><a style="display: none;" id="li_Administrar" href="admin/adminMenu.html">Administrar</a></li>                                 
                <li><a id="li_Login" href="Login.html">Login</a></li>
                <li><a id="li_Registrar" href="Registrar.html">Registrarse</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="index.php">Inicio</a></li>                
               
                
                
                
            </ul>
        </nav>
    </header>


    <section class="mainSection">
        <h1 style="text-align: left;">Productos</h1>
        <h2 style="text-align: left;">Novedades</h2>

        <div class="productSections">
            <div class="productDiv">
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

            <div class="productDiv">
                <div class="productDiv_Title">
                    <h3>Harry Potter y la Piedra Filosofal</h3>
                </div>

                <div class="imgProduct">
                    <img src="Portadas/Harry Potter y la Piedra Filosofal - JK Rowling.jpg" alt="">
                </div>

                <div class="productDiv_Author">
                    <h4>J.K. Rowling</h4>
                </div>

                <div class="productDiv_Price">
                    <h5>$299.00</h5>
                </div>

                <div class="productDiv_Button">
                    <button class="addToCart_Button" type="submit">Agregar al carrito</button>
                </div>
            </div>

            <div class="productDiv">
                <div class="productDiv_Title">
                    <h3>Harry Potter y la Camara Secreta</h3>
                </div>

                <div class="imgProduct">
                    <img src="Portadas/Harry Potter y la Camara Secreta - JK Rowling.jpg" alt="">
                </div>

                <div class="productDiv_Author">
                    <h4>J.K. Rowling</h4>
                </div>

                <div class="productDiv_Price">
                    <h5>$240.00</h5>
                </div>

                <div class="productDiv_Button">
                    <button class="addToCart_Button" type="submit">Agregar al carrito</button>
                </div>
            </div>

            <div class="productDiv">
                <div class="productDiv_Title">
                    <h3>Harry Potter y el Prisionero de Azkaban</h3>
                </div>

                <div class="imgProduct">
                    <img src="Portadas/Harry Potter y el Prisionero de Azkaban - JK Rowling.jpg" alt="">
                </div>

                <div class="productDiv_Author">
                    <h4>J.K. Rowling</h4>
                </div>

                <div class="productDiv_Price">
                    <h5>$329.00</h5>
                </div>

                <div class="productDiv_Button">
                    <button class="addToCart_Button" type="submit">Agregar al carrito</button>
                </div>
            </div>

            <div class="productDiv">
                <div class="productDiv_Title">
                    <h3>El principito</h3>
                </div>

                <div class="imgProduct">
                    <img src="Portadas/El principito - Antoine De Saint-Exupery.jpg" alt="">
                </div>

                <div class="productDiv_Author">
                    <h4>Antoine De Saint-Exupery.</h4>
                </div>

                <div class="productDiv_Price">
                    <h5>$100.00</h5>
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
                //echo "no eres admin";
            }
        }
    ?>

</body>
</html>