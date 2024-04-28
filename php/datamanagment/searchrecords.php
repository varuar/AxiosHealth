//I certify that this submission is my own original work-Alvin Varughese

<?php

include('../config/dbConnect.php');

$searchQuery = "";
$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $searchQuery = trim($_POST['searchQuery']);

    $stmt = $conn->prepare("SELECT id, name, age, `condition`, reg_date FROM patients WHERE name LIKE ?");
    $likeQuery = "%".$searchQuery."%";
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient Records</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Search Patient Records</h2>
        <form action="" method="post">
            <label for="searchQuery">Search:</label>
            <input type="text" name="searchQuery" id="searchQuery" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <input type="submit" name="search" value="Search">
        </form>
        
        <div class="search-results">
            <?php if (!empty($searchResults)): ?>
                <h3>Search Results:</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Condition</th>
                        <th>Registered</th>
                    </tr>
                    <?php foreach ($searchResults as $result): ?>
                        <tr>
                            <td><?php echo $result['id']; ?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['age']; ?></td>
                            <td><?php echo $result['condition']; ?></td>
                            <td><?php echo $result['reg_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
