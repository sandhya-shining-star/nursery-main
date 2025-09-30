<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form parameters
    $fullName = isset($_POST['name']) ? $_POST['name'] : null;
    $contactNumber = isset($_POST['contact']) ? $_POST['contact'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $deliveryAddress = isset($_POST['address']) ? $_POST['address'] : null;
    $plantName = isset($_POST['plant-name']) ? $_POST['plant-name'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $totalCost = isset($_POST['total-cost']) ? $_POST['total-cost'] : null;
    $deliveryDate = isset($_POST['delivery-date']) ? $_POST['delivery-date'] : null;
    $paymentMethod = isset($_POST['payment-method']) ? $_POST['payment-method'] : null;

    // Debugging: Print the form parameters
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Check if any required fields are missing
    if ($fullName && $contactNumber && $email && $deliveryAddress && $plantName && $quantity && $price && $totalCost && $deliveryDate && $paymentMethod) {
        // Database connection parameters
        $servername = 'localhost';
        $dbUsername = 'root';
        $dbPassword = 'Sandy@45#';
        $dbName = "GreenLeafNursery";

        // Connect to the database
        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert booking data into the bookings table
        $stmt = $conn->prepare("INSERT INTO bookings (full_name, contact_number, email, delivery_address, plant_name, quantity, price, total_cost, delivery_date, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssidsss", $fullName, $contactNumber, $email, $deliveryAddress, $plantName, $quantity, $price, $totalCost, $deliveryDate, $paymentMethod);
        
        if ($stmt->execute()) {
            header("Location: delivery.html");
            exit();
        } else {
            echo "<div class='modal'><div class='modal-content'><span class='close-button'>&times;</span><p>Error: " . $stmt->error . "</p></div></div>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<div class='modal'><div class='modal-content'><span class='close-button'>&times;</span><p>All form fields are required.</p></div></div>";
    }
}
?>
