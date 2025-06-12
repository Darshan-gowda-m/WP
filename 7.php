<?php
// DB connection settings
$servername = "localhost";
$username = "root";
$password = "";  // Your MySQL password here
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$searchBy = isset($_GET['searchBy']) ? $_GET['searchBy'] : '';
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
$results = null;

if ($searchBy && $searchTerm) {
    // Whitelist allowed columns to prevent SQL injection
    $allowedColumns = ['name', 'email'];
    if (!in_array($searchBy, $allowedColumns)) {
        die("Invalid search criteria.");
    }
    
    // Prepare statement to avoid injection
    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE $searchBy LIKE ?");
    $likeTerm = "%".$searchTerm."%";
    $stmt->bind_param("s", $likeTerm);
    $stmt->execute();
    $results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Users</title>
    <style>
        table { border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>

<h2>Search Users</h2>

<form method="get" action="">
    <label for="searchBy">Search By:</label>
    <select id="searchBy" name="searchBy" required>
        <option value="">--Select--</option>
        <option value="name" <?= $searchBy == 'name' ? 'selected' : '' ?>>Name</option>
        <option value="email" <?= $searchBy == 'email' ? 'selected' : '' ?>>Email</option>
    </select>

    <label for="searchTerm">Search Term:</label>
    <input type="text" id="searchTerm" name="searchTerm" value="<?= htmlspecialchars($searchTerm) ?>" required>

    <input type="submit" value="Search">
</form>

<?php if ($results): ?>
    <?php if ($results->num_rows > 0): ?>
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
            <?php while ($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No matching users found.</p>
    <?php endif; ?>
<?php elseif ($_GET): ?>
    <p>Please enter search criteria.</p>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
