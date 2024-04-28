//I certify that this submission is my own original work-Alvin Varughese
<?php
session_start();
include('../config/dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit; 
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Username already exists";
        exit; 
    }
    $stmt->close();

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Email already exists";
        exit; 
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <h2>Registration Form</h2>
        <form action="" method="post" onsubmit="return validateForm()">
            Username: <input type="text" name="username" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            Confirm Password: <input type="password" name="confirm_password" required><br>
            <input type="submit" value="Register">
        </form>
        <script>
            function validateForm() {
                let username = document.forms["registerForm"]["username"].value;
                let email = document.forms["registerForm"]["email"].value;
                let password = document.forms["registerForm"]["password"].value;
                let confirm_password = document.forms["registerForm"]["confirm_password"].value;

                if (username.length < 6) {
                    alert("Username must be at least 6 characters long");
                    return false;
                }

                let email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email_regex.test(email)) {
                    alert("Invalid email format");
                    return false;
                }

                if (password.length < 8 || !/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
                    alert("Password must be at least 8 characters long and contain at least one digit and one letter");
                    return false;
                }

                if (password !== confirm_password) {
                    alert("Passwords do not match");
                    return false;
                }

                return true;
            }
        </script>
    </body>
    </html>
    <?php
}
?>
