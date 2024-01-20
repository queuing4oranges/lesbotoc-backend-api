<?php
//create events

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {

	$data = json_decode(file_get_contents('php://input'));

	$file = $_FILES['image_path']['name'];
	$tempPath  =  $_FILES['image_path']['tmp_name'];
	$fileSize  =  $_FILES['image_path']['size'];

	$name = $_POST['name'];
	$event_type = $_POST['event_type'];
	$loc_name = $_POST['loc_name'];
	$loc_address = $_POST['loc_address'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$instructions = $_POST['instructions'];
	$loc_website = $_POST['loc_website'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$price = $_POST['price'];
	$capacity = $_POST['capacity'];
	$description = $_POST['description'];
	$image_alt = $_POST['image_alt'];
	$signup = $_POST['signup'];

	//checked checkbox = "on", unchecked = NULL
	$signup = $signup === null ? 0 : ($signup === "on" ? 1 : 0);


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

			// if (!file_exists($upload_path . $file)) {

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
		// } else {
		//     $errorMSG = json_encode(array(
		//         "message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed",
		//         "status" => false
		//     ));
		//     echo $errorMSG;
		// }
	}

	$sql = "INSERT INTO events (id, name, event_type, loc_name, loc_address, latitude, longitude, instructions, loc_website, date, time, description, image_path, image_alt, price, capacity, signup) 
            VALUES (null, :name, :event_type, :loc_name, :loc_address, :latitude, :longitude, :instructions, :loc_website, :date, :time, :description, :image_path, :image_alt, :price, :capacity, :signup)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':event_type', $event_type);
	$stmt->bindParam(':loc_name', $loc_name);
	$stmt->bindParam(':loc_address', $loc_address);
	$stmt->bindParam(':latitude', $latitude);
	$stmt->bindParam(':longitude', $longitude);
	$stmt->bindParam(':instructions', $instructions);
	$stmt->bindParam(':loc_website', $loc_website);
	$stmt->bindParam(':date', $date);
	$stmt->bindParam(':time', $time);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':image_path', $file);
	$stmt->bindParam(':image_alt', $image_alt);
	$stmt->bindParam(':price', $price);
	$stmt->bindParam(':capacity', $capacity);
	$stmt->bindParam(':signup', $signup);
	if ($stmt->execute()) {
		$response = ['status' => 1, 'message' => "Event added sucessfully."];
	} else {
		$response = ['status' => 0, 'message' => "Could not add event."];
	}
	echo json_encode($response);
}
