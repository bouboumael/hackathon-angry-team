<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\BoissonManager;
use App\Service\ValidationForm;

class AdminDrinkController extends AbstractController
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
    ];

    public function show(): string
    {
        $errors = [];
        $formDrink = [];
        $boissonManager = new BoissonManager();
        $drinks = $boissonManager->selectAll('id', 'DESC');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formDrink = array_map('trim', $_POST);
            $errors = (new ValidationForm(self::CONSTRAINT, $formDrink))->validate();
            if (empty($errors)) {
                $boissonManager->insert($formDrink);
                header('Location:/adminDrink/show');
            }
        }
        return $this->twig->render('Admin/drink.html.twig', [
            'formDrink' => $formDrink,
            'errors' => $errors,
            'items' => $drinks,
            'url_controller' => '/adminDrink',
            'button_name' => 'Enregister'
        ]);
    }

    public function edit(int $id): string
    {
        $errors = [];
        $formDrink = [];
        $boissonManager = new BoissonManager();
        $formDrink = $boissonManager->selectOneById($id);
        $drinks = $boissonManager->selectAll('id', 'DESC');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formDrink = array_map('trim', $_POST);
            $errors = (new ValidationForm(self::CONSTRAINT, $formDrink))->validate();
            if (empty($errors)) {
                $formDrink['id'] = $id;
                $boissonManager->update($formDrink);
                header('Location:/adminDrink/show');
            }
        }
        return $this->twig->render('Admin/drink.html.twig', [
            'formDrink' => $formDrink,
            'errors' => $errors,
            'items' => $drinks,
            'url_controller' => '/adminDrink',
            'button_name' => 'Editer'
        ]);
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $boissonManager = new BoissonManager();
            $boissonManager->delete($id);
            header('Location:/adminDrink/show');
        }
    }
}
