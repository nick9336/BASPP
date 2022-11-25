<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/order.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$order = new Order($db);
  
// set ID property of record to read
$order->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$order->readOne();
  
if($order->name!=null){
    // create array
    $order_arr = array(
            "id" => $order->id,
			"user_id" => $order->user_id,
            "name" => $order->name,
			"number" => $order->number,
            "email" => $order->email,
            "method" => $order->method,
            "address" => $order->address,
            "total_products" => $order->total_products,
			"total_price" => $order->total_price,
			"payment_status" => $order->payment_status
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($order_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Order does not exist."));
}
?>