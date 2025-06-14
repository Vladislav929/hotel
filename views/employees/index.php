<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>

<h2>Список сотрудников</h2>
<a href="index.php?action=employees&method=create" class="btn btn-primary mb-3">Добавить сотрудника</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Должность</th>
            <th>Телефон</th>
            <th>Дата найма</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $employees->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['position']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= $row['hire_date'] ?></td>
            <td>
                <a href="index.php?action=employees&method=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Редактировать</a>
                <a href="index.php?action=employees&method=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php 
include $root . '/views/layout/footer.php'; 
?>
