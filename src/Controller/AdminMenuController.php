<?php

namespace App\Controller;

use App\Model\BoissonManager;
use App\Model\MenuManager;
use App\Model\PlatManager;

class AdminMenuController extends AbstractController
{
    private const MAX_LENGTH = 255;

    private function isEmpty($menu): array
    {
        $errors = [];
        if (empty($menu['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }
        if (empty($menu['plat_id'])) {
            $errors[] = 'La plat est obligatoire';
        }
        if (empty($menu['boisson_id'])) {
            $errors[] = 'La boisson est obligatoire';
        }
        return $errors;
    }

    private function validate($menu)
    {
        $errors = $this->isEmpty($menu);

        if (strlen($menu['name']) > self::MAX_LENGTH) {
            $errors[] = 'Le nom doit contenir moins de ' . self::MAX_LENGTH . 'caractères';
        }
        if (!filter_var($menu['plat_id'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)) {
            $errors[] = 'Le plat doit etre dans la liste';
        }
        if (!filter_var($menu['boisson_id'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)) {
            $errors[] = 'La boisson doit etre dans la liste';
        }
        return $errors;
    }
    public function add()
    {
        $platManager = new PlatManager();
        $platLists = $platManager->selectAll();
        $boissonManager = new BoissonManager();
        $boissonLists = $boissonManager->selectAll();
        $errors = [];
        $menu = array_map('trim', $_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $menu = array_map('trim', $_POST);
            // Verification

            $errors = $this->validate($menu);

            // no errors, send to db
            if (empty($errors)) {
                $productsManager = new MenuManager();
                $productsManager->insert($menu);
                header('Location:/adminMenu/add');
            }
        }

        return $this->twig->render('Admin/add.html.twig', [
            'errors' => $errors,
            'menu' => $menu,
            'platLists' => $platLists,
            'boissonLists' => $boissonLists,
        ]);
    }
}
