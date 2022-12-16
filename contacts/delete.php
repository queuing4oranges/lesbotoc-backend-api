<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "DELETE") {
    $contact = json_decode(file_get_contents('php://input'));

    $sql = "DELETE FROM contacts WHERE id=:id";
    $path = explode('/', $_SERVER['REQUEST_URI']); //finding id with explode method

    $stmt = $conn->prepare($sql);

    // $stmt->bindParam(':id', $contact->id);
    $stmt->bindParam(':id', $path[3]);

    if ($stmt->execute()) {
        $response = ['status' => 1, 'message' => "Contact deleted sucessfully."];
    } else {
        $response = ['status' => 0, 'message' => "Could not delete contact."];
    }
    echo json_encode($response);
} else {
    echo "error here";
}
