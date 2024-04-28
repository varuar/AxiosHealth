//I certify that this submission is my own original work-Alvin Varughese

<?php
include('dbConnect.php');

$usersSql = "CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
)";

if ($conn->query($usersSql) === TRUE) {
    echo "Table 'users' created successfully. ";
} else {
    echo "Error creating table 'users': " . $conn->error;
}

$patientsSql = "CREATE TABLE IF NOT EXISTS patients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  age INT NOT NULL,
  condition TEXT,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($patientsSql) === TRUE) {
    echo "Table 'patients' created successfully.";
} else {
    echo "Error creating table 'patients': " . $conn->error;
}

$conn->close();
?>
