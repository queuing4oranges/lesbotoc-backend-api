<?php
//displaying all images
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    $sql = "SELECT * FROM images ORDER BY created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($images);
} else {
    die("error occured");
}
