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
    $sql = "SELECT * FROM dating ORDER BY date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $dating = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dating);
} else {
    die("error occured");
}
