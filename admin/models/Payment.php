<?php 
class Payment extends BaseModel
{
    public $tableName = 'payment';

    public function confirm_payment($booking_id) {
        try {
            $this->conn->beginTransaction();
            $updatePaymentQuery = "UPDATE payment 
                                   SET status = :status 
                                   WHERE booking_id = :booking_id";
            $stmt = $this->conn->prepare($updatePaymentQuery);
            $stmt->bindValue(':status', 'Success');
            $stmt->bindValue(':booking_id', $booking_id);
            $stmt->execute();
            $this->conn->commit();
            return [
                'success' => true,
                'message' => 'Check-in xác nhận thành công.'
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            return [
                'success' => false,
                'message' => 'Lỗi khi xác nhận check-in: ' . $e->getMessage()
            ];
        }
    }

    public function get_total_revenue() {
        try {
            $query = "SELECT SUM(amount) AS total_revenue FROM payment WHERE status = 'Success'";
    
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result['total_revenue'] ? $result['total_revenue'] : 0;
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Lỗi khi tính tổng doanh thu: ' . $e->getMessage()
            ];
        }
    }

    public function get_bookings_and_revenue_permonth() {
        $query = "SELECT MIN(MONTH(booking.check_in)) AS first_month
          FROM booking
          JOIN payment ON booking.booking_id = payment.booking_id
          WHERE payment.status = 'Success'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $first_month = $row['first_month']; // Tháng đầu tiên có dữ liệu từ cơ sở dữ liệu
        $current_year = date('Y');

        // Kiểm tra nếu không có dữ liệu, tháng đầu tiên sẽ là tháng 1 của năm hiện tại
        if (!$first_month) {
            $first_month = 1;
        }

        // Tạo mảng tháng (từ tháng đầu tiên đến 12 tháng)
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $month = ($first_month + $i - 1) % 12 + 1;
            $year_offset = floor(($first_month + $i - 1) / 12);
            $months[] = date('F', mktime(0, 0, 0, $month, 1)) . ' ' . ($current_year + $year_offset);
        }

        $query = "SELECT MONTH(booking.check_in) AS month, 
                          COUNT(booking.booking_id) AS bookings, 
                          SUM(payment.amount) AS revenue
                  FROM payment
                  JOIN booking ON payment.booking_id = booking.booking_id
                  WHERE payment.status = 'Success'
                  GROUP BY MONTH(booking.check_in)
                  ORDER BY MONTH(booking.check_in)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $bookings_per_month = [];
        $revenue_per_month = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $bookings_per_month[] = $row['bookings'];
            $revenue_per_month[] = $row['revenue'] ?: 0;  
        }

        return [
            'months' => $months,
            'bookings_per_month' => $bookings_per_month,
            'revenue_per_month' => $revenue_per_month
        ];
    }

    public function get_revenue_month() {
        $sql = "SELECT 
            MONTH(booking.check_in) AS month,       
            SUM(payment.amount) AS revenue           
        FROM 
            payment
        JOIN 
            booking ON payment.booking_id = booking.booking_id  
        WHERE 
            YEAR(booking.check_in) = YEAR(CURDATE())   
        GROUP BY 
            MONTH(booking.check_in)                 
        ORDER BY 
            MONTH(booking.check_in);";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $revenue_per_month = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $revenue_per_month[] = $row['revenue'] ?: 0; 
        }

        return $revenue_per_month;
    }
}
?>