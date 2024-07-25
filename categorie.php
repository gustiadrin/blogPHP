<?php require_once "includes/redireccion.php";?>

<!-- CABECERA -->
<?php require_once "includes/header.php";?>


<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">

<?php 
    $categorie = getCategorie($db, $_GET['id']);
    if(!isset($categorie['id'])){
        header("Location: index.php");
    }
?>
    
    <h1><?=$categorie['nombre']?></h1>

    <?php 
        $entradas= getEntries($db, null, $_GET['id']);
        
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
        else:
    ?>
    
    <div class="alert alert-error"> No existen entradas para esta categoría</div>

    <?php endif;?>



</div>

<!-- <div class="clearfix"></div> -->
        
<!-- FOOTER -->
<?php require_once "includes/footer.php";?>