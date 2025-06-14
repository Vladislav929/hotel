<?php
session_start();
require_once 'config/database.php';
require_once 'models/BookingModel.php';

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$bookingId = $_GET['booking_id'] ?? null;
$db = (new Database())->getConnection();
$bookingModel = new BookingModel($db);
$booking = $bookingModel->getBookingById($bookingId);

// Проверка существования брони
if (!$booking || $booking['status'] != 'pending') {
    header('Location: bookings.php');
    exit();
}

// Обработка оплаты
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($bookingModel->markAsPaid($bookingId)) {
        $_SESSION['payment_success'] = true;
        header('Location: bookings.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Оплата бронирования</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Оплата бронирования №<?= $booking['id'] ?></h2>
        
        <div class="card mb-4">
            <div class="card-body">
                <h5>Детали бронирования:</h5>
                <p>Номер: <?= $booking['room_number'] ?></p>
                <p>Клиент: <?= $booking['client_name'] ?></p>
                <p>Даты: <?= $booking['check_in'] ?> - <?= $booking['check_out'] ?></p>
                <h4 class="mt-3">Сумма к оплате: <?= $booking['total_price'] ?> руб.</h4>
            </div>
        </div>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Номер карты</label>
                <input type="text" class="form-control" placeholder="0000 0000 0000 0000" required>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Срок действия</label>
                    <input type="text" class="form-control" placeholder="MM/YY" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CVV</label>
                    <input type="text" class="form-control" placeholder="123" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Подтвердить оплату</button>
            <a href="bookings.php" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</body>
</html>
