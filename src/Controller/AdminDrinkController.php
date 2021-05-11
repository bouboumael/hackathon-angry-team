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
            $validationForm = new ValidationForm(self::CONSTRAINT, $formDrink);
            $errors = $validationForm->validate();
            if (empty($errors)) {
                $accessoryManager = new BoissonManager();
                $accessoryManager->insert($formDrink);
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
}
