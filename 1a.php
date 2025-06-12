<!DOCTYPE html>
<html>
<head>
    <title>Server Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h1>Server Information</h1>

<table>
    <tr>
        <th>Parameter</th>
        <th>Value</th>
    </tr>
    <?php
    $info = [
        "Server Name"         => $_SERVER['SERVER_NAME'] ?? 'N/A',
        "Server Software"     => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
        "Server Protocol"     => $_SERVER['SERVER_PROTOCOL'] ?? 'N/A',
        "CGI Version"         => php_sapi_name(),
        "PHP Version"         => phpversion(),
        "Document Root"       => $_SERVER['DOCUMENT_ROOT'] ?? 'N/A',
        "Server Admin"        => $_SERVER['SERVER_ADMIN'] ?? 'N/A',
        "Server IP Address"   => $_SERVER['SERVER_ADDR'] ?? 'N/A',
        "Server Port"         => $_SERVER['SERVER_PORT'] ?? 'N/A',
        "Request Method"      => $_SERVER['REQUEST_METHOD'] ?? 'N/A',
        "Script Filename"     => $_SERVER['SCRIPT_FILENAME'] ?? 'N/A',
        "Remote IP (Client)"  => $_SERVER['REMOTE_ADDR'] ?? 'N/A',
        "Remote Host"         => $_SERVER['REMOTE_HOST'] ?? 'N/A',
        "HTTPS"               => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'On' : 'Off',
        "User Agent"          => $_SERVER['HTTP_USER_AGENT'] ?? 'N/A',
        "Query String"        => $_SERVER['QUERY_STRING'] ?? 'N/A',
    ];

    foreach ($info as $key => $value) {
        echo "<tr><td>" . htmlspecialchars($key) . "</td><td>" . htmlspecialchars($value) . "</td></tr>";
    }
    ?>
</table>

</body>
</html>
