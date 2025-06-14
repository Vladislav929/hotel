<?php
require_once 'config/database.php';
require_once 'controllers/ClientController.php';
require_once 'controllers/EmployeeController.php';
require_once 'controllers/RoomController.php';
require_once 'controllers/BookingController.php';

// Перенаправление на home.php если нет параметров
if (empty($_GET)) {
    header("Location: home.php");
    exit();
}

// Установка соединения с базой данных
$database = new Database();
$db = $database->getConnection();

// Определение действия
$action = $_GET['action'] ?? '';
$method = $_GET['method'] ?? 'index';
$id = $_GET['id'] ?? null;

// Создание контроллеров
$clientController = new ClientController($db);
$employeeController = new EmployeeController($db);
$roomController = new RoomController($db);
$bookingController = new BookingController($db);

// Маршрутизация
switch ($action) {
    case 'clients':
        switch ($method) {
            case 'create':
                $clientController->create();
                break;
            case 'edit':
                $clientController->edit($id);
                break;
            case 'delete':
                $clientController->delete($id);
                break;
            default:
                $clientController->index();
        }
        break;
        
    case 'employees':
        switch ($method) {
            case 'create':
                $employeeController->create();
                break;
            case 'edit':
                $employeeController->edit($id);
                break;
            case 'delete':
                $employeeController->delete($id);
                break;
            default:
                $employeeController->index();
        }
        break;
        
    case 'rooms':
        switch ($method) {
            case 'create':
                $roomController->create();
                break;
            case 'edit':
                $roomController->edit($id);
                break;
            case 'delete':
                $roomController->delete($id);
                break;
            case 'available':
                $roomController->available();
                break;
            default:
                $roomController->index();
        }
        break;
        
    case 'bookings':
        switch ($method) {
            case 'create':
                $bookingController->create();
                break;
            default:
                $bookingController->index();
        }
        break;
        
    default:
        // Если action не распознан, перенаправляем на home.php
        header("Location: home.php");
        exit();
}
?>
