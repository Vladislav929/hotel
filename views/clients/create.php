<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>

<h2>Добавить нового клиента</h2>
<form method="POST" action="index.php?action=clients&method=create">
    <div class="mb-3">
        <label for="first_name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Фамилия</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Телефон</label>
        <input type="tel" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="passport_number" class="form-label">Номер паспорта</label>
        <input type="text" class="form-control" id="passport_number" name="passport_number" required>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="index.php?action=clients" class="btn btn-secondary">Отмена</a>
</form>

<?php 
include $root . '/views/layout/footer.php'; 
?>
