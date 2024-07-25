<?php
if (isset($_POST)){
    require_once "includes/GestorBD.php";
 
    // Se quitan los simbolos al entrar datos en la base de datos y se toma todo como un string. Se puede usar como método de seguridad,
    // ya que el texto ingresado no se entenderá como parte del lenguaje, si no como una cadena
    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $lastname = isset($_POST['lastname']) ? mysqli_real_escape_string($db, $_POST['lastname']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

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

    if(!empty($password)){
        $password_validate = true;
    }else{
        $password_validate = false;
        $warnings['password'] = "La contraseña está vacía"; 
    }
}

if(count($warnings)==0){
    $password_secure = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
    $sql = "INSERT INTO usuarios VALUES (null, '$name', '$lastname', '$email', '$password_secure', CURDATE())";

    try {
        // Intentar ejecutar la consulta
        $save = mysqli_query($db, $sql);
        if ($save) {
            $_SESSION['complete']['register'] = 'El registro se ha realizado con éxito';
        }
    } catch (mysqli_sql_exception) {
        // Capturar la excepción en caso de error
        $_SESSION['warnings']['register'] = 'Fallo al guardar el usuario';
    }

}else{
  $_SESSION['warnings'] = $warnings;
   
}
header ('Location: index.php');  

?>