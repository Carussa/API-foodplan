<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/favoritos.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = isset($_GET['us']) ? $_GET['us'] : die();

    $items = new favorito($db);
  
    $favoritos = $items->getFavoritosUsuario($user);
    $itemCount = mysqli_num_rows($favoritos);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaFavoritos = array();
        $listaFavoritos["body"] = array();
        $listaFavoritos["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($favoritos)){
            extract($fila);
            
            $favorito = array(
                "id" => $idevento,
                "organizacion" => $organizacion,
                "titulo" => $titulo,
                //"descripcion" => $descripcion,
                "imagen" => $imagen,
               // "telefono" => $telefono,
                //"direccion" => $direccion,
                
            );

            array_push($listaFavoritos["body"], $favorito);
        }
        echo json_encode($listaFavoritos);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>