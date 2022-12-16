<?php
//create events

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {

    $event = json_decode(file_get_contents('php://input'));
    $sql = "INSERT INTO events (id, name, loc_name, loc_address, loc_website, date, time, description, image, price, capacity) 
            VALUES (null, :name, :loc_name, :loc_address, :loc_website, :date, :time, :description, :image, :price, :capacity)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $event->name);
    $stmt->bindParam(':loc_name', $event->loc_name);
    $stmt->bindParam(':loc_address', $event->loc_address);
    $stmt->bindParam(':loc_website', $event->loc_website);
    $stmt->bindParam(':date', $event->date);
    $stmt->bindParam(':time', $event->time);
    $stmt->bindParam(':description', $event->description);
    $stmt->bindParam(':image', $event->image);
    $stmt->bindParam(':price', $event->price);
    $stmt->bindParam(':capacity', $event->capacity);
    if ($stmt->execute()) {
        $response = ['status' => 1, 'message' => "Event added sucessfully."];
    } else {
        $response = ['status' => 0, 'message' => "Could not add event."];
    }
    echo json_encode($response);
} else {
    echo "sth wrong in create.php";
}
