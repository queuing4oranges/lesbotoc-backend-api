<?php
//index.php for contacts
header("Access-Control-Allow-Origin: *");  //solving CORS issue
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnection.php';

$objDb = new DbConnection;
$conn = $objDb->connect();
// var_dump($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        $sql = "SELECT * FROM contacts";
        $path = explode('/', $_SERVER['REQUEST_URI']);
        // print_r($path);

        if (isset($path[2]) && is_numeric($path[2])) {
            $sql .= " WHERE id=:id"; //concatenate to SELECT with space before WHERE!
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $path[2]);
            $stmt->execute();
            $contacts = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($contacts);
        break;

    case "POST":
        $contact = json_decode(file_get_contents('php://input'));
        $sql = "INSERT INTO contacts(id, name, email, phone) VALUES (null, :name, :email, :phone)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $contact->name);
        $stmt->bindParam(':email', $contact->email);
        $stmt->bindParam(':phone', $contact->phone);
        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => "Contact added sucessfully."];
        } else {
            $response = ['status' => 0, 'message' => "Could not add contact."];
        }
        echo json_encode($response);
        break;

    case "PUT":
        $contact = json_decode(file_get_contents('php://input'));
        $sql = "UPDATE contacts SET name=:name, email=:email, phone=:phone WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $contact->id);
        $stmt->bindParam(':name', $contact->name);
        $stmt->bindParam(':email', $contact->email);
        $stmt->bindParam(':phone', $contact->phone);
        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => "Contact updated sucessfully."];
        } else {
            $response = ['status' => 0, 'message' => "Could not update contact."];
        }
        echo json_encode($response);
        break;

    case "DELETE":
        $sql = "DELETE FROM contacts WHERE id=:id";
        $path = explode('/', $_SERVER['REQUEST_URI']); //finding id with explode method

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $path[1]);

        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => "Contact deleted sucessfully."];
        } else {
            $response = ['status' => 0, 'message' => "Could not delete contact."];
        }
        echo json_encode($response);
        break;
}
