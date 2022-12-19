<?php
//displaying one image
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {

    $path = explode('/', $_SERVER['REQUEST_URI']);
    if (isset($path[3]) && is_numeric($path[3])) {
        $sql = "SELECT * FROM images WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $path[3]);
        $stmt->execute();
        $images = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($images);
    } else {
        echo "error in retrieving single image";
    }
}
