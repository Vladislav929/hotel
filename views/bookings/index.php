<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
// Проверяем существование переменной
if (!isset($bookings) || empty($bookings)) {
    echo '<div class="alert alert-info">Нет активных бронирований</div>';
    include $root . '/views/layout/footer.php';
    exit();
}
?>

<h2>Список бронирований</h2>
<a href="index.php?action=bookings&method=create" class="btn btn-primary mb-3">Создать бронирование</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Номер</th>
            <th>Сотрудник</th>
            <th>Дата заезда</th>
            <th>Дата выезда</th>
            <th>Сумма</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $bookings->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['client_first_name']) ?> <?= htmlspecialchars($row['client_last_name']) ?></td>
            <td><?= htmlspecialchars($row['room_number']) ?> (<?= htmlspecialchars($row['room_type']) ?>)</td>
            <td><?= htmlspecialchars($row['employee_first_name']) ?> <?= htmlspecialchars($row['employee_last_name']) ?></td>
            <td><?= $row['check_in_date'] ?></td>
            <td><?= $row['check_out_date'] ?></td>
            <td><?= $row['total_price'] ?> руб.</td>
            <td>
                <?php 
                    $statusClass = '';
                    if ($row['status'] == 'confirmed') $statusClass = 'text-success';
                    elseif ($row['status'] == 'cancelled') $statusClass = 'text-danger';
                    else $statusClass = 'text-primary';
                ?>
                <span class="<?= $statusClass ?>"><?= $row['status'] ?></span>
            </td>
            <td>
                <?php if ($row['status'] == 'confirmed'): ?>
                    <a href="./views/bookings/payment.php" class="payment-button">
                        Оплатить
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php 
include $root . '/views/layout/footer.php'; 
?>
