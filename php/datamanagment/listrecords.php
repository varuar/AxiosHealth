//I certify that this submission is my own original work-Alvin Varughese

<?php
include('../config/dbConnect.php');

$sql = "SELECT id, name, age, `condition`, reg_date FROM patients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Display each record in a structured format
        echo "ID: " . $row["id"]. "<br>";
        echo "Name: " . $row["name"]. "<br>";
        echo "Age: " . $row["age"]. "<br>";
        echo "Condition: " . $row["condition"]. "<br>";
        echo "Registered Date: " . $row["reg_date"]. "<br>";
        echo "<br>"; 
    }
} else {
    echo "0 results"; 
}

$conn->close();
?>
