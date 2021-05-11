<?php

namespace App\Model;

class PlatManager extends AbstractManager
{
    public const TABLE = 'plat';

    public function insert(array $menu)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (name, recipe, price, image) 
        VALUES (:name, :recipe, :price, :image)");

        $statement->bindValue('name', $menu['name'], \PDO::PARAM_STR);
        $statement->bindValue('recipe', $menu['recipe'], \PDO::PARAM_STR);
        $statement->bindValue('price', $menu['price'], \PDO::PARAM_INT);
        $statement->bindValue('image', $menu['image'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
