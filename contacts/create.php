<?php
//create contacts

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {

    $contact = json_decode(file_get_contents('php://input'));
    $sql = "INSERT INTO contacts(id, name, wherefrom, email, phone, age, newsletter) VALUES (null, :name, :wherefrom, :email, :phone, :age, :newsletter)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $contact->name);
    $stmt->bindParam(':wherefrom', $contact->wherefrom);
    $stmt->bindParam(':email', $contact->email);
    $stmt->bindParam(':phone', $contact->phone);
    $stmt->bindParam(':age', $contact->age);
    $stmt->bindParam(':newsletter', $contact->newsletter);
    if ($stmt->execute()) {
        $response = ['status' => 1, 'message' => "Contact added sucessfully."];
    } else {
        $response = ['status' => 0, 'message' => "Could not add contact."];
    }
    echo json_encode($response);
} else {
    echo "sth wrong in create.php";
}
