<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/eventos.php';
    include_once '../../class/interesesusuario.php';

    $database = new Database();
    $db = $database->getConnection();

    $interesusuario = new InteresUsuario($db);

    $user = isset($_GET['us']) ? $_GET['us'] : die();

    $intereses = $interesusuario->getIdInteresesUsuario($user);
    $itemCount = mysqli_num_rows($intereses);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaIntereses = array();

        while ($fila = mysqli_fetch_assoc($intereses)){
            extract($fila);

            $listaIntereses[] += $idinteres;
            //array_push($listaIntereses, $idinteres);
        }
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

    $items = new evento($db);
  
    $eventos = $items->getEventosIntereses($listaIntereses, $user);
    $itemCount = mysqli_num_rows($eventos);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaEventos = array();
        $listaEventos["body"] = array();
        $listaEventos["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($eventos)){
            extract($fila);
            
            if(isset($favorito)) {
                $favorito = true;
            }else {
                $favorito = false;
            }

            $evento = array(
                "id" => $id,
                "organizacion" => $organizacion,
                "titulo" => $titulo,
                "provincia" => $provincia,
                "fecharealizacion" => $fecharealizacion,
                "interes" => $interes,
                "favorito" => $favorito
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