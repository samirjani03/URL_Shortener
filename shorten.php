<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "url_shortener";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function generateShortCode($length = 6) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['long_url'])) {
    $long_url = $_POST['long_url'];
    $short_url = generateShortCode();

    $stmt = $conn->prepare("INSERT INTO urls (long_url, short_url) VALUES (?, ?)");
    $stmt->bind_param("ss", $long_url, $short_url);
    $stmt->execute();
?><style>

button {
    width: auto;
    margin-top: 20px;
    background-color: #008CBA;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover{
    background-color: #007B9E;
}
.code-block {
    display: flex;
    align-items: center;
    background-color: #f5f5f5;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: fit-content;
    margin-top: 15px;
}

.code-block input[type="text"] {
    border: none;
    background-color: #f5f5f5;
    font-family: monospace;
    font-size: 1rem;
    padding: 5px;
    width: 250px;
    overflow: hidden;
}

.code-block input[type="text"]:focus {
    outline: none;
}

.code-block button {
    background-color: #008CBA;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
    transition: background-color 0.3s;
}

.code-block button:hover {
    background-color: #007B9E;
}
    
</style>

<button onclick="window.location.href='index.html'">Back to Home</button>
<button style="float:right" onclick="window.location.href='history.php'">View History</button>
<br><br>
<?php

    echo "\n\n\n\n\nShort URL: <a href='redirect.php?code=$short_url' target='_blank'>http://localhost/url_shortener/redirect.php?code=$short_url</a>";
}
?>

<div class="code-block" >
    <input type="text" id="shortUrl" value="
    <?php $output="http://localhost/url_shortener/redirect.php?code=".$short_url; 
    echo $output;
    ?>" readonly>
    <button onclick="copyToClipboard()">Copy URL</button>
</div>
<!-- <div class="code-block">
    <input type="text" id="shortUrl" value="<?php echo $short_url; ?>" readonly>
    <button onclick="copyToClipboard()">Copy URL</button>
</div> -->

<script>
    function copyToClipboard() {
    const copyText = document.getElementById("shortUrl");
    copyText.select();
    copyText.setSelectionRange(0, 99999); 
    document.execCommand("copy");

    alert("Copied the URL: " + copyText.value);
}

</script>
<?php
$conn->close();
?>
