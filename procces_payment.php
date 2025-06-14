<?php
// Подключение необходимых файлов
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/BookingModel.php';

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Здесь должна быть логика обработки платежа
    // Например, обновление статуса бронирования в БД
    
    $bookingId = $_POST['booking_id'] ?? null;
    
    if ($bookingId) {
        // Пример обновления статуса бронирования
        $bookingModel = new BookingModel();
        $bookingModel->updateBookingStatus($bookingId, 'paid');
        
        // Перенаправление на главную страницу
        header('Location: /hotel_system/index.php');
        exit;
    }
}

// Если что-то пошло не так, тоже перенаправляем на главную
header('Location: /hotel_system/index.php');
exit;
