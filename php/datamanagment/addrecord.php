<?php
//I certify that this submission is my own original work-Alvin Varughese

session_start();
include('../config/dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $age = $conn->real_escape_string($_POST['age']);
    $condition = $conn->real_escape_string($_POST['condition']);

    $user_id = $_SESSION["id"];

    $stmt = $conn->prepare("INSERT INTO patients (name, age, `condition`, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $name, $age, $condition, $user_id);

    if ($stmt->execute()) {
        echo "<p>Record added successfully.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Patient Record</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h2>Add Patient Record</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required><br>
        
        <label for="condition">Condition:</label>
        <textarea name="condition" id="condition" required></textarea><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
