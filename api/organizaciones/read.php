<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/organizaciones.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Organizacion($db);

    $organizaciones = $items->getOrganizaciones();
    $itemCount = mysqli_num_rows($organizaciones);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaorganizaciones = array();
        $listaorganizaciones["body"] = array();
        $listaorganizaciones["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($organizaciones)){
            extract($fila);
            
            $organizacion = array(
                "id" => $id,
                //"usuario" => $usuario,
                "nombre" => $nombre,
                //"descripcion" => $descripcion,
                "imagen" => $imagen,
               // "telefono" => $telefono,
                //"direccion" => $direccion,
                "provincia" => $provincia,
            );

            array_push($listaorganizaciones["body"], $organizacion);
        }
        echo json_encode($listaorganizaciones);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>