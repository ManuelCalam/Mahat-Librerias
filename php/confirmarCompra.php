<?php
    session_start();
    $productosCarrito = getCarritoProducts();

 ?>

<?php

function getCarritoProducts(){
    try {
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
    } catch (Exception $e) {
        // Registra el error en el archivo de registro de PHP
        error_log("Error en getCarritoProducts(): " . $e->getMessage());
        // También puedes imprimir el mensaje de error si lo deseas
        echo "Error en getCarritoProducts(): " . $e->getMessage();
        // Retorna un valor por defecto o maneja el error según sea necesario
        return array();
    }
}

?>


<?php
    require "../vendor/autoload.php";
    use Fpdf\Fpdf;
    use Sabre\DAV\Client;

    $webdav_url = 'http://10.0.0.4/';
    $webdav_user = 'calam';
    $webdav_pass = '1234';

    $settings = [
        'baseUri' => $webdav_url,
        'userName' => $webdav_user,
        'password' => $webdav_pass,
    ];

    $client = new Client($settings);


    // Creamos una instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Establecemos la fuente y el tamaño para el título
    $pdf->SetFont('Arial', 'B', 16);

    // Agregamos el título
    $pdf->Cell(0, 10, 'Mahat Librerias - Detalles de pedido', 0, 1, 'C');

    // Agregamos un espacio
    $pdf->Ln(10);

    // Configuramos la fuente y el tamaño para el texto del cuerpo
    $pdf->SetFont('Arial', '', 12);

    // Agregamos la tabla de productos
    $pdf->SetFillColor(230, 230, 230); // Establecemos el color de fondo para las celdas de encabezado
    $pdf->SetTextColor(0, 0, 0); // Establecemos el color del texto a negro

    // Definir las dimensiones de la celda para la imagen y los datos
    // Definir las dimensiones deseadas de la celda de imagen
    $anchoCeldaImagen = 30; // Ancho de la celda de imagen
    $altoCeldaImagen = 40; // Alto de la celda de imagen

    // Recorrer cada producto en el carrito
    foreach ($productosCarrito as $productoCarrito) {
        // Guardar la posición actual del cursor
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->SetLineWidth(0);

        // Insertar la imagen en una celda de tamaño específico
        $pdf->Cell($anchoCeldaImagen, $altoCeldaImagen, '', 0); // Celda vacía para la imagen
        $pdf->Image('../' . $productoCarrito['Imagen'], $x, $y, $anchoCeldaImagen, $altoCeldaImagen);

        // Mover el cursor a la derecha de la imagen
        $pdf->SetXY($x + $anchoCeldaImagen, $y);

        // Insertar los datos del producto en las celdas restantes
        $pdf->MultiCell(90, $altoCeldaImagen / 3, $productoCarrito['Titulo'] . "\n" . $productoCarrito['Autor'] . "\n" . $productoCarrito['Editorial'], 1);

        // Guardar la nueva posición del cursor
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        // Establecer la posición para los siguientes Cell
        $pdf->SetXY($x + 125, $y - $altoCeldaImagen);

        $pdf->Cell(30, $altoCeldaImagen, '$' . $productoCarrito['Precio'], 1, 0, 'R');
        $pdf->Cell(30, $altoCeldaImagen, $productoCarrito['cantidad'], 1, 1, 'C');

        $pdf->Ln(10);

    }


    // Salto de línea al final de la tabla
    $pdf->Ln();

    // Finalmente, generamos el PDF y lo mostramos o lo guardamos en un archivo
    $filename = "Detalles_Pedido.pdf";

    $pdf->Output('F', $filename);
?>


<?php 

        
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $CorreoSesion = $_SESSION['correo'];


    // $filename = "Detalles_Pedido.pdf";

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Nivel de depuración DEBUG_SERVER
        $mail->Debugoutput = function($str, $level) { echo "debug level $level; message: $str"; }; // Salida de depuración personalizada

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
    
        //header("location: ../index.php");
        //echo '<script>window.location.href="../index.php";</script>';

        

        $mail->send();

        try {
            $pdf_data = file_get_contents($filename);
            $remote_path = $filename; // Puedes cambiar esto a una ruta específica en tu servidor WebDAV
        
            $client->request('PUT', $remote_path, $pdf_data);
            echo "Archivo PDF subido correctamente a WebDAV.";
        } catch (Exception $e) {
            // Registra el error en el archivo de registro
            error_log("Error al subir el archivo PDF a WebDAV: " . $e->getMessage(), 3, "/ruta/a/tu/archivo_de_log_php.log");
            echo "Error al subir el archivo PDF a WebDAV: " . $e->getMessage();
        }


        echo 'Message has been sent';
        //unlink($filename);


    } catch (Exception $e) {
        echo "Error: " . $e;
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

   

?>