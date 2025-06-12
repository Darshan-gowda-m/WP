<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // leave empty if no password set
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Insert data if form submitted
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($conn->real_escape_string($_POST['name']));
    $email = trim($conn->real_escape_string($_POST['email']));

    if (!empty($name) && !empty($email)) {
        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        if ($conn->query($sql) === TRUE) {
            $msg = "✅ User added successfully!";
        } else {
            $msg = "❌ Error adding user: " . $conn->error;
        }
    } else {
        $msg = "⚠️ Please enter both name and email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form, table { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        .message { padding: 10px; background: #f0f0f0; margin-bottom: 15px; }
    </style>
</head>
<body>

<h2>Add New User</h2>

<?php if ($msg): ?>
    <div class="message"><?php echo $msg; ?></div>
<?php endif; ?>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>
    
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    
    <input type="submit" value="Add User">
</form>

<hr>

<h2>Current Users</h2>

<?php
// Fetch and display users
$sql = "SELECT id, name, email FROM users ORDER BY id DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0):
?>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row["id"]); ?></td>
            <td><?php echo htmlspecialchars($row["name"]); ?></td>
            <td><?php echo htmlspecialchars($row["email"]); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
