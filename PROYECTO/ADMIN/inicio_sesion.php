<?php
session_start();
if (isset($_SESSION['nombreUser'])) {
    $nombre = $_SESSION['nombreUser'];
} else {
    $nombre = '';
}
?>