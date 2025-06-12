<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Digital Lock Clock</title>
<style>
  body {
    background: #222;
    color: #0f0;
    font-family: 'Courier New', Courier, monospace;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .digital-lock {
    background: #000;
    border: 5px solid #0f0;
    border-radius: 12px;
    padding: 40px 60px;
    box-shadow: 0 0 20px #0f0, inset 0 0 10px #0f0;
    font-size: 4rem;
    letter-spacing: 12px;
    user-select: none;
    text-align: center;
    width: 400px;
  }
</style>
</head>
<body>

<div class="digital-lock" id="clock">
  <?php
  // Set timezone
  date_default_timezone_set('Asia/Kolkata');

  // Initial time display (in 24-hour format)
  echo date('H : i : s');
  ?>
</div>

<script>
  function updateClock() {
    const clockDiv = document.getElementById('clock');

    // Fetch current time from client
    const now = new Date();

    // Format time as HH : MM : SS with leading zeros
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');

    clockDiv.textContent = `${hours} : ${minutes} : ${seconds}`;
  }

  // Update clock every second
  setInterval(updateClock, 1000);
  updateClock(); // Initial call
</script>

</body>
</html>
