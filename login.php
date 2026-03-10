<?php
session_start();

// Placeholder user credentials (for demonstration purpose only)
$stored_email = "user@example.com";
$stored_password = password_hash("password123", PASSWORD_DEFAULT); // The hashed password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    // Authentication check
    if ($email == $stored_email && password_verify($password, $stored_password)) {
        $_SESSION['email'] = $email;
        
        if ($remember_me) {
            // Set a cookie that lasts for 30 days
            setcookie("email", $email, time() + (30 * 24 * 60 * 60), "/");
        }

        header("Location: welcome.php"); // Redirect to a welcome page
        exit();
    } else {
        $error = "Invalid email or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <label for="remember_me">
            <input type="checkbox" name="remember_me"> Remember me
        </label>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
