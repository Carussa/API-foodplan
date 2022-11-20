<?php
   // header("Access-Control-Allow-Origin: *");
   // header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/interesesusuario.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new InteresUsuario($db);

    $intereses = $items->getIdInteresesUsuario(2);
    $itemCount = mysqli_num_rows($intereses);


   // echo json_encode($itemCount);

    if($itemCount > 0){

        $si = array('esto', 'es', 'un array');
            print_r ($si);
        
        $listaIntereses = array();

        while ($fila = mysqli_fetch_assoc($intereses)){
            extract($fila);
            
            echo $idinteres;
            $listaIntereses[] += $idinteres;
            //array_push($listaIntereses, $idinteres);
        }
        print_r($listaIntereses ) ;
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>