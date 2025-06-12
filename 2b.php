<?php
// File to store visitor data
$file = 'visitor_data.json';

// Load existing data or initialize
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    if (!is_array($data)) {
        $data = ['total_visits' => 0, 'unique_ips' => [], 'last_visit' => null];
    }
} else {
    $data = ['total_visits' => 0, 'unique_ips' => [], 'last_visit' => null];
}

// Get visitor IP
function getVisitorIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$visitorIP = getVisitorIP();
$isUnique = false;

// Check if visitor IP already recorded
if (!in_array($visitorIP, $data['unique_ips'])) {
    $data['unique_ips'][] = $visitorIP;
    $isUnique = true;
}

$data['total_visits']++;
$data['last_visit'] = date('Y-m-d H:i:s');

// Save updated data back to file
file_put_contents($file, json_encode($data));

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Enhanced Visitor Tracker</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #eef2f7;
        margin: 40px;
        text-align: center;
        color: #333;
    }
    h1 {
        font-size: 2.8em;
        margin-bottom: 0.1em;
        color: #2a9d8f;
    }
    .info-box {
        background: white;
        margin: 20px auto;
        padding: 25px 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        max-width: 400px;
    }
    .label {
        font-weight: 600;
        font-size: 1.1em;
        margin-top: 15px;
        color: #555;
    }
    .value {
        font-size: 2.2em;
        font-weight: bold;
        margin-top: 5px;
        color: #264653;
    }
    .unique {
        color: #e76f51;
    }
    .last-visit {
        font-size: 1em;
        margin-top: 10px;
        color: #6c757d;
        font-style: italic;
    }
</style>
</head>
<body>

<h1>Welcome to Our Website!</h1>

<div class="info-box">
    <div class="label">Total Visits:</div>
    <div class="value"><?php echo $data['total_visits']; ?></div>

    <div class="label unique">Unique Visitors:</div>
    <div class="value unique"><?php echo count($data['unique_ips']); ?></div>

    <div class="last-visit">Last Visit: <?php echo htmlspecialchars($data['last_visit']); ?></div>

    <div style="margin-top:20px; font-weight:600; color: <?php echo $isUnique ? '#2a9d8f' : '#888'; ?>">
        <?php
        if ($isUnique) {
            echo "Thank you for visiting for the first time! 👋";
        } else {
            echo "Welcome back! 😊";
        }
        ?>
    </div>
</div>

</body>
</html>
