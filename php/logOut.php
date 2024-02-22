<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}
session_destroy();

// if (session_status() === PHP_SESSION_NONE) {
//     echo "La sesión está cerrada.";
// } else {
//     echo "La sesión está abierta.";
// }

header("location: ../index.php");
exit();

?>
