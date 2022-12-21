<?php
//upload pics to database

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();


$data = json_decode(file_get_contents('php://input'));

$file = $_FILES['image']['name'];
$tempPath  =  $_FILES['image']['tmp_name'];
$fileSize  =  $_FILES['image']['size'];

$alt = $_POST['alt'];
$title = $_POST['title'];

if (empty($file)) {
    $errorMSG = json_encode(array(
        "message" => "please select image",
        "status" => false
    ));
    echo $errorMSG;
} else {
    $upload_path = 'images/';
    $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

    if (in_array($fileExt, $valid_extensions)) {

        if (!file_exists($upload_path . $file)) {

            if ($fileSize < 1000000) {
                move_uploaded_file($tempPath, $upload_path . $file);
            } else {
                $errorMSG = json_encode(array(
                    "message" => "Sorry, your file is too large, please upload 1 MB size",
                    "status" => false
                ));
                echo $errorMSG;
            }
        } else {
            $errorMSG = json_encode(array(
                "message" => "Sorry, file already exists check upload folder",
                "status" => false
            ));
            echo $errorMSG;
        }
    } else {
        $errorMSG = json_encode(array(
            "message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed",
            "status" => false
        ));
        echo $errorMSG;
    }
}

// insert the file and text data into the database
$sql = "INSERT INTO images (id, alt, title, filename, created_at) VALUES (null, :alt, :title, :filename, null)";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':alt', $alt);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':filename', $file);
if ($stmt->execute()) {
    $response =
        ['status' => 1, 'message' => "Image added sucessfully."];
} else {
    $response = ['status' => 0, 'message' => "Could not add Image."];
}
echo json_encode($response);
