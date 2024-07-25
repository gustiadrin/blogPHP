<?php require_once "GestorBD.php";?>
<?php include_once "includes/helpers.php"; ?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Blog de Música</title>
      
    </head>
    <body>
        <!--CABECERA-->

        <header id="header">
    
            <!-- LOGO -->
            <div id="logo">
                <a href="index.php">
                    Blog de Música
                </a>
            </div>
            
            <!-- MENU -->
            <nav id="nav">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>

                    <?php 
                        $categorias = getCategories($db);
                        if(!empty($categorias)):
                            while ($categoria = mysqli_fetch_assoc($categorias)): 
                    ?>
                        <li>
                            <a href="categorie.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                        </li>
                    <?php   
                            endwhile;
                        endif; 
                    ?>
                    
                    <li>
                        <a href="index.php">Sobre Mí</a>
                    </li>
                    
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>
                </ul>
                
            </nav>

            
            
        </header>
        
        <div id="pincipal-container">