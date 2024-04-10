<?php

namespace App\usuarios;
require "../vendor/autoload.php";

use App\Controller\UsuarioController;

$prod = new UsuarioController();

$body = json_decode(file_get_contents('php://input'), true);
$id=isset($_GET['id'])?$_GET['id']:'';
switch($_SERVER["REQUEST_METHOD"]){
    case "POST";
        $resultado = $prod->insert($body);
        echo json_encode(['status'=>$resultado]);
    break;
    case "GET";
        if(!isset($_GET['id'])){
            $resultado = $prod->select();
            echo json_encode(["users"=>$resultado]);
        }else{
            $resultado = $prod->selectId($id);
            echo json_encode(["status"=>true,"users"=>$resultado[0]]);
        }
       
    break;
    case "PUT";
        $resultado = $prod->update($body,intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;
    case "DELETE";
        $resultado = $prod->delete(intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;  
}