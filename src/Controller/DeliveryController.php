<?php

namespace App\Controller;

use App\Controller\AbstractController;

class DeliveryController extends AbstractController
{
    public function index()
    {
        $products = $_SESSION['cart'] ?? [];
        return $this->twig->render("Delivery/index.html.twig", [
            'products' => $products,
        ]);
    }
}
