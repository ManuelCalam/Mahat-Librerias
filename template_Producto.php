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
            <a href="index.php"><img src="Mahat_Logo.png" class="Logo"></a>

            <ul>        
                    
                <li><a href="php/PDF.php">Link a pdf</a></li>  
                <li><a href="php/logOut.php">Salir</a></li>              
                <li><a id="li_Login" href="Login.html">Login</a></li>
                <li><a id="li_Registrar" href="Registrar.html">Registrarse</a></li>
                <li><a href="Productos.php">Productos</a></li>
                <li><a href="index.php">Inicio</a></li> 
            </ul>
        </nav>
    </header>

    <main class="mainSection" id="product_Container">
        <section id="img_Container">
            <img src="Portadas/Harry Potter y la Piedra Filosofal - JK Rowling.jpg" alt="">
        </section>

        <section id="data_Container">
            <div id="data_Container_Title">
                <h1>TITULO</h1>
            </div>

            <div id="data_Container_Author">
                <p>Autor</p>
            </div>

            <div id="data_Container_Editorial">
                <p>Editorial</p>
            </div>

            <div id="data_Container_Descrip">
                <p>Sinopsis</p>
            </div>
           
        </section>

        <section id="purchase_Section">
            <div id="purchase_Container">
                <p>a</p>
            </div>
        </section>
    </main>

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
            
        </script>
    <?php
            if ($_SESSION['rol'] == 1) { ?>
                <script>
            
                 
                document.getElementById('li_Administrar').style.display = 'block';
                
            
                </script>
    <?php
            } else {
                // //echo "no eres admin";
            }
        }
    ?>
</body>
</html>