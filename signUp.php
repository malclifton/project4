<?php
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];

if (empty($fname)) {
    die("First name required");
}
if (empty($lname)) {
    die("Last name required");
}

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Valid email address required");
}

if (strlen($username) < 6) {
    die("Username required");
}

if (strlen($password) < 6) {
    die("Password must be at least 6 characters");
}

if (! preg_match("/[a-zA-Z]/i", $password)) {
    die("Password must contain at least one letter");
}

if (! preg_match("/[0-9]/", $password)) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $cpassword) {
    die("Passwords must match");
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

//sql

$host = "localhost";
$user = "mclifton6";
$pass = "mclifton6";
$dbname = "mclifton6";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) { //generate error
    echo "Could not connect to server\n";
    die("connection failed: " . $conn->connect_error);
} else {
    echo "Connection established\n";
}
echo mysqli_get_server_info($conn) . "\n"; //returns server version

$stmt = $conn->prepare("INSERT INTO users2 (firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fname, $lname, $email, $username, $password_hash);

if ($stmt->execute()) {
    header("Location: ./signIn.html");
    exit;
} else {
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
