<?php
//delete an image

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "DELETE") {

    $image = json_decode(file_get_contents('php://input'));

    //show one row with $image and path
    //then take the "filename" out of it
    //then make a path with that filename

    // var_dump($image);

    // $filename = $image->filename;
    // unlink("images" . $filename);

    $sql = "DELETE FROM images WHERE id=:id";
    $path = explode('/', $_SERVER['REQUEST_URI']);

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $path[3]);

    if ($stmt->execute()) {

        $response = ['status' => 1, 'message' => "Image deleted sucessfully."];
        unlink("images/" . $image);
    } else {
        $response = ['status' => 0, 'message' => "Could not delete Image."];
    }
    echo json_encode($response);
} else {
    echo "error here";
}
