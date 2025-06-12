<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";  // Update this if you have a DB password
$dbname = "library_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$message = "";
$editing = false;
$edit_data = [
    'accession_number' => '',
    'title' => '',
    'author' => '',
    'edition' => '',
    'publication' => ''
];

// Handle Delete Request
if (isset($_GET['delete'])) {
    $del_acc = $conn->real_escape_string($_GET['delete']);
    if (!$conn->query("DELETE FROM books WHERE accession_number='$del_acc'")) {
        $message = "Error deleting book: " . $conn->error;
    } else {
        header("Location: " . basename($_SERVER['PHP_SELF']));
        exit;
    }
}

// Handle Edit Request - show form filled with data
if (isset($_GET['edit'])) {
    $edit_acc = $conn->real_escape_string($_GET['edit']);
    $result = $conn->query("SELECT * FROM books WHERE accession_number='$edit_acc'");
    if ($result && $result->num_rows == 1) {
        $edit_data = $result->fetch_assoc();
        $editing = true;
    } else {
        $message = "Book not found for editing.";
    }
}

// Handle form submission (Add or Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accession_number = trim($_POST['accession_number']);
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $edition = trim($_POST['edition']);
    $publication = trim($_POST['publication']);

    // Validation
    if (!$accession_number || !$title || !$author) {
        $message = "Accession Number, Title and Author are required.";
    } elseif (!preg_match('/^[a-zA-Z0-9\-]+$/', $accession_number)) {
        $message = "Accession Number can only contain letters, numbers, and hyphens.";
    } else {
        if (isset($_POST['editing']) && $_POST['editing'] == 'yes') {
            // UPDATE existing
            $stmt = $conn->prepare("UPDATE books SET title=?, author=?, edition=?, publication=? WHERE accession_number=?");
            $stmt->bind_param("sssss", $title, $author, $edition, $publication, $accession_number);
            if ($stmt->execute()) {
                $message = "Book updated successfully!";
                $editing = false;
                $edit_data = ['accession_number' => '', 'title' => '', 'author' => '', 'edition' => '', 'publication' => ''];
            } else {
                $message = "Error updating book: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // INSERT new
            $check = $conn->query("SELECT accession_number FROM books WHERE accession_number='$accession_number'");
            if ($check && $check->num_rows > 0) {
                $message = "Error: Accession Number already exists.";
            } else {
                $stmt = $conn->prepare("INSERT INTO books (accession_number, title, author, edition, publication) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $accession_number, $title, $author, $edition, $publication);
                if ($stmt->execute()) {
                    $message = "Book added successfully!";
                    $accession_number = $title = $author = $edition = $publication = '';
                } else {
                    $message = "Error adding book: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}

// Fetch all books to display
$result = $conn->query("SELECT * FROM books ORDER BY accession_number ASC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Management</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: auto; padding: 20px; }
        h2 { color: #333; }
        form { border: 1px solid #ccc; padding: 20px; border-radius: 5px; margin-bottom: 30px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type=text] { width: 100%; padding: 8px; box-sizing: border-box; }
        input[type=submit], input[type=button] { margin-top: 15px; padding: 10px 15px; }
        .message { margin-top: 15px; font-weight: bold; color: green; }
        .error { color: red; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f4f4f4; }
        a { text-decoration: none; color: #007BFF; }
        a:hover { text-decoration: underline; }
    </style>
    <script>
        function confirmDelete(acc) {
            if(confirm("Are you sure you want to delete book with Accession Number: " + acc + "?")) {
                window.location.href = "<?= basename($_SERVER['PHP_SELF']) ?>?delete=" + encodeURIComponent(acc);
            }
        }
    </script>
</head>
<body>

<h2><?= $editing ? "Edit Book" : "Add Book" ?></h2>

<?php if ($message): ?>
    <div class="message <?= strpos($message, 'Error') !== false ? 'error' : '' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<form method="post" action="">
    <label for="accession_number">Accession Number (unique)*:</label>
    <input type="text" id="accession_number" name="accession_number" required
           value="<?= htmlspecialchars($edit_data['accession_number']) ?>"
           <?= $editing ? "readonly" : "" ?>>

    <label for="title">Title*:</label>
    <input type="text" id="title" name="title" required value="<?= htmlspecialchars($edit_data['title']) ?>">

    <label for="author">Author*:</label>
    <input type="text" id="author" name="author" required value="<?= htmlspecialchars($edit_data['author']) ?>">

    <label for="edition">Edition:</label>
    <input type="text" id="edition" name="edition" value="<?= htmlspecialchars($edit_data['edition']) ?>">

    <label for="publication">Publication:</label>
    <input type="text" id="publication" name="publication" value="<?= htmlspecialchars($edit_data['publication']) ?>">

    <?php if ($editing): ?>
        <input type="hidden" name="editing" value="yes">
        <input type="submit" value="Update Book">
        <input type="button" value="Cancel" onclick="window.location.href='<?= basename($_SERVER['PHP_SELF']) ?>';">
    <?php else: ?>
        <input type="submit" value="Add Book">
    <?php endif; ?>
</form>

<h2>All Books</h2>

<?php if ($result && $result->num_rows > 0): ?>
<table>
    <thead>
    <tr>
        <th>Accession Number</th>
        <th>Title</th>
        <th>Author</th>
        <th>Edition</th>
        <th>Publication</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['accession_number']) ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['author']) ?></td>
        <td><?= htmlspecialchars($row['edition']) ?></td>
        <td><?= htmlspecialchars($row['publication']) ?></td>
        <td>
            <a href="<?= basename($_SERVER['PHP_SELF']) ?>?edit=<?= urlencode($row['accession_number']) ?>">Edit</a> |
            <a href="javascript:void(0);" onclick="confirmDelete('<?= htmlspecialchars($row['accession_number']) ?>')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
<p>No books found.</p>
<?php endif; ?>

<?php $conn->close(); ?>
</body>
</html>
