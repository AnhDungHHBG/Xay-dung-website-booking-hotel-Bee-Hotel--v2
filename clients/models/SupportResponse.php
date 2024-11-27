<?php 
class SupportResponse extends BaseModel
{
    public $tableName = 'support_response';
    public function get_ticket_and_responses($user_id) {
        $query = "SELECT 
                st.ticket_id, 
                st.subject AS ticket_subject, 
                st.message AS ticket_message, 
                sr.response_id, 
                sr.message AS response_message, 
                sr.created_at AS response_date, 
                u.name AS staff_name
            FROM 
                support_ticket st
            LEFT JOIN 
                support_response sr ON st.ticket_id = sr.ticket_id
            LEFT JOIN 
                user u ON sr.staff_id = u.user_id
            WHERE 
                st.user_id = :user_id
            ORDER BY 
                st.created_at DESC, sr.created_at DESC;
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}

?>
