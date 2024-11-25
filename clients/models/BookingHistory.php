<?php
class BookingHistory extends BaseModel
{
    public $tableName = 'booking_history';

    public function booking_history_list($user_id)
    {
        $query = "SELECT
            b.booking_id,
            b.room_id,
            r.room_type_id,
            rt.type_name AS room_type,
            b.check_in,
            b.check_out,
            b.status AS booking_status,
            b.total_price,
            b.number_of_guests,
            b.special_requests,
            bh.history_id,
            bh.action,
            bh.description AS action_description,
            bh.created_at AS history_created_at
        FROM
            booking b
        JOIN
            room r ON b.room_id = r.room_id
        JOIN
            room_type rt ON r.room_type_id = rt.room_type_id
        LEFT JOIN
            booking_history bh ON b.booking_id = bh.booking_id
        WHERE
            b.user_id = :user_id
        ORDER BY
            b.check_in DESC
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $bookings; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
