<?php

namespace App\Model;

class MenuManager extends AbstractManager
{
    public const TABLE = 'menu';

    public function insert(array $menu)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (name, plat_id, boisson_id) 
        VALUES (:name, :plat_id, :boisson_id)");

        $statement->bindValue('name', $menu['name'], \PDO::PARAM_STR);
        $statement->bindValue('plat_id', $menu['plat_id'], \PDO::PARAM_INT);
        $statement->bindValue('boisson_id', $menu['boisson_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function selectAllContent()
    {
        $query = 'SELECT m.*, b.name AS boisson_name, p.name AS plat_name FROM ' . self::TABLE . ' m JOIN '
        . BoissonManager::TABLE . ' b ON b.id = m.boisson_id JOIN '
        . PlatManager::TABLE . ' p on p.id = m.plat_id';

        return $this->pdo->query($query)->fetchAll();
    }
}
