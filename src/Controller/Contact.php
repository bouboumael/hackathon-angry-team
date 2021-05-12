<?php

namespace App\Controller;

use App\Controller\AbstractController;

class ContactController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Contact/index.html.twig');
    }
}
