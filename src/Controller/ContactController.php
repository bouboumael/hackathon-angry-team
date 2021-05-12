<?php

namespace App\Controller;

use App\Controller\AbstractController;

class ContactController extends AbstractController
{
    private const NAME_MAX_LENGTH = 80;
    private const MESSAGE_MAX_LENGTH = 2000;

    public function validate($data)
    {
        $errors = [];

        if (empty($data['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        } elseif ($data['lastname'] > self::NAME_MAX_LENGTH) {
            $errors = 'Le nom doit faire moins de' . self::NAME_MAX_LENGTH . ' caractères';
        }

        if (empty($data['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        } elseif ($data['firstname'] > self::NAME_MAX_LENGTH) {
            $errors = 'Le prénom doit faire moins de' . self::NAME_MAX_LENGTH . ' caractères';
        }

        if (empty($data['telephone'])) {
            $errors[] = 'Un numéro de téléphone est obligatoire';
        }

        if (empty($data['message'])) {
            $errors[] = 'Un message est obligatoire';
        } elseif ($data['message'] > self::MESSAGE_MAX_LENGTH) {
            $errors = 'Le message doit faire moins de ' . self::MESSAGE_MAX_LENGTH . ' caractères';
        }
        return $errors;
    }

    private function send()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                //send in mail
                header('location: /Contact/index');
            }
        }
        return $errors;
    }

    public function index()
    {
        $errors = $this->send();
        return $this->twig->render('Contact/index.html.twig', [
            "errors" => $errors
        ]);
    }
}
