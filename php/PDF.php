<?php ob_start();
    session_start();
    $productosCarrito = getCarritoProducts();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../index.css"> -->

    
    <style>
    *{
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', sans-serif;

    }

    html, body{
        margin: 0%;
        padding: 0%;
    }

    body{
        background-color: rgb(255, 255, 255);
    }
    
    header{
        padding: 2em;
        background-color: #b8180d;
    }

    .Logo{
        position: absolute;
        height: 50px;
        padding: 1em 2em;
    }

    h1{
        color: white;
        font-family: sans-serif;
    }

    p{
        color: rgb(217, 217, 217);
        font-size: large;
        letter-spacing: 1px;
        font-weight: bold; 
    }

    footer{
        height: 100px;
        width: 100%;
        left: 0%;
        bottom: 0%;
        background-color: black;
        position: absolute;
        text-align: center;
    }

    main{
        margin: 2em;
    }

    table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

    th, td {
        /* border: 1px solid #dddddd; */
        border: 1px solid rgba(0, 0, 0, 0); /* Establece el color del borde como transparente */
        text-align: left;
        padding: 8px;
        font-family: sans-serif;
    }
    img{
        width: 30%;
    }

        /* th {
            background-color: #f2f2f2;
        } */
    
        /* Carrito */
    .div_productoCarrito{
        width: 100%;
        height: 10em;
        border-radius: 0.2rem; 
        background-color: blue;
        border-bottom: 2px solid #d8d8d8;
        display: flex;

    }

    .div_imgCarrito{
        width: 15%;
        height: 100%;
        /* padding: 0.03em 0; */
        max-width: 15%;
        padding: 0% 0%;
        border-radius: 0rem; 
        background-color: #b8180d;
    }

    .div_imgCarrito img{
        padding: 0;
        max-width: 90%;
        height: 90%;
        border-radius: 0%;
        margin: 0.03em;
    }

    .div_Carrito-NombreProducto{
        width: 70%;
        height: auto;
        text-align: left;
        padding-left: 1em;

        background-color: green;
    }

    .div_Carrito-NombreProducto h3{
        padding-bottom: 0%;
    }

    .div_Carrito-precioProducto{
        width: 20%;
        height: auto;
        background-color: orange;
    }



    </style>

</head>

<body>
    <header>

    <!-- <a href="#"><img src="Mahat_Logo.png" class="Logo"></a> -->

    <h1>Mahat Librerias</h1>
    <p>Detalles de pedido</p>

    
    </header>

    <main>
        <table class="table_carrito">
            <thead>
                <tr>
                    <th>Imagen</th> <!-- Nueva columna para la imagen -->
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productosCarrito as $productoCarrito) : ?>
                    <tr>
                        <td>
                            <?php
                                $path = '../'.$productoCarrito['Imagen'];
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            ?>
                            <img src="<?php echo $base64?>" alt="<?php echo $productoCarrito['Titulo']; ?>">
                        </td>
                        <td>
                            <h3><?php echo $productoCarrito['Titulo']; ?></h3>
                            <h4><?php echo $productoCarrito['Autor']; ?></h4>
                            <h4><?php echo $productoCarrito['Editorial']; ?></h4>
                        </td>
                        <td><?php echo '$' . $productoCarrito['Precio']; ?></td>
                        <td><?php echo $productoCarrito['cantidad']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>a</p>
    </footer>
</body>
</html>

<?php

    function getCarritoProducts(){
        include 'conexion.php';

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

?>

<?php 

    require "../vendor/autoload.php";

    use Dompdf\Dompdf;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    $CorreoSesion = $_SESSION['correo'];


    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->render();
    $content = $dompdf->output();
    $filename = "Detalles_Pedido.pdf";
    file_put_contents($filename, $content);
    $dompdf->stream($filename);

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'Mahat.librerias@gmail.com';                     //SMTP username
        $mail->Password   = 'zfje bctt mufs thjg';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('mahat.librerias@gmail.com', 'Mahat Librerias');
        $mail->addAddress($CorreoSesion, 'Manuel Calam');     //Add a recipient;
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Esto es el asunto';
        $mail->Body    = 'Este es un mensaje de prueba';

        //Attachments
        $mail->addAttachment($filename, 'Detalles_Pedido.pdf');   //Optional name
    
        
        $mail->send();
        echo 'Message has been sent';
        unlink($filename);

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

   

?>