<?php
//create speeddating contact



header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {

    $dating = json_decode(file_get_contents('php://input'));

    $sql = "INSERT INTO dating(id, date, name, email, phone, age) VALUES (null, :date, :name, :email, :phone, :age)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':date', $dating->date);
    $stmt->bindParam(':name', $dating->name);
    $stmt->bindParam(':email', $dating->email);
    $stmt->bindParam(':phone', $dating->phone);
    $stmt->bindParam(':age', $dating->age);

    if ($stmt->execute()) {
        $response = ['status' => 1, 'message' => "Speed Dating Registration successfully added."];
    } else {
        $response = ['status' => 0, 'message' => "Could not add Speed Dating Registration."];
    }
    echo json_encode(($response));
} else {
    echo "Something wrong in the speeddating/create.php";
}
