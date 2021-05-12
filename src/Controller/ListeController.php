<?php

namespace App\Controller;

use App\Model\ListeManager;
use App\Model\MenuManager;
use App\Model\RestaurantManager;

class ListeController extends AbstractController
{
    public function add(): string
    {
        $restaurantManager = new RestaurantManager();
        $restaurants = $restaurantManager->selectAll();
        $menuManager = new MenuManager();
        $menus = $menuManager->selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $liste = array_map('trim', $_POST);
            // TODO validations (length, format...)
            // if validation is ok, insert and redirection
            $listeManager = new ListeManager();
            $listeManager->insert($liste);
            header('Location:/liste/add');
        }

        return $this->twig->render('Admin/adminListe.html.twig', [
            'restaurants' => $restaurants,
            'menus' => $menus,
        ]);
    }
}
