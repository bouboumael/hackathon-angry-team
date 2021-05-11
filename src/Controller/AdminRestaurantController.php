<?php

namespace App\Controller;

use App\Manager\AdminRestaurantManager as ManagerAdminRestaurantManager;
use App\Model\AdminRestaurantManager;

class AdminRestaurantController extends AbstractController
{
    private const MAX_LENGHT = 255;
    public const MAX_UPLOAD_FILESIZE = 2000000;
    public const ALLOWED_MIMES = ['image/jpeg', 'image/png'];

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

        return $errors;
    }

    private function validateFile(array $file): array
    {
        $errors = [];

        if ($file['error'] != 0) {
            $errors[] = 'Problème lors de l\'upload';
        } else {
            if ($file['size'] > self::MAX_UPLOAD_FILESIZE) {
                $errors[] = 'Le fichier doit faire moins de ' . self::MAX_UPLOAD_FILESIZE / 1000000 . 'Mo';
            }

            if (!in_array(mime_content_type($file['tmp_name']), self::ALLOWED_MIMES)) {
                $errors[] = 'Le fichier doit être de type ' . implode(', ', self::ALLOWED_MIMES);
            }
        }

        return $errors;
    }

    public function add(): string
    {
        $errors = [];
        $data = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = array_map('trim', $_POST);

            $dataErrors = $this->validate($data);
            $fileErrors = $this->validateFile($_FILES['image']);
            $errors = array_merge($dataErrors, $fileErrors);

            if (empty($errors)) {
                $restaurantManager = new AdminRestaurantManager();

                $fileName = uniqid() . '_' . $_FILES['image']['name'];
                $data['image'] = $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/uploads/' .  $fileName);

                $restaurantManager->insert($data);
                header('Location:/AdminRestaurant/index');
            }
        }
        return $this->twig->render('/Admin/addRestaurant.html.twig', ['errors' => $errors, 'data' =>  $data]);
    }
}
