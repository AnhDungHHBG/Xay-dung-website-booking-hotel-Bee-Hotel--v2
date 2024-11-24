<?php 
class Feature extends BaseModel {
    public $tableName = 'feature';

    public function delete_feature($id) {
        try {
            // Bắt đầu transaction
            $this->conn->beginTransaction();

            // Xóa các bản ghi liên quan trong bảng room_feature
            $queryRoomFeature = "DELETE FROM room_feature WHERE feature_id = :feature_id";
            $stmtRoomFeature = $this->conn->prepare($queryRoomFeature);
            $stmtRoomFeature->bindParam(':feature_id', $id, PDO::PARAM_INT);
            $stmtRoomFeature->execute();

            // Xóa bản ghi trong bảng feature
            $queryFeature = "DELETE FROM feature WHERE feature_id = :feature_id";
            $stmtFeature = $this->conn->prepare($queryFeature);
            $stmtFeature->bindParam(':feature_id', $id, PDO::PARAM_INT);
            $stmtFeature->execute();

            // Hoàn tất transaction
            $this->conn->commit();

            return true; // Thành công
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Delete Feature Error: " . $e->getMessage());
            return false; 
        }
    }
}
?>
