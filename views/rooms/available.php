<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>

<h2>Свободные номера</h2>
<a href="index.php?action=rooms" class="btn btn-secondary mb-3">Все номера</a>

<div class="row">
    <?php while ($row = $rooms->fetch(PDO::FETCH_ASSOC)): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Номер <?= htmlspecialchars($row['room_number']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($row['type']) ?></h6>
                <p class="card-text">
                    <strong>Цена за ночь:</strong> <?= $row['price_per_night'] ?> руб.<br>
                    <strong>Вместимость:</strong> <?= $row['capacity'] ?> чел.<br>
                    <strong>Описание:</strong> <?= htmlspecialchars($row['description']) ?>
                </p>
                <a href="index.php?action=bookings&method=create&room_id=<?= $row['id'] ?>" class="btn btn-primary">Забронировать</a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php 
include $root . '/views/layout/footer.php'; 
?>
