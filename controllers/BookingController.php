<?php
require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/ClientModel.php';
require_once __DIR__ . '/../models/RoomModel.php';
require_once __DIR__ . '/../models/EmployeeModel.php';

class BookingController {
    private $bookingModel;
    private $clientModel;
    private $roomModel;
    private $employeeModel;

    public function __construct($db) {
        $this->bookingModel = new BookingModel($db);
        $this->clientModel = new ClientModel($db);
        $this->roomModel = new RoomModel($db);
        $this->employeeModel = new EmployeeModel($db);
    }

    public function index() {
        $bookings = $this->bookingModel->getAllBookings();
        require_once __DIR__ . '/../views/bookings/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $total_price = $this->bookingModel->calculateTotalPrice(
                $_POST['room_id'],
                $_POST['check_in_date'],
                $_POST['check_out_date']
            );

            $data = [
                'client_id' => $_POST['client_id'],
                'room_id' => $_POST['room_id'],
                'employee_id' => $_POST['employee_id'],
                'check_in_date' => $_POST['check_in_date'],
                'check_out_date' => $_POST['check_out_date'],
                'total_price' => $total_price,
                'status' => 'confirmed'
            ];

            if ($this->bookingModel->createBooking($data)) {
                header('Location: index.php?action=bookings');
            } else {
                echo "Ошибка при создании бронирования";
            }
        } else {
            $clients = $this->clientModel->getAllClients();
            $rooms = $this->roomModel->getAvailableRooms();
            $employees = $this->employeeModel->getAllEmployees();
            require_once __DIR__ . '/../views/bookings/create.php';
        }
    }
    public function payment() {
        // Проверка авторизации
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }
    
        // Получаем ID бронирования
        $bookingId = $_GET['id'] ?? 0;
        
        // Подключаем шаблон формы оплаты
        include __DIR__ . '/../views/bookings/payment.html';
    }
}
?>
