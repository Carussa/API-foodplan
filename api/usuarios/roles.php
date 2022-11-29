<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/usuarios.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Usuario($db);

    $roles = $items->getRoles();
    $itemCount = mysqli_num_rows($roles);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaRoles = array();
        $listaRoles["body"] = array();
        $listaRoles["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($roles)){
            extract($fila);
            
            $rol = array(
                "id" => $id,
                "rol" => $rol,
            );

            array_push($listaRoles["body"], $rol);
        }
        echo json_encode($listaRoles);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>