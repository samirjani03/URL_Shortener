<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "url_shortener";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['code'])) {
    $short_url = $_GET['code'];
    $stmt = $conn->prepare("SELECT long_url FROM urls WHERE short_url = ?");
    $stmt->bind_param("s", $short_url);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header("Location: " . $row['long_url']);
        exit();
    } else {
        echo "URL not found.";
    }
}

$conn->close();
?>
