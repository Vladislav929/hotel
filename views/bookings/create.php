<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>

<h2>Создать бронирование</h2>
<form method="POST" action="index.php?action=bookings&method=create" id="bookingForm">
    <div class="mb-3">
        <label for="client_id" class="form-label">Клиент</label>
        <select class="form-control" id="client_id" name="client_id" required>
            <option value="">Выберите клиента</option>
            <?php while ($client = $clients->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $client['id'] ?>"><?= htmlspecialchars($client['first_name']) ?> <?= htmlspecialchars($client['last_name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="room_id" class="form-label">Номер</label>
        <select class="form-control" id="room_id" name="room_id" required>
            <option value="">Выберите номер</option>
            <?php while ($room = $rooms->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $room['id'] ?>" data-price="<?= $room['price_per_night'] ?>">
                №<?= htmlspecialchars($room['room_number']) ?> - <?= htmlspecialchars($room['type']) ?> (<?= $room['price_per_night'] ?> руб./ночь)
            </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="employee_id" class="form-label">Сотрудник</label>
        <select class="form-control" id="employee_id" name="employee_id" required>
            <option value="">Выберите сотрудника</option>
            <?php while ($employee = $employees->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $employee['id'] ?>"><?= htmlspecialchars($employee['first_name']) ?> <?= htmlspecialchars($employee['last_name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="check_in_date" class="form-label">Дата заезда</label>
        <input type="datetime-local" class="form-control" id="check_in_date" name="check_in_date" required>
    </div>
    <div class="mb-3">
        <label for="check_out_date" class="form-label">Дата выезда</label>
        <input type="datetime-local" class="form-control" id="check_out_date" name="check_out_date" required>
    </div>
    <div class="mb-3">
        <label for="total_price" class="form-label">Итоговая цена</label>
        <input type="text" class="form-control" id="total_price" name="total_price" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Создать бронирование</button>
    <a href="index.php?action=bookings" class="btn btn-secondary">Отмена</a>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roomSelect = document.getElementById('room_id');
    const checkInDate = document.getElementById('check_in_date');
    const checkOutDate = document.getElementById('check_out_date');
    const totalPrice = document.getElementById('total_price');
    
    function calculateTotal() {
        if (roomSelect.value && checkInDate.value && checkOutDate.value) {
            const pricePerNight = parseFloat(roomSelect.options[roomSelect.selectedIndex].getAttribute('data-price'));
            const start = new Date(checkInDate.value);
            const end = new Date(checkOutDate.value);
            const nights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            
            if (nights > 0) {
                totalPrice.value = (pricePerNight * nights).toFixed(2) + ' руб.';
            } else {
                totalPrice.value = 'Некорректные даты';
            }
        }
    }
    
    roomSelect.addEventListener('change', calculateTotal);
    checkInDate.addEventListener('change', calculateTotal);
    checkOutDate.addEventListener('change', calculateTotal);
});
</script>

<?php 
include $root . '/views/layout/footer.php'; 
?>
