//I certify that this submission is my own original work-Alvin Varughese

<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../auth/login.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu - Axios-Health Portal</title>
    <link rel="stylesheet" href="../../CSS/styles.css">
</head>
<body>
    <header>
        <h1>Welcome to the Axios-Health Main Menu</h1>
    </header>
    <div class="container">
        <p>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</p>
        <ul>
            <li><a href="../datamanagment/addrecord.php">Add Patient Record</a></li>
            <li><a href="../datamanagment/listrecords.php">View Patient Records</a></li>
            <li><a href="../datamanagment/searchrecords.php">Search Patient Records</a></li>
            <li><a href="../../auth/logout.php">Log Out</a></li>
        </ul>
    </div>
</body>
</html>
