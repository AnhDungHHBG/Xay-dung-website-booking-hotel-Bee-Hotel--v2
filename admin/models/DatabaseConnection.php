<?php

class Database {
    private static $db;

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new PDO('mysql:host=localhost;dbname=hotel_managementv4', 'root', '');
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$db;
    }
}
?>
