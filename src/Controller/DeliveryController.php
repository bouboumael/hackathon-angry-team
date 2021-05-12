<?php

namespace App\Controller;

use App\Controller\AbstractController;

class DeliveryController extends AbstractController
{
    public function index()
    {
        return $this->twig->render("Delivery/index.html.twig");
    }
}
