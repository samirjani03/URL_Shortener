
<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "url_shortener";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT long_url, short_url FROM urls ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL History</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="container">
        <h1>Shortened URL History</h1>
        <table>
            <thead>
                <tr>
                    <th>Original URL</th>
                    <th>Shortened URL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $short_url = "http://localhost/strl/" . $row['short_url'];
                        echo "<tr>";
                        echo "<td>" . substr($row['long_url'], 0, 50) . "...</td>";
                        echo "<td><a href='" . $short_url . "' target='_blank'>" . $short_url . "</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No history available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button onclick="window.location.href='index.html'">Back to Home</button>
    </div>
</body>
</html>

<?php $conn->close(); ?>
