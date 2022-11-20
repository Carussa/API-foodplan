<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/interesesusuario.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new InteresUsuario($db);

    $intereses = $items->getInteresesUsuario();
    $itemCount = mysqli_num_rows($intereses);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaIntereses = array();
        $listaIntereses["body"] = array();
        $listaIntereses["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($intereses)){
            extract($fila);
            
            $receta = array(
                "id" => $idinteres,
                "interes" => $interes,
                "usuario" => $nombre,
            );

            array_push($listaIntereses["body"], $receta);
        }
        echo json_encode($listaIntereses);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>