<?php

class User {

    // database connection and table name
    private $conn;
    private $table_name = "users";
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // used by select drop-down list
    public function readAll() {
        //select all data
        $query = "SELECT
                    id, name, email
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // used by select drop-down list
    public function read() {

        //select all data
        $query = "SELECT
                id, name, email
            FROM
                " . $this->table_name . "
            ORDER BY
                name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}

?>