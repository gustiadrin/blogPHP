<?php require_once "includes/redireccion.php";?>

<!-- CABECERA -->
<?php require_once "includes/header.php";?>

<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

<div id="principal">

    <h1>Mis datos</h1>

    <?php echo isset($_SESSION["complete"]) ? complete($_SESSION["complete"], "actualizar") : '';?>
    <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "actualizar") : '';?>
  
    <form action="actualizarUsuario.php" method="POST">
        
        <label for="name">Nombre</label>
        <input type="text" name="name" value="<?=$_SESSION['user']['nombre']?>">
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "name") : '';?>

        <label for="lastname">Apellido</label>
        <input type="text" name="lastname" value="<?=$_SESSION['user']['apellidos']?>">
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "lastname") : '';?>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$_SESSION['user']['email']?>">
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "email") : '';?>

        <input type="submit" name="submit" value="Actualizar">

        <!-- Este sirve para borrar los errores tanto de login como de registro -->
        <?php deleteWarnings();?>
    </form>

</div>

<?php require_once "includes/footer.php";?>