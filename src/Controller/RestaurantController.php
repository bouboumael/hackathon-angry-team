<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\RestaurantManager;
use App\Service\NasaApi;

class RestaurantController extends AbstractController
{
    public function index($id)
    {
        $restaurantManager = new RestaurantManager();
        $boissonLists = $restaurantManager->selectWithDrink();
        $restaurants = $restaurantManager->selectByIdCategory($id);
        $restaurantName = $restaurantManager->selectNameById($id);
        
        $image = (new NasaApi())->randImage();
        return $this->twig->render('Restaurant/index.html.twig', [
            'restaurants' => $restaurants,
            'restaurantName' => $restaurantName,
            'boissonLists' => $boissonLists,
            'image' => $image,
        ]);
    }
}
