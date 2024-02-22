<?php

    include "conexion.php";

    $nombre = $_POST['Nombres'];
    $apellido = $_POST['Apellidos'];
    $correo = $_POST['Correo'];
    $edad = $_POST['Edad'];
    $direccion = $_POST['Direccion'];
    $celular = $_POST['Celular'];
    $usuario = $_POST['Usuario'];
    $clave = $_POST['Clave'];


    $sql = mysqli_query($con, "INSERT INTO usuarios (id, Nombre, Apellido, Correo, Edad, Direccion, Telefono, 
    Usuario, Clave) VALUES (0, '$nombre', '$apellido', '$correo', '$edad', '$direccion', '$celular', '$usuario', '$clave')");

    /* $sql2 = " 
    create trigger bitacora_insertUsuarios 
	after insert on usuarios
	for each row
	begin
		insert into bitacora_usuarios (id, Fecha, Sentencia, Contrasentencia)
		values (
			new.id,
			now(),
			CONCAT(
				'INSERT INTO usuarios (id, Nombre, Apellido, Correo, Edad, Direccion, Telefono, Usuario, Clave) VALUES (',
				'',new.id,'","',new.Nombre,'","',new.Apellido,'","',new.Correo,'","',new.Edad,'","',new.Direccion,'","',new.Telefono,'","',new.Usuario,'","',new.Clave,'")'
			),
			CONCAT('DELETE FROM usuarios WHERE id = ', new.id)
		);
	end;";  */
        
    

    if($sql){
        echo "Usuario agregado";
        header("location: ../Login.html");
    }
    else{
        echo "Error" .$sql ."<br>" .mysqli_error($con);
    }

    mysqli_close($con);
?>