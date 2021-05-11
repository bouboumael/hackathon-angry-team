<?php

namespace App\Model;

use App\Model\AbstractManager;

class AdminRestaurantManager extends AbstractManager
{
    public const TABLE = "restaurant";
    public function insert(array $data): void
    {
        $query = "INSERT INTO " . self::TABLE . " (`name`, `localisation`, `image`)
       VALUES (:name, :localisation, :image)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $data['name'], \PDO::PARAM_STR);
        $statement->bindValue('localisation', $data['localisation'], \PDO::PARAM_STR);
        $statement->bindValue('image', $data['image'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
