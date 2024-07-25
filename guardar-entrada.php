<?php
    if(isset($_POST)){
        require_once 'includes/GestorBD.php';

        $title = isset($_POST['title']) ? mysqli_real_escape_string($db, $_POST['title']) : false;
        $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : false;
        $category = isset($_POST['category']) ? (int) $_POST['category'] : false;
        $user = $_SESSION['user']['id'];

        $warnings = array();
    
        if(isset($_POST['entrada_id'])){
            $id = $_POST['entrada_id'];    
        }else{
            $id = "";
        }

        if(!empty($title) && !is_numeric($title) && !preg_match("/[0-9]/", $title)){
            $title_validate = true;
        }else{
            $title_validate = false;
            $warnings['title-entry'] = "El título de la entrada no es válido"; 
        }

        if(!empty($description)){
            $description_validate = true;
        }else{
            $description_validate = false;
            $warnings['description-entry'] = "No se puede crear una entrada vacía"; 
        }

        if(!empty($category) && is_numeric($category)){
            $category_validate = true;
        }else{
            $category_validate = false;
            $warnings['category-entry'] = "La categoría no es válida"; 
        }

        
        if(count($warnings)==0 && empty($id)){
            $sql = "INSERT INTO entradas VALUES (null, '$user', '$category', '$title', '$description', CURDATE())";
        
            try {
                // Intentar ejecutar la consulta
                $save = mysqli_query($db, $sql);
                if ($save) {
                    $_SESSION['complete']['entry'] = 'Se ha creado la entrada con éxito';
                    header ('Location: verTodasEntradas.php');    
                }
            } catch (mysqli_sql_exception) {
                // Capturar la excepción en caso de error
                $_SESSION['warnings']['save-entry'] = 'Fallo al guardar la entrada';
                header ('Location: crear-entradas.php');
            }

        }elseif(count($warnings)==0 && !empty($id)){
            $sql = "UPDATE entradas SET categoria_id = '$category', titulo = '$title', descripcion = '$description', fecha = CURDATE() WHERE id=$id";
        
            try {
                // Intentar ejecutar la consulta
                $save = mysqli_query($db, $sql);
                if ($save) {
                    $_SESSION['complete']['modify-entry'] = 'Se ha modificado la entrada con éxito';  
                    header ('Location: entrada.php?id='.$id);  
                }
            } catch (mysqli_sql_exception) {
                // Capturar la excepción en caso de error
                $_SESSION['warnings']['fail-modify-entry'] = 'Fallo al modificar la entrada';
                header ('Location: editarEntrada.php?id='.$id); 
            }
         
        }elseif(count($warnings)!=0 && empty($id)){
            $_SESSION['warnings'] = $warnings;
            header ('Location: crear-entradas.php');
        }else{
            $_SESSION['warnings'] = $warnings; 
            header ('Location: editarEntrada.php?id='.$id); 
        }
    }
?>