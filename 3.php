<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Time-Based Greeting</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f0f8ff;
        color: #333;
        text-align: center;
        padding-top: 100px;
    }
    h1 {
        font-size: 3em;
        margin-bottom: 0.3em;
        color: #2a9d8f;
    }
    p {
        font-size: 1.4em;
        color: #555;
    }
</style>
</head>
<body>

<?php
// Set your timezone here (change as needed)
date_default_timezone_set('Asia/Kolkata');

// Get current hour (0-23)
$hour = (int)date('H');

// Determine greeting based on hour
if ($hour < 12) {
    $greeting = "Good Morning!";
} elseif ($hour < 18) {
    $greeting = "Good Afternoon!";
} else {
    $greeting = "Good Evening!";
}
?>

<h1><?php echo $greeting; ?></h1>
<p>Welcome to our website. Have a wonderful day!</p>

</body>
</html>
