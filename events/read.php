<?php
//get list of events

header("Access-Control-Allow-Origin: *");  //solving CORS issue
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    $sql = "SELECT * FROM events ORDER BY date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($events);
} else {
    die("error occured");
}
