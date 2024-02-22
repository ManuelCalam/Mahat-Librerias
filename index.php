<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    ini_set('display_errors', 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahat Librerias</title>
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
                <li><a href="#">Inicio</a></li> 
            </ul>
        </nav>
    </header>

    <section class="mainSection">

        <div>
            <!-- <div class="editButton"> <button type="submit"><img src="editButton.png" ></button></div> -->
            <h2>Visión</h2>
                <p>En Mahat, aspiramos a ser la principal tienda de libros en línea, reconocida por su colección excepcional, experiencia de usuario 
                    excepcional y compromiso inquebrantable con la satisfacción del cliente. Buscamos transformar la forma en que las personas acceden
                    a la literatura y el conocimiento, convirtiéndonos en un destino difital confiable para aquellos que buscan inspiración, 
                    entretenimiento y aprendizaje a través de los libros.
                </p>
        </div>

        <div>
            <!-- <div class="editButton"> <button type="submit"><img src="editButton.png" ></button></div> -->
            <h2>Misión</h2>
            <p>Nuestra misión en Mahat es proporcionar a los amantes de la lectura un acceso conveniente y diverso a una aplia gama de libros
                en línea. Nos comprometemos a fomentar el conocimiento, la imaginación y el crecimiento personal al ofrecer una plataforma donde 
                puedan descubrir, explorar y adquirir lirbos de manera sencilla y enriquecedora.</p>
        </div>

        <div>
            <!-- <div class="editButton"> <button type="submit"><img src="editButton.png" ></button></div> -->
            <h2>Acerca de</h2>
            <p>Mahat es tu tienda de libros en línea, dedicada a llevar la lectura a tus manos de manera conveniente y 
                emocionante. Nuestra amplia colección abarca desde clásicos hasta novedades, ofreciéndote un mundo de 
                conocimiento y entretenimiento. Navega fácilmente, encuentra tus libros favoritos y únete a una comunidad 
                de amantes de la lectura. En Mahat, estamos aquí para enriquecer tu vida a través de las páginas de un libro.
            </p> <br>
        </div>    

        <div>
            <h2>Encuentranos en:</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1679.1407184474845!2d-103.38918446086153!3d20.702530761659883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ae4e98d5453d%3A0xc4fdd3929a2ecbd1!2sCentro%20de%20Ense%C3%B1anza%20T%C3%A9cnica%20Industrial%20(Plantel%20Colomos)!5e0!3m2!1ses-419!2smx!4v1694013808248!5m2!1ses-419!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                // //echo "no eres admin";
            }
        }
    ?>
</body>
</html>