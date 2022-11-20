<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/eventos.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new evento($db);

    $eventos = $items->getEventos();
    $itemCount = mysqli_num_rows($eventos);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaEventos = array();
        $listaEventos["body"] = array();
        $listaEventos["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($eventos)){
            extract($fila);
            
            $evento = array(
                "id" => $id,
                "organizacion" => $nombre,
                "titulo" => $titulo,
                //"descripcion" => $descripcion,
                "imagen" => $imagen,
               // "telefono" => $telefono,
                //"direccion" => $direccion,
                "provincia" => $provincia,
                "fecharealizacion" => $fecharealizacion,
                "interes" => $interes,
            );

            array_push($listaEventos["body"], $evento);
        }
        echo json_encode($listaEventos);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>