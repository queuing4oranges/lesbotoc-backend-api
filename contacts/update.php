    <?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    include 'DbConnection.php';

    $objDb = new DbConnection;
    $conn = $objDb->connect();

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === "PUT") {
        $contact = json_decode(file_get_contents('php://input'));

        $sql = "UPDATE contacts SET name=:name, wherefrom=:wherefrom, email=:email, phone=:phone, age=:age, newsletter=:newsletter WHERE id=:id";
        $path = explode('/', $_SERVER['REQUEST_URI']);

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $path[3]);

        $stmt->bindParam(':name', $contact->name);
        $stmt->bindParam(':wherefrom', $contact->wherefrom);
        $stmt->bindParam(':email', $contact->email);
        $stmt->bindParam(':phone', $contact->phone);
        $stmt->bindParam(':age', $contact->age);
        $stmt->bindParam(':newsletter', $contact->newsletter);
        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => "Contact updated sucessfully."];
        } else {
            $response = ['status' => 0, 'message' => "Could not update contact."];
        }
        echo json_encode($response);
    } else {
        echo "some error occured";
    }
