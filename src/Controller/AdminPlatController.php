<?php

namespace App\Controller;

use App\Model\PlatManager;
use App\Service\ValidationForm;

class AdminPlatController extends AbstractController
{
    private const CONSTRAINT = [
        'name' => [
            'max_length' => 255,
            'phrasing_start' => 'Le nom'
        ],
        'price' => [
            'filter_var' => FILTER_VALIDATE_INT,
            'phrasing_start' => 'Le prix'
        ],
        'image' => [
            'filter_var' => FILTER_VALIDATE_URL,
            'phrasing_start' => 'L\'image'
        ],
        'recipe' => [
            'phrasing_start' => 'La recette'
        ]
    ];

    public function show()
    {
        $errors = [];
        $plat = [];
        $productsManager = new PlatManager();
        $plats = $productsManager->selectAll('id', 'DESC');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $plat = array_map('trim', $_POST);
            $errors = (new ValidationForm(self::CONSTRAINT, $plat))->validate();
            if (empty($errors)) {
                $productsManager->insert($plat);
                header('Location:/adminMenu/show');
            }
        }

        return $this->twig->render('Admin/addPlat.html.twig', [
            'errors' => $errors,
            'plat' => $plat,
            'items' => $plats,
            'url_controller' => '/adminPlat',
            'button_name' => 'Enregister'
        ]);
    }


    public function edit(int $id): string
    {
        $errors = [];
        $productsManager = new PlatManager();
        $plat = $productsManager->selectOneById($id);
        $plats = $productsManager->selectAll('id', 'DESC');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $plat = array_map('trim', $_POST);
            $errors = (new ValidationForm(self::CONSTRAINT, $plat))->validate();
            if (empty($errors)) {
                $plat['id'] = $id;
                $productsManager->update($plat);
                header('Location:/adminPlat/show');
            }
        }
        return $this->twig->render('Admin/addPlat.html.twig', [
            'errors' => $errors,
            'plat' => $plat,
            'items' => $plats,
            'url_controller' => '/adminPlat',
            'button_name' => 'Editer'
        ]);
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $boissonManager = new PlatManager();
            $boissonManager->delete($id);
            header('Location:/adminPlat/show');
        }
    }
}
