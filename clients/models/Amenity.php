<?php 
class Amenity extends BaseModel
{
    public $tableName = 'hotel_amenity';
    public function get_all_amenity($limit = 10){
        try {
            $sql = "SELECT * FROM {$this->tableName} ORDER BY amenity_id DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
}

?>
