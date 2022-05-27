<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/recetas.php';
    include_once '../../class/ingredientesreceta.php';

    $database = new Database();
    $db = $database->getConnection();

    $receta = new Receta($db);

    $data = json_decode(file_get_contents("php://input"));

    $receta->titulo = $data->titulo;
    $receta->descripción = $data->descripcion;
    $receta->imagen = $data->imagen;
    //$receta->ingredientes = $data->ingredientes;
    
    if(!empty($receta->titulo)){
        if($receta->createReceta()){
            echo 'Receta '. $receta->id . ' created successfully.' ;
        } else{
            echo 'Receta could not be created.';
        }
    }

    $receta->ingredientes = json_decode('[{"id":"2","cantidad":null},{"id":"3","cantidad":"1"},{"id":"4","cantidad":"1"},{"id":"6","cantidad":"4"}]',true);
    
    $ingredientes = new IngredienteReceta($db);
    if($ingredientes->addIngredientesReceta($receta)){
        echo 'Ingredientes added successfully.' ;
    } else{
        echo 'Ingredientes could not be added.';
    }
    
?>