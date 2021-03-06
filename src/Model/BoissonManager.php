<?php

namespace App\Model;

class BoissonManager extends AbstractManager
{
    public const TABLE = 'boisson';


    public function insert(array $drink)
    {
        $query = 'INSERT INTO ' . self::TABLE . '
        (name, price, image)
        VALUES (:name, :price, :image)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $drink['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $drink['price'], \PDO::PARAM_INT);
        $statement->bindValue('image', $drink['image'], \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function update(array $drink): void
    {
        $query = "UPDATE " . self::TABLE .
            " SET name=:name, price=:price, image=:image WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $drink['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $drink['price'], \PDO::PARAM_INT);
        $statement->bindValue('image', $drink['image'], \PDO::PARAM_STR);
        $statement->bindValue('id', $drink['id'], \PDO::PARAM_INT);
        $statement->execute();
    }
}
