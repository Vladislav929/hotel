<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>

<h2>Редактировать номер</h2>
<form method="POST" action="index.php?action=rooms&method=edit&id=<?= $room['id'] ?>">
    <div class="mb-3">
        <label for="room_number" class="form-label">Номер комнаты</label>
        <input type="text" class="form-control" id="room_number" name="room_number" value="<?= htmlspecialchars($room['room_number']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Тип номера</label>
        <input type="text" class="form-control" id="type" name="type" value="<?= htmlspecialchars($room['type']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="price_per_night" class="form-label">Цена за ночь</label>
        <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" value="<?= $room['price_per_night'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="capacity" class="form-label">Вместимость</label>
        <input type="number" class="form-control" id="capacity" name="capacity" value="<?= $room['capacity'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Статус</label>
        <select class="form-control" id="status" name="status" required>
            <option value="available" <?= $room['status'] == 'available' ? 'selected' : '' ?>>Доступен</option>
            <option value="occupied" <?= $room['status'] == 'occupied' ? 'selected' : '' ?>>Занят</option>
            <option value="maintenance" <?= $room['status'] == 'maintenance' ? 'selected' : '' ?>>На обслуживании</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($room['description']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="index.php?action=rooms" class="btn btn-secondary">Отмена</a>
</form>

<?php 
include $root . '/views/layout/footer.php'; 
?>
