    <?php
    //update events
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    include 'DbConnection.php';

    $objDb = new DbConnection;
    $conn = $objDb->connect();

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === "PUT") {
        $event = json_decode(file_get_contents('php://input'));

        $sql = "UPDATE events SET name=:name, loc_name=:loc_name, loc_address=:loc_address, loc_website=:loc_website, date=:date, time=:time, description=:description, image=:image, price=:price, capacity=:capacity WHERE id=:id";
        $path = explode('/', $_SERVER['REQUEST_URI']);

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $path[3]);

        $stmt->bindParam(':name', $event->name);
        $stmt->bindParam(':loc_name', $event->loc_name);
        $stmt->bindParam(':loc_address', $event->loc_address);
        $stmt->bindParam(':loc_website', $event->loc_website);
        $stmt->bindParam(':date', $event->date);
        $stmt->bindParam(':time', $event->time);
        $stmt->bindParam(':description', $event->description);
        $stmt->bindParam(':image', $event->image);
        $stmt->bindParam(':price', $event->price);
        $stmt->bindParam(':capacity', $event->capacity);
        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => "Event updated sucessfully."];
        } else {
            $response = ['status' => 0, 'message' => "Could not update event."];
        }
        echo json_encode($response);
    } else {
        echo "some error occured in update.php";
    }
