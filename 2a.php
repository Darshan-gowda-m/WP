<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Warm Welcome</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        width: 350px;
        text-align: center;
    }
    h1 {
        margin-bottom: 20px;
        color: #333;
    }
    input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        font-size: 16px;
        border: 2px solid #ddd;
        border-radius: 8px;
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }
    input[type="text"]:focus {
        border-color: #74ebd5;
        outline: none;
    }
    input[type="submit"] {
        margin-top: 20px;
        background: #74ebd5;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        transition: background 0.3s ease;
    }
    input[type="submit"]:hover {
        background: #4ca1af;
    }
    .greeting {
        margin-top: 25px;
        font-size: 20px;
        color: #333;
        font-weight: 600;
        line-height: 1.4;
    }
    .greeting span.sparkle {
        color: #f39c12;
        font-weight: 900;
        font-size: 24px;
        animation: sparkle 1.5s infinite alternate;
        display: inline-block;
        margin-left: 5px;
    }
    @keyframes sparkle {
        0% { text-shadow: 0 0 5px #f39c12; }
        100% { text-shadow: 0 0 15px #f1c40f; }
    }
    .error {
        margin-top: 15px;
        color: #d9534f;
        font-weight: 600;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Say Hello!</h1>
    <form method="post" novalidate>
        <input type="text" name="username" placeholder="Enter your lovely name" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required />
        <input type="submit" value="Greet Me" />
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');

        if ($username === '') {
            echo '<div class="error">Oops! Please share your name so we can greet you warmly.</div>';
        } else {
            $safeName = htmlspecialchars($username);
            echo "<div class='greeting'>✨ Hello, <strong>$safeName</strong>! <br>We're absolutely delighted to have you here. Wishing you a wonderful day filled with joy and success! <span class='sparkle'>✨</span></div>";
        }
    }
    ?>
</div>

</body>
</html>
