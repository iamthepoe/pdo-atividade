<?php
namespace MyApp\Repositories;

use PDO;
use MyApp\Models\Hero;

class HeroesRepository
{

    private PDO $db_client;
    function __construct(PDO $db_client)
    {
        $this->db_client = $db_client;
    }

    function create(Hero $hero)
    {
        $sql = "INSERT INTO heroes (name, skill, power_level) VALUES(:name, :skill, :power_level)";
        $stmt = $this->db_client->prepare($sql);
        $stmt->bindParam(':name', $hero->name);
        $stmt->bindParam(':skill', $hero->skill);
        $stmt->bindParam(':power_level', $hero->power_level);

        return $stmt->execute();
    }

    function findAll()
    {
        $stmt = $this->db_client->prepare("SELECT * FROM heroes");
        $stmt->execute();
        $heroes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $heroes;
    }

    function findOne(int $id)
    {
        $sql = "SELECT * FROM heroes WHERE id = :id";
        $stmt = $this->db_client->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $hero = $stmt->fetch(PDO::FETCH_ASSOC);
        return $hero;
    }


    function update(int $id, Hero $hero)
    {
        $sql = "UPDATE heroes SET name = :name, skill = :skill, power_level = :power_level WHERE id = :id";
        $stmt = $this->db_client->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $hero->name);
        $stmt->bindParam(':skill', $hero->skill);
        $stmt->bindParam(':power_level', $hero->power_level);

        return $stmt->execute();
    }

    function delete(int $id)
    {
        $sql = "DELETE FROM heroes WHERE id = :id";
        $stmt = $this->db_client->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}