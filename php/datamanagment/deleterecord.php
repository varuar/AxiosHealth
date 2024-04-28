//I certify that this submission is my own original work-Alvin Varughese

<?php
include('../config/dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Invalid request.";
}
?>
