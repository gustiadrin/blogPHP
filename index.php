<!-- CABECERA -->
<?php require_once "includes/header.php";?>


<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">   
    <h1>Últimas entradas</h1>

    <?php 
        $entradas= getEntries($db, true);
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
    

    <div id="ver-todas">
        <a href="verTodasEntradas.php">Ver todas las entradas</a>
    </div>

</div>

<!-- Este sirve para borrar los errores del array warnings que está en la sesión -->
<?php deleteWarnings();?> 


<!-- <div class="clearfix"></div> -->
        
<!-- FOOTER -->
<?php require_once "includes/footer.php";?>

