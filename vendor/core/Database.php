<?php

namespace Core;

class Database {
    private static $conn;
    public function __construct() {
        self::$conn = Connection::getInstance();
    }

    public static function insert( $data = [] ) {
        $table = self::getTable();
        $primaryKey = self::getPrimaryKey();
        $fillable = self::getFillable();
        echo '<pre>';
        var_dump( $fillable );
        echo '</pre>';
    }

    private static function getTable() {
        $class = get_called_class();
        $object = new $class;
        $tableClass = str_replace( 'App\\Models\\', '', $class );
        $table = $object->table ?? $tableClass;
        return $table;
    }

    private static function getPrimaryKey() {
        $class = get_called_class();
        $object = new $class;
        $primaryKey = $object->primaryKey ?? 'id';
        return $primaryKey;
    }

    private static function getFillable() {
        $class = get_called_class();
        $object = new $class;
        $fillable = $object->fillable ?? self::getField();
        return $fillable;
    }

    private static function getField() {
        $fieldArr = [];
        $sql = 'DESC '. self::getTable();
        $query = self::$conn->query( $sql );
        $columns = $query->fetchAll();
        foreach ( $columns as $key => $value ) {
            $fieldArr[] = $value['Field'];
        }
        return $fieldArr;
    }
}