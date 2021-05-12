<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\RestaurantManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $restaurants = (new RestaurantManager())->selectRestaurantByPlanets();
        $restaurantsOrder = [];
        foreach ($restaurants as $restaurant) {
            $restaurantsOrder[$restaurant['planete_name']][] = $restaurant;
        }

        return $this->twig->render('Home/index.html.twig', [
            'restaurants' => $restaurantsOrder,
        ]);
    }
}
