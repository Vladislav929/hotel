<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>

<h2>Список номеров</h2>
<a href="index.php?action=rooms&method=create" class="btn btn-primary mb-3">Добавить номер</a>
<a href="index.php?action=rooms&method=available" class="btn btn-success mb-3">Свободные номера</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Номер</th>
            <th>Тип</th>
            <th>Цена за ночь</th>
            <th>Вместимость</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $rooms->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['room_number']) ?></td>
            <td><?= htmlspecialchars($row['type']) ?></td>
            <td><?= $row['price_per_night'] ?></td>
            <td><?= $row['capacity'] ?></td>
            <td>
                <?php 
                    $statusClass = '';
                    if ($row['status'] == 'available') $statusClass = 'text-success';
                    elseif ($row['status'] == 'occupied') $statusClass = 'text-danger';
                    else $statusClass = 'text-warning';
                ?>
                <span class="<?= $statusClass ?>"><?= $row['status'] ?></span>
            </td>
            <td>
                <a href="index.php?action=rooms&method=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Редактировать</a>
                <a href="index.php?action=rooms&method=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php 
include $root . '/views/layout/footer.php'; 
?>
