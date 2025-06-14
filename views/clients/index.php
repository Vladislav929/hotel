<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>
<h2>Список клиентов</h2>
<a href="index.php?action=clients&method=create" class="btn btn-primary mb-3">Добавить клиента</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Дата регистрации</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $clients->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= $row['registration_date'] ?></td>
            <td>
                <a href="index.php?action=clients&method=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Редактировать</a>
                <a href="index.php?action=clients&method=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php 
include $root . '/views/layout/footer.php'; 
?>
