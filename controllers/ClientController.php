<?php
require_once __DIR__ . '/../models/ClientModel.php';

class ClientController {
    private $model;

    public function __construct($db) {
        $this->model = new ClientModel($db);
    }

    public function index() {
        $clients = $this->model->getAllClients();
        require_once __DIR__ . '/../views/clients/index.php';
    }

    public function show($id) {
        $client = $this->model->getClientById($id);
        if ($client) {
            require_once __DIR__ . '/../views/clients/show.php';
        } else {
            header('Location: index.php?action=clients');
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'passport_number' => $_POST['passport_number']
            ];

            if ($this->model->createClient($data)) {
                header('Location: index.php?action=clients');
            } else {
                echo "Ошибка при создании клиента";
            }
        } else {
            require_once __DIR__ . '/../views/clients/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'passport_number' => $_POST['passport_number']
            ];

            if ($this->model->updateClient($id, $data)) {
                header('Location: index.php?action=clients');
            } else {
                echo "Ошибка при обновлении клиента";
            }
        } else {
            $client = $this->model->getClientById($id);
            if ($client) {
                require_once __DIR__ . '/../views/clients/edit.php';
            } else {
                header('Location: index.php?action=clients');
            }
        }
    }

    public function delete($id) {
        if ($this->model->deleteClient($id)) {
            header('Location: index.php?action=clients');
        } else {
            echo "Ошибка при удалении клиента";
        }
    }
}
?>
