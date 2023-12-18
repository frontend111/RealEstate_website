<?php
session_start(); // Start session to manage user sessions

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "log_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php"); // Redirect to dashboard or home page
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "Invalid username";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Login">
</form>

<?php
if (isset($error)) {
    echo "<p>$error</p>";
}
?>


<?php
session_start(); // Start session to access session variables

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>

</body>
</html>
