<?php
session_start();
unset($_SESSION['NomeUsuario']);
unset($_SESSION['User']); 
unset($_SESSION['CodUsuario'] );
header("Location:index.php");

?>