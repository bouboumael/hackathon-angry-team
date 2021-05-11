<?php

namespace App\Controller;

use App\Model\PlatManager;

class AdminPlatController extends AbstractController
{
    private const MAX_LENGTH = 255;

    private function isEmpty($plat): array
    {
        $errors = [];
        if (empty($plat['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }
        if (empty($plat['recipe'])) {
            $errors[] = 'La recette est obligatoire';
        }
        if (empty($plat['price'])) {
            $errors[] = 'Le prix est obligatoire';
        }
        if (empty($plat['image'])) {
            $errors[] = 'L\'image est obligatoire';
        }
        return $errors;
    }

    private function validate($plat)
    {
        $errors = $this->isEmpty($plat);

        if (strlen($plat['name']) > self::MAX_LENGTH) {
            $errors[] = 'Le nom doit contenir moins de ' . self::MAX_LENGTH . 'caractères';
        }
        return $errors;
    }

    public function add()
    {
        $errors = [];
        $plat = array_map('trim', $_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $plat = array_map('trim', $_POST);
            // Verification

            $errors = $this->validate($plat);

            // no errors, send to db
            if (empty($errors)) {
                $productsManager = new PlatManager();
                $productsManager->insert($plat);
                header('Location:/adminMenu/add');
            }
        }

        return $this->twig->render('Admin/addPlat.html.twig', [
            'errors' => $errors,
            'plat' => $plat,
        ]);
    }
}
