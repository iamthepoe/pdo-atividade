<?php
include('../factories/heroes-controller-factory.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $name = $data['name'] ?? null;
    $skill = $data['skill'] ?? null;
    $power_level = $data['power_level'] ?? null;

    if ($name != null && $skill != null && $power_level != null) {
        $result = $controller->createHero($name, $skill, $power_level);

        echo json_encode(array("data" => $result));
    } else {
        echo json_encode(array("error" => "Erro ao decodificar o JSON."));
    }


} else {
    echo json_encode(array("error" => "Método não permitido para esta rota."));
}
?>
