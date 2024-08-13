<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset(); 
    session_destroy(); 
    setcookie(session_name(), '', time() - 3600, '/'); 

    // Enviar una respuesta simple para indicar éxito
    echo 'success';
    exit();
} 
?>
