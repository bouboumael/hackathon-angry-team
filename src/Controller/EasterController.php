<?php

namespace App\Controller;

use App\Controller\AbstractController;

class EasterController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Easter/index.html.twig', []);
    }
}
