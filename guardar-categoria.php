<?php
    if(isset($_POST)){
        require_once 'includes/GestorBD.php';

        $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;

        $warnings = array();
    
        if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)){
            $name_validate = true;
        }else{
            $name_validate = false;
            $warnings['name-category'] = "El nombre de la categoría no es válido. No se admiten números, caracteres especiales ni nombres vacíos"; 
        }

        if(count($warnings)==0){
            $sql = "INSERT INTO categorias VALUES (null, '$name')";
        
            try {
                // Intentar ejecutar la consulta
                $save = mysqli_query($db, $sql);
                if ($save) {
                    $_SESSION['complete']['category'] = 'Se ha creado la categoría con éxito';
                    header ('Location: verTodasEntradas.php');
                }
            } catch (mysqli_sql_exception) {
                // Capturar la excepción en caso de error
                $_SESSION['warnings']['save-category'] = 'Fallo al crear la categoría';
            }
        
        }else{
          $_SESSION['warnings'] = $warnings;  
          header ('Location: crear-categoria.php'); 
        }
    }

?>