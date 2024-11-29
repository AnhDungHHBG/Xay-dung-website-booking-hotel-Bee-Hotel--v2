<?php 
// Các thành phần mặc định của 1 model phải có. Tất cả các model đều phải kế thừa lớp này
class BaseModel {
    public $tableName;
    public $conn;

    public function __construct() {
        global $coreApp;
        $this->conn = $coreApp->connectDB();
    }

    public function allTable($limit = 20) {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->tableName} ORDER BY {$this->tableName}_id DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }

    public function findIdTable($id) {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->tableName} WHERE {$this->tableName}_id = :id";
    
            $stmt = $this->conn->prepare($sql);
        
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch(Exception $e) {
            $coreApp->debug($e);
        }
    }   

    public function removeIdTable($id) {
        try {
            global $coreApp;
            $sql = "DELETE FROM {$this->tableName} WHERE (`{$this->tableName}_id` = :id)";
    
            $stmt = $this->conn->prepare($sql);
        
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch(Exception $e) {
            $coreApp->debug($e);
        }
    }

    public function insertTable($data) {
        try {
            global $coreApp;
            $data = $this->convertToArray($data);
            // Lấy các tên cột từ mảng $data
            $columns = array_keys($data);
            // Tạo chuỗi các tên cột
            $columnsString = implode(', ', $columns);
            // Tạo chuỗi các placeholder
            $placeholders = ':' . implode(', :', $columns);
            
            // Tạo câu lệnh SQL
            $sql = "INSERT INTO $this->tableName ($columnsString) VALUES ($placeholders)";
            
            $stmt = $this->conn->prepare($sql);
            
            // Chuyển đổi mảng $data thành mảng có dạng ['column' => value]
            $parameters = [];
            foreach ($data as $key => $value) {
                $parameters[":$key"] = $value;
            }

            return $stmt->execute($parameters);
        } catch(Exception $e) {
            $coreApp->debug($e);
        }
    }

    public function updateIdTable($data, $id) {
        try {
            global $coreApp;
            $data = $this->convertToArray($data);
            // Lấy các tên cột từ mảng $data
            $columns = array_keys($data);
            // Tạo chuỗi các cặp 'column = :column'
            $setString = implode(', ', array_map(function($col) {
                return "$col = :$col";
            }, $columns));
            
            // Tạo câu lệnh SQL
            $sql = "UPDATE $this->tableName SET $setString WHERE {$this->tableName}_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            
            // Chuyển đổi mảng $data thành mảng có dạng ['column' => value]
            $parameters = [];
            foreach ($data as $key => $value) {
                $parameters[":$key"] = $value;
            }
            // Thêm id vào mảng parameters
            $parameters[':id'] = $id;

            return $stmt->execute($parameters);
        } catch(Exception $e) {
            $coreApp->debug($e);
        }
    }

    private function convertToArray($data) {
        if (is_object($data)) {
            return get_object_vars($data);
        } elseif (is_array($data)) {
            return $data;
        } else {
            return null;
        }
    }
    public function createBookingHistory($bookingId, $userId, $action, $description) {
        try {
            global $coreApp;
            
            $currentTime = date('Y-m-d H:i:s');
            
            $sql = "INSERT INTO booking_history (booking_id, user_id, action, description, created_at) 
                    VALUES (:booking_id, :user_id, :action, :description, :created_at)";
            
            $stmt = $this->conn->prepare($sql);
            
            return $stmt->execute([
                ':booking_id' => $bookingId,
                ':user_id' => $userId,
                ':action' => $action,
                ':description' => $description,
                ':created_at' => $currentTime
            ]);
        } catch (Exception $e) {
            global $coreApp;
            $coreApp->debug($e);
        }
    }
    public function create_notification($userId, $title, $content) {
        try {
            global $coreApp;
            
            $currentTime = date('Y-m-d H:i:s');
            
            $sql = "INSERT INTO notification (user_id, title, content, is_read, created_at) 
                    VALUES (:user_id, :title, :content, :is_read, :created_at)";
            
            $stmt = $this->conn->prepare($sql);
            $isRead = 0;
            return $stmt->execute([
                ':user_id' => $userId,
                ':title' => $title,
                ':content' => $content,
                ':is_read' => $isRead,
                ':created_at' => $currentTime
            ]);
        } catch (Exception $e) {
            global $coreApp;
            $coreApp->debug($e);
        }
    }
    
}