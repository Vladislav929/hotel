<?php
class EmployeeModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllEmployees() {
        $query = "SELECT * FROM employees ORDER BY hire_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getEmployeeById($id) {
        $query = "SELECT * FROM employees WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserRole($employeeId) {
        $query = "SELECT role FROM employees WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $employeeId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['role'] : null;
    }

    public function createEmployee($data) {
        $query = "INSERT INTO employees 
                  (first_name, last_name, position, phone, email, hire_date, salary) 
                  VALUES (:first_name, :last_name, :position, :phone, :email, :hire_date, :salary)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":position", $data['position']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":hire_date", $data['hire_date']);
        $stmt->bindParam(":salary", $data['salary']);

        return $stmt->execute();
    }

    public function updateEmployee($id, $data) {
        $query = "UPDATE employees SET 
                    first_name = :first_name,
                    last_name = :last_name,
                    position = :position,
                    phone = :phone,
                    email = :email,
                    hire_date = :hire_date,
                    salary = :salary
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":position", $data['position']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":hire_date", $data['hire_date']);
        $stmt->bindParam(":salary", $data['salary']);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function deleteEmployee($id) {
        $query = "DELETE FROM employees WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>
