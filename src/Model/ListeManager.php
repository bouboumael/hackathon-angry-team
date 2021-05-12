<?php

namespace App\Model;

class ListeManager extends AbstractManager
{
    public const TABLE = 'liste';

    public function insert(array $liste)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (restaurant_id, menu_id) 
        VALUES (:restaurant_id, :menu_id)");

        $statement->bindValue('restaurant_id', $liste['restaurant_id'], \PDO::PARAM_INT);
        $statement->bindValue('menu_id', $liste['menu_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
