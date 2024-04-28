//I certify that this submission is my own original work-Alvin Varughese

<?php
session_start();
include('../config/dbConnect.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: ../datamanagment/mainmenu.php");
    exit;
}

$login_err = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;

            header("location: ../datamanagment/mainmenu.php");
            exit;
        } else {
            $login_err = "Invalid username or password.";
        }
    } else {
        $login_err = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (!empty($login_err)) {
        echo '<div>' . $login_err . '</div>';
    }
    ?>
<form action="login.php" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
