<?php 
class User extends BaseModel
{
    public $tableName = 'user';

    public function findUserByEmail($email) {
        try {
            $sql = "SELECT * FROM {$this->tableName} WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }
}

?>
