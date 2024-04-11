<?php
@session_start();
$_SESSION = array();
@session_destroy();
if (!headers_sent()) {
    header("Location: index.php");
    exit();
}
?>
