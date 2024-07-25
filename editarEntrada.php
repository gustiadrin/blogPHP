<?php require_once "includes/redireccion.php";?>

<?php require_once "includes/header.php";?>

<!-- BARRA LATERAL -->            
<?php require_once "includes/lateral.php";?>


<?php 
    
    $entrada= getEntrada($db, $_GET['id']);    
    if(!empty($entrada)):           
?>

    <div id="principal">
        <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "fail-modify-entry") : '';?>
        <h1>Editar la entrada: <?=$entrada['titulo']?></h1>
        <br>

        <form action="guardar-entrada.php" method="POST">
            <label for="title">Título:</label>
            <input type="text" name="title" value = "<?=$entrada['titulo']?>">
            <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "title-entry") : '';?>

            <label for="description">Descripción:</label>
            <textarea name="description"><?=$entrada['descripcion']?></textarea>
            <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "description-entry") : '';?>

            <label for="category">Categoría:</label>
            <select name="category">
                <?php 
                    $categorias = getCategories($db);
                    if(!empty($categorias)):
                        while ($categoria = mysqli_fetch_assoc($categorias)): 
                ?>
                
                <option value="<?=$categoria['id']?>"<?= ($categoria['id'] == $entrada['categoria_id']) ? 'selected="selected"' : '' ?>>
                    <?=$categoria['nombre']?>
                </option>
            <?php   
                endwhile;
                endif; 
            ?>
            </select>
            <br>
            <?php echo isset($_SESSION["warnings"]) ? showWarnings($_SESSION["warnings"], "category-entry") : '';?>

            <input type="hidden" name="entrada_id" value="<?=$entrada['id']?>">

            <input type="submit" value="Guardar cambios">
        </form>
    </div>

<?php endif;?>

<?php deleteWarnings();?>


<!-- FOOTER -->
<?php require_once "includes/footer.php";?>