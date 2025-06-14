<?php 
$root = $_SERVER['DOCUMENT_ROOT'] . '/hotel_system';
include $root . '/views/layout/header.php'; 
?>

<h2>Добавить нового сотрудника</h2>
<form method="POST" action="index.php?action=employees&method=create">
    <div class="mb-3">
        <label for="first_name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Фамилия</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="mb-3">
        <label for="position" class="form-label">Должность</label>
        <input type="text" class="form-control" id="position" name="position" required>
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
        <label for="hire_date" class="form-label">Дата найма</label>
        <input type="date" class="form-control" id="hire_date" name="hire_date" required>
    </div>
    <div class="mb-3">
        <label for="salary" class="form-label">Зарплата</label>
        <input type="number" step="0.01" class="form-control" id="salary" name="salary" required>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="index.php?action=employees" class="btn btn-secondary">Отмена</a>
</form>

<?php 
include $root . '/views/layout/footer.php'; 
?>
