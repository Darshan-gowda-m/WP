<!DOCTYPE html>
<html>
<head>
    <title>Server Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
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
        <tr>
            <td>Server Name</td>
            <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
        </tr>
        <tr>
            <td>Server Software</td>
            <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
        </tr>
        <tr>
            <td>Server Protocol</td>
            <td><?php echo $_SERVER['SERVER_PROTOCOL']; ?></td>
        </tr>
        <tr>
            <td>CGI Version</td>
            <td><?php echo php_sapi_name(); ?></td>
        </tr>
        <tr>
            <td>PHP Version</td>
            <td><?php echo phpversion(); ?></td>
        </tr>
    </table>
</body>
</html>
