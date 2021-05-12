<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\BoissonManager;
use App\Model\PlatManager;
use App\Model\RestaurantManager;

class RestaurantController extends AbstractController
{
    public function index($id)
    {
        $restaurantManager = new RestaurantManager();
        $boissonManager = new BoissonManager();
        $platManager = new PlatManager();
        $platLists = $platManager->selectAll();
        $boissonLists = $boissonManager->selectAll();
        $restaurants = $restaurantManager->selectByIdCategory($id);
        $restaurantName = $restaurantManager->selectNameById($id);

        return $this->twig->render('Restaurant/index.html.twig', [
            'restaurants' => $restaurants,
            'restaurantName' => $restaurantName,
            'platLists' => $platLists,
            'boissonLists' => $boissonLists,
        ]);
    }
}
