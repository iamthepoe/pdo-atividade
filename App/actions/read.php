<?php
include('../factories/heroes-controller-factory.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;

    if ($id !== null) {
        $hero = $controller->getHeroById($id);
        echo json_encode(array("data" => $hero));
    } else {
        $heroes = $controller->getAllHeroes();
        echo json_encode(array("data" => $heroes));
    }
} else {
    echo json_encode(array("error" => "Método não permitido para esta rota."));
}