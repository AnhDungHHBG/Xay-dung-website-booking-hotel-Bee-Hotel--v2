<?php 
class Amenity extends BaseModel{
    public $tableName = 'hotel_amenity';


    public function getAllAmenities() {
        $query = "SELECT amenity_id, amenity_type FROM {$this->tableName} ORDER BY amenity_id DESC";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
    
    public function getAllAmenitiesById($id) 
    {
        $query = "SELECT * FROM hotel_amenity WHERE amenity_id = :amenity_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':amenity_id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addAmenity($data) {
        $query = "INSERT INTO {$this->tableName} (amenity_type) VALUES (:amenity_type)";
        $stmt = $this->conn->prepare($query);
    
        $amenity_type = isset($data['amenity_type']) ? (string) $data['amenity_type'] : '';
    
        $stmt->bindParam(':amenity_type', $amenity_type, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }
    public function updateAmenity($id, $data) 
    {
        $query = "UPDATE hotel_amenity 
                  SET amenity_type = :amenity_type 
                  WHERE amenity_id = :amenity_id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':amenity_type', $data['amenity_type'], PDO::PARAM_STR);
        $stmt->bindParam(':amenity_id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    public function deleteAmenity($amenity_id) {
        $query = "DELETE FROM {$this->tableName} WHERE amenity_id = :amenity_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':amenity_id', $amenity_id, PDO::PARAM_INT);
    
        return $stmt->execute(); 
    }  
    
}

?>