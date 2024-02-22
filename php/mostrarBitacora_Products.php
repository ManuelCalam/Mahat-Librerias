<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Consultar la base de datos
$sql = "SELECT * FROM bitacora_productos";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../index.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .mainSection {
            max-width: 100%;
            padding: 3% 4%;
            margin: 0% auto;
            overflow-x: auto;
        }

        table {
            /* width: 100%; */
            max-width: 10%; 
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td[colspan="3"] {
            text-align: center;
            font-style: italic;
            color: #777;
        }
    </style>

</head>
<body>
    <header>
        <nav>
            <ul>
                <input type="checkbox" id="click">
                <label for="click" class="btn">
                    <i class="fa-solid fa-bars"></i>
                </label>
                <a href="#"><img src="../Mahat_Logo.png" class="Logo"></a>
    
                <li><a href="../php/logOut.php">Salir</a></li>    
                <li><a href="../admin/adminMenu.html">Administrar</a></li>                    
                <li><a href="../Productos.php">Productos</a></li>
                <li><a href="../index.php">Inicio</a></li> 
            </ul>
        </nav>
    </header>


    <section class="mainSection"> 

        <h2>Bitácora de Usuarios</h2>

        <table border="1">
            <tr>
                <th>id</th>
                <th>Fecha</th>
                <th>Sentencia</th>
                <th>Contrasentencia</th>

            <?php
            // Imprimir los datos en filas de la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["Fecha"] . "</td>";
                    echo "<td>" . $row["Sentencia"] . "</td>";
                    echo "<td>" . $row["Contrasentencia"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
            }
            ?>

        </table>

    </section>

    <footer>
            <div class="footerDiv">Jose Manuel Calam Manzanilla</div>
            <div class="footerDiv">4to P</div>
            <div class="footerDiv">Desarrollo Web | Bases de Datos</div>      
    </footer>

</body>
</html>