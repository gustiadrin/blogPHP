<?php 

function showWarnings($warnings, $field){
    $alert = '';
    if(isset($warnings[$field]) && !empty($field)){
        $alert = "<div class='alert alert-error'>".$warnings[$field].'</div>';
    }
    return $alert;
}

function complete($complete, $field){
    $alert = '';
    if(isset($complete[$field]) && !empty($field)){
        $alert = "<div class='alert'>".$complete[$field].'</div>';
    }
    return $alert;
}

function deleteWarnings(){
    
    if(isset($_SESSION['warnings'])){
        $_SESSION['warnings'] = null;
        //unset($_SESSION['warnings']);
    }
        
    if(isset($_SESSION['complete'])){
        $_SESSION['complete'] = null;
        //unset($_SESSION['complete']);
    }
    
    return true;
}

function getCategories($db){
    $sql = "SELECT * FROM categorias ORDER BY id";
    $categorias = mysqli_query($db, $sql);

    $result = array(); 

    if($categorias && mysqli_num_rows($categorias)>=1){
        $result = $categorias;
    }

    return $result;
}

function getCategorie($db, $id){
    $sql = "SELECT * FROM categorias where id= $id";
    $categorias = mysqli_query($db, $sql);
    $resultado = mysqli_fetch_assoc($categorias);
    return $resultado;
}

function getEntries($db, $limit = null, $categoria = null, $busqueda = null){
    
    if($limit){
        $sql = "SELECT e.*, c.nombre AS categoria FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id ORDER BY e.id DESC LIMIT 4";
    }elseif(!empty($categoria)){
        $sql = "SELECT e.*, c.nombre AS categoria FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id WHERE e.categoria_id=$categoria ORDER BY e.id DESC";
    }elseif(!empty($busqueda)){
        $sql = "SELECT e.*, c.nombre AS categoria FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id WHERE e.titulo LIKE '%$busqueda%'";
    }else{
        $sql = "SELECT e.*, c.nombre AS categoria FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id ORDER BY e.id DESC";
    }

    $entradas = mysqli_query($db, $sql);

    $result = array(); 

    if($entradas && mysqli_num_rows($entradas)>=1){
        $result = $entradas;
    }

    return $result;
}

function getEntrada($db, $idEntrada){
    // $sql = "SELECT * FROM entradas WHERE id=$idEntrada";
    $sql = "SELECT e.*, c.nombre AS categoria, CONCAT(u.nombre, ' ', u.apellidos) AS usuario FROM entradas e".
    " INNER JOIN categorias c ON e.categoria_id = c.id".
    " INNER JOIN usuarios u ON e.usuario_id = u.id WHERE e.id=$idEntrada";
    // var_dump($sql);
    // die();
    $consulta = mysqli_query($db, $sql);
    $resultado = mysqli_fetch_assoc($consulta);
    return $resultado;
}



?>