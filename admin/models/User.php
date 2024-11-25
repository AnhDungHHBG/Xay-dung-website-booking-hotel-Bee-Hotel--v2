<?php
class User extends BaseModel{
    public $tableName="user";
    public function get_all_users_count(){
        $query = 'SELECT COUNT(*) AS user_count FROM user;';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['user_count'];  
    }
    
}