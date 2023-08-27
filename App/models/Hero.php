<?php
namespace MyApp\Models;

class Hero
{
    public string $name;
    public string $skill;
    public int $power_level;

    public function __construct(string $name, string $skill, int $power_level)
    {
        $this->name = $name;
        $this->skill = $skill;
        $this->power_level = $power_level;
    }
}