<?php
namespace MyApp\Controllers;

use MyApp\Repositories\HeroesRepository;
use MyApp\Models\Hero;

include('../models/Hero.php');

class HeroesController
{
    private HeroesRepository $repository;

    function __construct(HeroesRepository $repository)
    {
        $this->repository = $repository;
    }


    private function setHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
    }

    function createHero(string $name, string $skill, int $power_level)
    {
        if (!$name || !$skill || !$power_level) {
            return json_encode(array("error" => "Todos os dados devem estar preenchidos."));
        }

        $hero = new Hero($name, $skill, $power_level);
        $result = $this->repository->create($hero);

        $this->setHeaders();

        return json_encode(array("created" => $result));
    }

    function getAllHeroes()
    {
        $heroes = $this->repository->findAll();

        $this->setHeaders();

        return json_encode(array("data" => $heroes));
    }

    function getHeroById(int $id)
    {
        $hero = $this->repository->findOne($id);

        $this->setHeaders();

        return json_encode(array("data" => $hero));
    }

    function updateHero(int $id, string $name, string $skill, int $power_level)
    {
        $hero = new Hero($name, $skill, $power_level);
        $result = $this->repository->update($id, $hero);

        $this->setHeaders();

        return json_encode(array("updated" => $result));
    }

    function deleteHero(int $id)
    {
        $result = $this->repository->delete($id);

        $this->setHeaders();

        return json_encode(array("deleted" => $result));
    }
}