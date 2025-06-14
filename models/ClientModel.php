<?php
class ClientModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllClients() {
        $query = "SELECT * FROM clients ORDER BY registration_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getClientById($id) {
        $query = "SELECT * FROM clients WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createClient($data) {
        $query = "INSERT INTO clients (first_name, last_name, phone, email, passport_number) 
                  VALUES (:first_name, :last_name, :phone, :email, :passport_number)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":passport_number", $data['passport_number']);

        return $stmt->execute();
    }

    public function updateClient($id, $data) {
        $query = "UPDATE clients SET 
                    first_name = :first_name,
                    last_name = :last_name,
                    phone = :phone,
                    email = :email,
                    passport_number = :passport_number
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":passport_number", $data['passport_number']);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function deleteClient($id) {
        $query = "DELETE FROM clients WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>
