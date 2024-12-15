<?php
// Database connection settings
$servername = "localhost";
$username = "root";  // Default MySQL username for XAMPP
$password = "";      // Default MySQL password for XAMPP
$dbname = "contact_form";  // The database name you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into the database
    $sql = "INSERT INTO messages (name, email, phone, subject, location, message) 
            VALUES ('$name', '$email', '$phone', '$subject', '$location', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
