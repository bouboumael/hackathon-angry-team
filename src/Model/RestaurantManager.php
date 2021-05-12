<?php

namespace App\Model;

use App\Model\AbstractManager;

class RestaurantManager extends AbstractManager
{
    public const TABLE = "restaurant";
    public function insert(array $data): void
    {
        $query = "INSERT INTO " . self::TABLE . " (`name`, `localisation`, `image`, `description`)
       VALUES (:name, :localisation, :image, :description)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $data['name'], \PDO::PARAM_STR);
        $statement->bindValue('localisation', $data['localisation'], \PDO::PARAM_STR);
        $statement->bindValue('image', $data['image'], \PDO::PARAM_STR);
        $statement->bindValue('description', $data['description'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectByIdCategory(int $id)
    {
        $statement = $this->pdo->prepare('SELECT restaurant.name AS restaurant_name,
        restaurant.description AS restaurant_description,
        restaurant.image AS restaurant_image,
        menu.name AS menu_name,
        menu.boisson_id AS boisson_id,
        menu.plat_id AS plat_id,
        boisson.name as boisson_name,
        plat.name AS plat_name
        FROM liste 
        JOIN restaurant 
        ON restaurant.id = liste.restaurant_id 
        JOIN menu 
        ON menu.id = liste.menu_id 
        JOIN boisson
        ON boisson.id = menu.boisson_id
        JOIN plat
        ON plat.id = menu.plat_id
        WHERE restaurant.id = :id;');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectNameById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT name FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectRestaurantByPlanets()
    {
        return $this->pdo->query('SELECT restaurant.*, planete.name AS planete_name
        FROM localisation
        JOIN restaurant
        ON restaurant.id = localisation.restaurant_id
        JOIN planete
        ON planete.id = localisation.planete_id ORDER BY planete.name;')->fetchAll();
    }

    public function selectWithDrink()
    {
        $statement = $this->pdo->query('SELECT boisson.name
        from liste
        JOIN menu
        ON menu.id = liste.menu_id
        JOIN boisson
        ON boisson.id = menu.boisson_id;');

        $statement->execute();

        return $statement->fetch();
    }
}
