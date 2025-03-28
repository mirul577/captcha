<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP CAPTCHA Form</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .captcha-img { margin-top: 10px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<h2>Simple CAPTCHA Form</h2>

<form action="submit.php" method="POST">
    <label for="name">Enter Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Enter CAPTCHA:</label><br>
    <img src="captcha.php" alt="CAPTCHA Image" class="captcha-img"><br>
    <input type="text" name="captcha" required><br><br>

    <input type="submit" value="Submit">
</form>

<?php
// Display result message if set
if (isset($_SESSION['captcha_result'])) {
    echo '<p class="' . ($_SESSION['captcha_result'] ? 'success' : 'error') . '">'
        . $_SESSION['captcha_message'] . '</p>';
    unset($_SESSION['captcha_result'], $_SESSION['captcha_message']);
}
?>

</body>
</html>
