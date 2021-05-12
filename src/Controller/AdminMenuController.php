<?php

namespace App\Controller;

use App\Model\MenuManager;
use App\Model\PlatManager;
use App\Model\BoissonManager;
use App\Service\ValidationForm;

class AdminMenuController extends AbstractController
{
    private const CONSTRAINT = [
        'name' => [
            'max_length' => 255,
            'phrasing_start' => 'Le nom'
        ],
        'plat_id' => [
            'filter_var' => FILTER_VALIDATE_INT,
            'phrasing_start' => 'Le plat'
        ],
        'boisson_id' => [
            'filter_var' => FILTER_VALIDATE_INT,
            'phrasing_start' => 'La boisson'
        ],
        'price' => [
            'filter_var' => FILTER_VALIDATE_INT,
            'phrasing_start' => 'Le prix'
        ],
    ];

    public function show()
    {
        $errors = [];
        $formMenu = [];
        $menuManager = new MenuManager();
        $boissonManager = new BoissonManager();
        $platManager = new PlatManager();
        $platLists = $platManager->selectAll('name');
        $boissonLists = $boissonManager->selectAll('name');
        $menus = $menuManager->selectAllContent();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formMenu = array_map('trim', $_POST);
            $errors = (new ValidationForm(self::CONSTRAINT, $formMenu))->validate();
            if (empty($errors)) {
                $menuManager->insert($formMenu);
                header('Location:/adminMenu/show');
            }
        }
        return $this->twig->render('Admin/add.html.twig', [
            'menu' => $formMenu,
            'errors' => $errors,
            'platLists' => $platLists,
            'boissonLists' => $boissonLists,
            'items' => $menus,
            'url_controller' => '/adminMenu',
            'button_name' => 'Enregister'
        ]);
    }

    public function edit(int $id): string
    {
        $errors = [];
        $menuManager = new MenuManager();
        $boissonManager = new BoissonManager();
        $platManager = new PlatManager();
        $formMenu = $menuManager->selectOneById($id);
        $platLists = $platManager->selectAll('name');
        $boissonLists = $boissonManager->selectAll('name');
        $menus = $menuManager->selectAllContent();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formMenu = array_map('trim', $_POST);
            $errors = (new ValidationForm(self::CONSTRAINT, $formMenu))->validate();
            if (empty($errors)) {
                $formMenu['id'] = $id;
                $menuManager->update($formMenu);
                header('Location:/adminMenu/show');
            }
        }
        return $this->twig->render('Admin/add.html.twig', [
            'menu' => $formMenu,
            'errors' => $errors,
            'platLists' => $platLists,
            'boissonLists' => $boissonLists,
            'items' => $menus,
            'url_controller' => '/adminMenu',
            'button_name' => 'Editer'
        ]);
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menuManager = new MenuManager();
            $menuManager->delete($id);
            header('Location:/adminMenu/show');
        }
    }
}
