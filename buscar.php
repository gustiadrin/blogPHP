<?php require_once "includes/redireccion.php";?>

<!-- CABECERA -->
<?php require_once "includes/header.php";?>


<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">

<?php 
    if(!isset($_POST['busqueda']) || empty($_POST['busqueda'])){
        $_SESSION['warnings']['search'] = 'Ingrese un texto a buscar';
        header("Location: index.php");
    }

    $entradas= getEntries($db, null, null, $_POST['busqueda']);
?>

<h1>Resultados de la busqueda: <?=$_POST['busqueda']?></h1>

<?php         
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

<!-- <div class="clearfix"></div> -->
        
<!-- FOOTER -->
<?php require_once "includes/footer.php";?>