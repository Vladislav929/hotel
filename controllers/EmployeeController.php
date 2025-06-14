<?php
require_once __DIR__ . '/../models/EmployeeModel.php';

class EmployeeController {
    private $model;

    public function __construct($db) {
        $this->model = new EmployeeModel($db);
    }

    public function index() {
        $employees = $this->model->getAllEmployees();
        require_once __DIR__ . '/../views/employees/index.php';
    }

    public function show($id) {
        $employee = $this->model->getEmployeeById($id);
        if ($employee) {
            require_once '../views/employees/show.php';
        } else {
            header('Location: index.php?action=employees');
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'position' => $_POST['position'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'hire_date' => $_POST['hire_date'],
                'salary' => $_POST['salary']
            ];

            if ($this->model->createEmployee($data)) {
                header('Location: index.php?action=employees');
            } else {
                echo "Ошибка при создании сотрудника";
            }
        } else {
            require_once __DIR__ . '/../views/employees/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'position' => $_POST['position'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'hire_date' => $_POST['hire_date'],
                'salary' => $_POST['salary']
            ];

            if ($this->model->updateEmployee($id, $data)) {
                header('Location: index.php?action=employees');
            } else {
                echo "Ошибка при обновлении сотрудника";
            }
        } else {
            $employee = $this->model->getEmployeeById($id);
            if ($employee) {
                require_once __DIR__ . '/../views/employees/edit.php';
            } else {
                header('Location: index.php?action=employees');
            }
        }
    }

    public function delete($id) {
        if ($this->model->deleteEmployee($id)) {
            header('Location: index.php?action=employees');
        } else {
            echo "Ошибка при удалении сотрудника";
        }
    }
}
?>
