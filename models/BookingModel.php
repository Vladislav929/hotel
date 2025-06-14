<?php
class BookingModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllBookings() {
        $query = "SELECT b.*, 
                  c.first_name as client_first_name, c.last_name as client_last_name,
                  r.room_number, r.type as room_type,
                  e.first_name as employee_first_name, e.last_name as employee_last_name
                  FROM bookings b
                  JOIN clients c ON b.client_id = c.id
                  JOIN rooms r ON b.room_id = r.id
                  JOIN employees e ON b.employee_id = e.id
                  ORDER BY b.booking_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getBookingById($id) {
        $query = "SELECT * FROM bookings WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function markAsPaid($bookingId) {
        $query = "UPDATE bookings SET 
                  status = 'paid', 
                  payment_date = NOW() 
                  WHERE id = ? AND status = 'pending'";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$bookingId]);
    }

    public function createBooking($data) {
        $query = "INSERT INTO bookings 
                  (client_id, room_id, employee_id, check_in_date, check_out_date, total_price, status) 
                  VALUES (:client_id, :room_id, :employee_id, :check_in_date, :check_out_date, :total_price, :status)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":client_id", $data['client_id']);
        $stmt->bindParam(":room_id", $data['room_id']);
        $stmt->bindParam(":employee_id", $data['employee_id']);
        $stmt->bindParam(":check_in_date", $data['check_in_date']);
        $stmt->bindParam(":check_out_date", $data['check_out_date']);
        $stmt->bindParam(":total_price", $data['total_price']);
        $stmt->bindParam(":status", $data['status']);

        if ($stmt->execute()) {
            // Обновляем статус номера на "occupied"
            $updateQuery = "UPDATE rooms SET status = 'occupied' WHERE id = :room_id";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(":room_id", $data['room_id']);
            $updateStmt->execute();
            
            return true;
        }
        
        return false;
    }

    public function calculateTotalPrice($room_id, $check_in_date, $check_out_date) {
        $room = $this->getRoomPrice($room_id);
        if (!$room) return 0;

        $start = new DateTime($check_in_date);
        $end = new DateTime($check_out_date);
        $nights = $start->diff($end)->days;

        return $room['price_per_night'] * $nights;
    }

    private function getRoomPrice($room_id) {
        $query = "SELECT price_per_night FROM rooms WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $room_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
