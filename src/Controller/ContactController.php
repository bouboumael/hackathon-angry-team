<?php

namespace App\Controller;

use App\Controller\AbstractController;

class ContactController extends AbstractController
{
    private const MAX_LENGHT = 255;

    public function index()
    {
        return $this->twig->render('Contact/index.html.twig');
    }

    public function validate($data)
    {
        $errors = [];
        $data = array_map('trim', $_POST);

        if (empty($data['name'])) {
            $errors[] = 'Le nom du restaurant est obligatoire';
        } elseif (strlen($data['name']) > self::MAX_LENGHT) {
            $errors[] = 'Le nom doit faire moin de ' . self::MAX_LENGHT . ' caractères.';
        }

        if (empty($data['localisation'])) {
            $errors[] = 'La location est obligatoire';
        } elseif (strlen($data['localisation']) > self::MAX_LENGHT) {
            $errors[] = 'la location doit faire moin de ' . self::MAX_LENGHT . ' caractères.';
        }

        if (empty($data['description'])) {
            $errors[] = 'La description est obligatoire';
        }

        return $errors;
    }
}
