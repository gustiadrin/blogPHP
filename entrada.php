<!-- CABECERA -->
<?php require_once "includes/header.php";?>


<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

    <?php 
        $entrada= getEntrada($db, $_GET['id']); 
        if(!empty($entrada)):    
    ?>

        <!-- CONTENIDO PRINCIPAL -->
        <div id="principal">
        <?php echo isset($_SESSION["complete"]) ? complete($_SESSION["complete"], "modify-entry") : '';?>
        <h1><?=$entrada['titulo']?></h1>
        <a href="categorie.php?id=<?=$entrada['categoria_id']?>">
            <h2><?=$entrada['categoria']?></h2>
        </a>
        <h4><?=$entrada['fecha']?> | <?=$entrada['usuario']?></h4>
        
        <article class="entry">
                <p><?=$entrada['descripcion']?></p>
            </a>
        </article>
        
    <?php 

        endif;
    ?>


    <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $entrada['usuario_id']):?>
        <br>
        <a class="boton" href="editarEntrada.php?id=<?=$_GET['id']?>">Editar entrada</a>
        <a class="boton boton-naranja" href="borrarEntrada.php?id=<?=$_GET['id']?>">Borrar entrada</a>
    <?php endif; ?>

</div>
<?php deleteWarnings();?>

<!-- <div class="clearfix"></div> -->
        
<!-- FOOTER -->
<?php require_once "includes/footer.php";?>
