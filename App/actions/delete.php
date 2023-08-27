<?php
include('../factories/heroes-controller-factory.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null;

    if ($id !== null) {
        $result = $controller->deleteHero($id);
        echo json_encode(array("data" => $result));
    } else {
        echo json_encode(array("error" => "ID não fornecido."));
    }
} else {
    echo json_encode(array("error" => "Método não permitido para esta rota."));
}