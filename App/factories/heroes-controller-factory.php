<?php

namespace MyApp\Factories;

use MyApp\Controllers\HeroesController;
use MyApp\Repositories\HeroesRepository;

include('../database/client.php');
include('../repositories/heroes-repository.php');
include('../controller/heroes-controller.php');

$repository = new HeroesRepository($pdo);
$controller = new HeroesController($repository);
?>
