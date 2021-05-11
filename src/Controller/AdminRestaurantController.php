<?php

namespace App\Controller;

class AdminRestaurantController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('/Admin/addRestaurant.html.twig');
    }
}
