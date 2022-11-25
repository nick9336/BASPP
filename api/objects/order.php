<?php

class Order {

    // database connection and table name
    private $conn;
    private $table_name = "orders";
    // object properties
    public $id;
    public $user_id;
    public $name;
    public $number;
    public $email;
    public $method;
    public $address;
    public $total_products;
    public $total_price;
    public $placed_on;
    public $payment_status;

    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read products
    function read() {

        // select all query
        $query = "SELECT
                 o.id, o.user_id, o.name, o.number, o.email, o.method, o.address, o.total_products, o.total_price, o.placed_on, o.payment_status 
            FROM
                " . $this->table_name . " o
                LEFT JOIN
                    users u
                        ON o.user_id = u.id
            ORDER BY
                o.id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create() {

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                user_id=:user_id, name=:name, number=:number, email=:email, method=:method, address=:address, total_products=:total_products, total_price=:total_price, placed_on=:placed_on, payment_status=:payment_status";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
		$this->user_id = htmlspecialchars(strip_tags($this->user_id));
		$this->number = htmlspecialchars(strip_tags($this->number));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->method = htmlspecialchars(strip_tags($this->method));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->total_products = htmlspecialchars(strip_tags($this->total_products));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
        $this->placed_on = htmlspecialchars(strip_tags($this->placed_on));
		$this->payment_status = htmlspecialchars(strip_tags($this->payment_status));

        // bind values
        $stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":user_id", $this->user_id);
		$stmt->bindParam(":number", $this->number);
		$stmt->bindParam(":email", $this->email);
		$stmt->bindParam(":method", $this->method);
		$stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":total_products", $this->total_products);
        $stmt->bindParam(":total_price", $this->total_price);
        $stmt->bindParam(":placed_on", $this->placed_on);
        $stmt->bindParam(":payment_status", $this->payment_status);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // used when filling up the update product form
    function readOne() {

        // query to read single record
        $query = "SELECT
                 o.id, o.user_id, o.name, o.number, o.email, o.method, o.address, o.total_products, o.total_price, o.placed_on, o.payment_status 
            FROM
                " . $this->table_name . " o
                LEFT JOIN
                    users u
                        ON o.user_id = u.id
            WHERE
                o.id = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
		$this->user_id = $row['user_id'];
		$this->number = $row['number'];
		$this->email = $row['email'];
		$this->method = $row['method'];
		$this->address = $row['address'];
        $this->total_products = $row['total_products'];
        $this->total_price = $row['total_price'];
        $this->payment_status = $row['payment_status'];
    }

    // update the product
    function update() {

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
				user_id = :user_id,
				number = :number,
				email = :email,
				method = :method,
				address = :address,
				total_products = :total_products,
                total_price = :total_price,
                payment_status = :payment_status
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
		$this->user_id = htmlspecialchars(strip_tags($this->user_id));
		$this->number = htmlspecialchars(strip_tags($this->number));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->method = htmlspecialchars(strip_tags($this->method));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->total_products = htmlspecialchars(strip_tags($this->total_products));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
		$this->payment_status = htmlspecialchars(strip_tags($this->payment_status));
		$this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->bindParam(':number', $this->number);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':method', $this->method);
		$stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':total_products', $this->total_products);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':payment_status', $this->payment_status);
		$stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete the product
    function delete() {

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // search products
    function search($keywords) {

        // select all query
        $query = "SELECT
                 o.id, o.user_id, o.name, o.number, o.email, o.method, o.address, o.total_products, o.total_price, o.placed_on, o.payment_status 
            FROM
                " . $this->table_name . " o
                LEFT JOIN
                    users u
                        ON o.user_id = u.id
            WHERE
                o.id LIKE ? OR o.email LIKE ? OR o.number LIKE ? 
            ORDER BY
                o.id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page) {

        // select query
        $query = "SELECT
                o.id, o.user_id, o.name, o.number, o.email, o.method, o.address, o.total_products, o.total_price, o.placed_on, o.payment_status 
            FROM
                " . $this->table_name . " o
                LEFT JOIN
                    users u
                        ON o.user_id = u.id
            ORDER BY o.id
            LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

}

?>