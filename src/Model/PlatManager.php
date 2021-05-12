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


    public function update(array $plat): void
    {
        $query = "UPDATE " . self::TABLE .
            " SET name=:name, price=:price, image=:image, recipe=:recipe WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $plat['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $plat['price'], \PDO::PARAM_INT);
        $statement->bindValue('image', $plat['image'], \PDO::PARAM_STR);
        $statement->bindValue('recipe', $plat['recipe'], \PDO::PARAM_STR);
        $statement->bindValue('id', $plat['id'], \PDO::PARAM_INT);
        $statement->execute();
    }
}
