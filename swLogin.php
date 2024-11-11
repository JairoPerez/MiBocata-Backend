<?php
require_once 'inc/Singleton.php';
require_once 'models/User.php';

$usuario = new User();

$json = [
    "success" => true,
    "msg" => "Usuario encontrado en la base de datos"
];

header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);

$filters = $input["filter"] ?? null;
$email = $filters[0]["email"] ?? null;
$passwd = $filters[1]["passwd"] ?? null;

if ($usuario->comprobarCredenciales($email, $passwd)) {
    if (json_encode($json) !== false) {
        echo json_encode($json);
    } else {
        echo json_encode([
            "success" => false,
            "msg" => "Error al construir el json"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "msg" => "Usuario no encontrado en la base de datos"
    ]);
}
