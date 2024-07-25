<?php

require_once ("includes/GestorBD.php");

if(isset($_SESSION['user']) && isset($_GET['id'])){
    $idEntrada = $_GET['id'];
    $sql = "DELETE FROM entradas WHERE id=$idEntrada";
    mysqli_query($db, $sql);
    $_SESSION['complete']['delete-entry'] = 'Se ha borrado la entrada con éxito';
}

header("Location: verTodasEntradas.php");

?>