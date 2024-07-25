<?php require_once "includes/redireccion.php";?>

<!-- CABECERA -->
<?php require_once "includes/header.php";?>

<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

<div id="principal">
    <h1>Crear categoría</h1>
    <p>Añade nuevas categorías para enriquecer la página juntos!!</p>
    <br>
    <form action="guardar-categoria.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name">
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "name-category") : '';?>
        <input type="submit" value="Crear">
    </form>
</div>


<!-- FOOTER -->
<?php require_once "includes/footer.php";?>

