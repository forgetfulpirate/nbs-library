<?php
// Check if the request is coming via AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Start session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION["username"])) {
        // User is not logged in, return error response
        http_response_code(401);
        echo json_encode(["error" => "User not authenticated"]);
        exit();
    }

    // Include database connection
    include 'inc/connection.php';

    // Retrieve form data
    $recipient = $_POST["rusername"];
    $title = $_POST["title"];
    $message = $_POST["msg"];
    $sender = $_SESSION["username"];

    // Perform any additional validation here (e.g., check if fields are not empty)

    // Insert message into database
    $query = "INSERT INTO messages (sender, recipient, title, message) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $sender, $recipient, $title, $message);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($success) {
        // Message sent successfully, return success response
        echo json_encode(["success" => "Message sent successfully"]);
    } else {
        // Failed to send message, return error response
        http_response_code(500);
        echo json_encode(["error" => "Failed to send message"]);
    }
} else {
    // Request is not via AJAX, return error response
    http_response_code(400);
    echo json_encode(["error" => "Bad request"]);
}
?>
