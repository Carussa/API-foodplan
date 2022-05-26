<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/recetas.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Receta($db);

    $recetas = $items->getRecetas();
    $itemCount = mysqli_num_rows($recetas);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaRecetas = array();
        $listaRecetas["body"] = array();
        $listaRecetas["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($recetas)){
            extract($fila);
            
            $receta = array(
                "id" => $idreceta,
                "titulo" => $titulo,
                "imagen" => $imagen,
            );

            array_push($listaRecetas["body"], $receta);
        }
        echo json_encode($listaRecetas);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>