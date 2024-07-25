<?php require_once "includes/redireccion.php";?>

<!-- CABECERA -->
<?php require_once "includes/header.php";?>
<?php echo isset($_SESSION["complete"]) ? complete($_SESSION["complete"], "entry") : '';?>

<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>

<?php include_once "includes/helpers.php"; ?>

<div id="principal">
    <h1>Crear entrada</h1>
    <p>Añade nuevas entradas al blog!!</p>
    <br>
    <form action="guardar-entrada.php" method="POST">
        <label for="title">Título:</label>
        <input type="text" name="title">
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "title-entry") : '';?>

        <label for="description">Descripción:</label>
        <textarea name="description"></textarea>
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "description-entry") : '';?>

        <label for="category">Categoría:</label>
        <select name="category">
            <?php 
                $categorias = getCategories($db);
                if(!empty($categorias)):
                    while ($categoria = mysqli_fetch_assoc($categorias)): 
            ?>
        
            <option value="<?=$categoria['id']?>">
                <?=$categoria['nombre']?>
            </option>
           <?php   
                endwhile;
                endif; 
            ?>
        </select>
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "category-entry") : '';?>

        <input type="submit" value="Crear">
    </form>
</div>
<?php deleteWarnings();?>

<!-- FOOTER -->
<?php require_once "includes/footer.php";?>