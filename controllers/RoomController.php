<?php
require_once __DIR__ . '/../models/RoomModel.php';

class RoomController {
    private $model;

    public function __construct($db) {
        $this->model = new RoomModel($db);
    }

    public function index() {
        $rooms = $this->model->getAllRooms();
        require_once  __DIR__ . '/../views/rooms/index.php';
    }

    public function available() {
        $rooms = $this->model->getAvailableRooms();
        require_once  __DIR__ . '/../views/rooms/available.php';
    }

    public function show($id) {
        $room = $this->model->getRoomById($id);
        if ($room) {
            require_once  __DIR__ . '/../views/rooms/show.php';
        } else {
            header('Location: index.php?action=rooms');
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'room_number' => $_POST['room_number'],
                'type' => $_POST['type'],
                'price_per_night' => $_POST['price_per_night'],
                'capacity' => $_POST['capacity'],
                'status' => $_POST['status'],
                'description' => $_POST['description']
            ];

            if ($this->model->createRoom($data)) {
                header('Location: index.php?action=rooms');
            } else {
                echo "Ошибка при создании номера";
            }
        } else {
            require_once  __DIR__ . '/../views/rooms/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'room_number' => $_POST['room_number'],
                'type' => $_POST['type'],
                'price_per_night' => $_POST['price_per_night'],
                'capacity' => $_POST['capacity'],
                'status' => $_POST['status'],
                'description' => $_POST['description']
            ];

            if ($this->model->updateRoom($id, $data)) {
                header('Location: index.php?action=rooms');
            } else {
                echo "Ошибка при обновлении номера";
            }
        } else {
            $room = $this->model->getRoomById($id);
            if ($room) {
                require_once  __DIR__ . '/../views/rooms/edit.php';
            } else {
                header('Location: index.php?action=rooms');
            }
        }
    }

    public function delete($id) {
        if ($this->model->deleteRoom($id)) {
            header('Location: index.php?action=rooms');
        } else {
            echo "Ошибка при удалении номера";
        }
    }
}
?>
