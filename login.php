<?php

if(isset($_POST)){
    //Iniciar la sesión y la conexión con la BD
    require_once "includes/GestorBD.php";
    if(!isset($_SESSION)){
        session_start();
    }

    //Recoger datos del formulario
    $email = isset($_POST['email-login']) ? trim($_POST['email-login']) : false;
    $password = isset($_POST['password-login']) ? $_POST['password-login'] : false;

    $warnings = array();

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validate = true;

        if(!empty($password)){
            $password_validate = true;
            $sql = "SELECT * FROM usuarios WHERE email = '$email'";
            $login = mysqli_query($db, $sql);
            
            if($login && mysqli_num_rows($login)==1){
                $user = mysqli_fetch_assoc($login);
                $emailDB = $user['email'];
                $passwordDB = $user['password']; 

                if(password_verify($password, $passwordDB)){
                   $_SESSION['user'] = $user; 
                }else{
                   $warnings['password-login'] = "Contraseña incorrecta";
                }

            }else{
                $warnings['email-login'] = "El email no existe";
            }

        }else{
            $password_validate = false;
            $warnings['password-login'] = "La contraseña está vacía"; 
        }

    }else{
        $email_validate = false;
        $warnings['email-login'] = "El email no es válido"; 
    }
}

if(count($warnings)==0){

}else{
  $_SESSION['warnings'] = $warnings;   
}

header ('Location: index.php');
?>