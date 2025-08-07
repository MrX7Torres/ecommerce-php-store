<?php
session_start();
if (isset($_SESSION['clienteID'])) {
    $idCliente = $_SESSION['clienteID'];
} else { 
    $idCliente = '';
}
?>