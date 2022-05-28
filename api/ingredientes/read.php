<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/ingredientes.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Ingrediente($db);

    $ingredientes = $items->getIngredientes();
    $itemCount = mysqli_num_rows($ingredientes);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaIngredientes = array();
        $listaIngredientes["body"] = array();
        $listaIngredientes["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($ingredientes)){
            extract($fila);
            
            $receta = array(
                "id" => $idingrediente,
                "nombre" => $nombre,
                "imagen" => $imagen,
            );

            array_push($listaIngredientes["body"], $receta);
        }
        echo json_encode($listaIngredientes);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>