<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = trim($_POST["captcha"]);
    $name = trim($_POST["name"]);
    $correct_captcha = $_SESSION["captcha"] ?? '';

    if (strcasecmp($user_input, $correct_captcha) == 0) {
        $_SESSION['captcha_result'] = true;
        $_SESSION['captcha_message'] = "✅ Hello, $name! CAPTCHA matched successfully.";
    } else {
        $_SESSION['captcha_result'] = false;
        $_SESSION['captcha_message'] = "❌ CAPTCHA did not match. Please try again.";
    }

    // Clear the old CAPTCHA to prevent reuse
    unset($_SESSION['captcha']);
    header("Location: form.php");
    exit;
}
?>
