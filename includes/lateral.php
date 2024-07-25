<?php require_once "GestorBD.php";?>
<?php include_once "includes/helpers.php"; ?>

<aside id="sidebar">

    <div id="buscador" class="block-aside">
        <h3>Buscar</h3>
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda">
            <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "search") : '';?>

            <input type="submit" value="Buscar">
        </form>
    </div>

    <?php if(isset($_SESSION['user'])):?>
        <div id="user" class="block-aside">
            <h3>Bienvenido, <?=$_SESSION['user']['nombre'].' '.$_SESSION['user']['apellidos']?></h3>
            <a class="boton boton-verde" href="crear-entradas.php">Crear entrada</a>
            <a class="boton" href="crear-categoria.php">Crear categoría</a>
            <a class="boton boton-naranja" href="misDatos.php">Mis datos</a>
            <a class="boton boton-rojo" href="cerrar.php">Cerrar sesión</a>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['user'])):?>
        <div id="login" class="block-aside">
            <h3>Identifícate</h3>
            <form action="login.php" method="POST">
                <label for="email-login">Email</label>
                <input type="email" name="email-login">
                <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "email-login") : '';?>

                <label for="password-login">Password</label>
                <input type="password" name="password-login">
                <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "password-login") : '';?>

                <input type="submit" value="Entrar">
            </form>
        </div>

        <div id="register" class="block-aside">
            <h3>Regístrate</h3>

            <?php if(isset($_SESSION['complete'])):?>
                <div class="alert">
                    <?=$_SESSION['complete']['register']?>
                </div>
            <?php elseif(isset($_SESSION['warnings']['general'])):?>
                <div class="alert alert-error">
                    <?=$_SESSION['warnings']['general']?>
                </div>
            <?php endif;?>

            <form action="register.php" method="POST">

                <label for="name">Nombre</label>
                <input type="text" name="name">
                <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "name") : '';?>

                <label for="lastname">Apellido</label>
                <input type="text" name="lastname">
                <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "lastname") : '';?>

                <label for="email">Email</label>
                <input type="email" name="email">
                <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "email") : '';?>

                <label for="password">Password</label>
                <input type="password" name="password">
                <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "password") : '';?>

                <input type="submit" name="submit" value="Registrar">

            </form>
        </div>
    <?php endif; ?>
</aside>