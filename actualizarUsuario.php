<?php
if (isset($_POST)){
    require_once "includes/GestorBD.php";
 
    // Se quitan los simbolos al entrar datos en la base de datos y se toma todo como un string. Se puede usar como método de seguridad,
    // ya que el texto ingresado no se entenderá como parte del lenguaje, si no como una cadena
    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $lastname = isset($_POST['lastname']) ? mysqli_real_escape_string($db, $_POST['lastname']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    $warnings = array();
    
    if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)){
        $name_validate = true;
    }else{
        $name_validate = false;
        $warnings['name'] = "El nombre no es válido"; 
    }

    if(!empty($lastname) && !is_numeric($lastname) && !preg_match("/[0-9]/", $lastname)){
        $lastname_validate = true;
    }else{
        $lastname_validate = false;
        $warnings['lastname'] = "El apellido no es válido"; 
    }

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validate = true;
    }else{
        $email_validate = false;
        $warnings['email'] = "El email no es válido"; 
    }
}

if(count($warnings)==0){
    $user_id = $_SESSION['user']['id'];

    //comprobar que el email no exista antes de actualizar
    $sqlComprueba = "SELECT id, email FROM usuarios WHERE email = '$email'";
    $comprobacion = mysqli_query($db, $sqlComprueba);
    $existeEmail = mysqli_fetch_assoc($comprobacion);
    
    if($existeEmail['id'] == $user_id || empty($existeEmail)){

        $sqlActualiza = "UPDATE usuarios SET nombre = '$name', apellidos = '$lastname', email = '$email' WHERE id = '$user_id'";

        try {
            // Intentar ejecutar la consulta
            $save = mysqli_query($db, $sqlActualiza);
            if ($save) {
                $_SESSION['user']['nombre'] = $name;
                $_SESSION['user']['apellidos'] = $lastname;
                $_SESSION['user']['email'] = $email;
    
                $_SESSION['complete']['actualizar'] = 'Tus datos se han actualizado con éxito';
            }

        } catch (mysqli_sql_exception) {
            // Capturar la excepción en caso de error
            $_SESSION['warnings']['actualizar'] = 'Fallo al actualizar tus datos';
        }
        
    }else{
        $_SESSION['warnings']['actualizar'] = 'El usuario ya existe';    
    }

}else{
  $_SESSION['warnings'] = $warnings;   
  
}

header ('Location: misDatos.php');
?>