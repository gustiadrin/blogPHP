<?php require_once "includes/redireccion.php";?>

<!-- CABECERA -->
<?php require_once "includes/header.php";?>


<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1>Todas las entradas</h1>
    <!-- Estos son los mensajes de confirmación que mostrará el blog -->
    <?php echo isset($_SESSION["complete"]) ? complete($_SESSION["complete"], "category") : '';?>
    <?php echo isset($_SESSION["complete"]) ? complete($_SESSION["complete"], "delete-entry") : '';?>
    <?php echo isset($_SESSION["complete"]) ? complete($_SESSION["complete"], "entry") : '';?>

    <?php 
        $entradas= getEntries($db);
        
        if(!empty($entradas)):
            while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>
        
        <article class="entry">
        
            <a href="entrada.php?id=<?=$entrada['id']?>">
            
                <h2><?=$entrada['titulo']?></h2>
                <span class="date"><?=$entrada['categoria']." | ".$entrada['fecha']?></span>
                <p><?=substr($entrada['descripcion'], 0, 200)?>...</p>
            </a>
        </article>
        
    <?php 
            endwhile; 
        endif;
    ?>

</div>

<?php deleteWarnings();?>

<!-- <div class="clearfix"></div> -->
        
<!-- FOOTER -->
<?php require_once "includes/footer.php";?>