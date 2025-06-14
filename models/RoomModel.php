<?php
class RoomModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllRooms() {
        $query = "SELECT * FROM rooms ORDER BY room_number";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getAvailableRooms() {
        $query = "SELECT * FROM rooms WHERE status = 'available' ORDER BY room_number";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getRoomById($id) {
        $query = "SELECT * FROM rooms WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createRoom($data) {
        $query = "INSERT INTO rooms 
                  (room_number, type, price_per_night, capacity, status, description) 
                  VALUES (:room_number, :type, :price_per_night, :capacity, :status, :description)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":room_number", $data['room_number']);
        $stmt->bindParam(":type", $data['type']);
        $stmt->bindParam(":price_per_night", $data['price_per_night']);
        $stmt->bindParam(":capacity", $data['capacity']);
        $stmt->bindParam(":status", $data['status']);
        $stmt->bindParam(":description", $data['description']);

        return $stmt->execute();
    }

    public function updateRoom($id, $data) {
        $query = "UPDATE rooms SET 
                    room_number = :room_number,
                    type = :type,
                    price_per_night = :price_per_night,
                    capacity = :capacity,
                    status = :status,
                    description = :description
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":room_number", $data['room_number']);
        $stmt->bindParam(":type", $data['type']);
        $stmt->bindParam(":price_per_night", $data['price_per_night']);
        $stmt->bindParam(":capacity", $data['capacity']);
        $stmt->bindParam(":status", $data['status']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function deleteRoom($id) {
        $query = "DELETE FROM rooms WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>
