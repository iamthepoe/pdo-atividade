<?php
include('../factories/heroes-controller-factory.php');

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    $json = file_get_contents('php://input');

    if (!$json) {
        echo json_encode(array("error" => "Erro ao receber o JSON."));
        exit;
    }

    $data = json_decode($json, true);

    if ($data === null) {
        echo json_encode(array("error" => "Erro ao decodificar o JSON."));
        exit;
    }

    $id = $_GET['id'] ?? null;

    if ($id !== null) {
        $name = $data['name'] ?? null;
        $skill = $data['skill'] ?? null;
        $power_level = $data['power_level'] ?? null;

        if ($name !== null || $skill !== null || $power_level !== null) {
            $result = $controller->updateHero($id, $name, $skill, $power_level);
            echo json_encode(array("data" => $result));
        } else {
            echo json_encode(array("error" => "Nenhum campo para atualizar foi fornecido."));
        }
    } else {
        echo json_encode(array("error" => "ID não fornecido."));
    }
} else {
    echo json_encode(array("error" => "Método não permitido para esta rota."));
}