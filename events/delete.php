<?php
//delete events

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "DELETE") {
    $event = json_decode(file_get_contents('php://input'));

    $sql = "DELETE FROM events WHERE id=:id";
    $path = explode('/', $_SERVER['REQUEST_URI']); //finding id with explode method

    $stmt = $conn->prepare($sql);

    // $stmt->bindParam(':id', $event->id);
    $stmt->bindParam(':id', $path[3]);

    if ($stmt->execute()) {
        $response = ['status' => 1, 'message' => "Event deleted sucessfully."];
    } else {
        $response = ['status' => 0, 'message' => "Could not delete Event."];
    }
    echo json_encode($response);
} else {
    echo "error here";
}
