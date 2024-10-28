<?php
namespace Khamid\Framework\Core;

use Khamid\Framework\Core\Database;
use PDO;

class BaseModel {
    protected $table;

    public function getAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($where) {
        $db = Database::getInstance()->getConnection();
    
        $whereClause = $this->buildWhereClause($where);
    
        $sql = "SELECT * FROM {$this->table} WHERE {$whereClause}";
        $stmt = $db->prepare($sql);
    
        $stmt->execute($where);
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function create($data) {
        $db = Database::getInstance()->getConnection();
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
    }

    public function find($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update($where, $data) {
        $db = Database::getInstance()->getConnection();
        $fields = implode(", ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($data)));

        $whereClause = $this->buildWhereClause($where);
        $params = array_merge($data, $where);

        $sql = "UPDATE {$this->table} SET $fields WHERE $whereClause";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
    }

    public function delete($where) {
        $db = Database::getInstance()->getConnection();
        $whereClause = $this->buildWhereClause($where);

        $sql = "DELETE FROM {$this->table} WHERE $whereClause";
        $stmt = $db->prepare($sql);
        $stmt->execute($where);
    }

    private function buildWhereClause($where) {
        return implode(" AND ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($where)));
    }
}