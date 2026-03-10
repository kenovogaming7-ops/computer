<?php

// Initialize variables for the contact form
$name = $email = $message = '';
$name_err = $email_err = $message_err = '';

// Validate form data on post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['name']))) {
        $name_err = 'Please enter your name.';
    } else {
        $name = trim($_POST['name']);
    }

    if (empty(trim($_POST['email']))) {
        $email_err = 'Please enter your email.';
    } elseif (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $email_err = 'Invalid email format.';
    } else {
        $email = trim($_POST['email']);
    }

    if (empty(trim($_POST['message']))) {
        $message_err = 'Please enter a message.';
    } else {
        $message = trim($_POST['message']);
    }

    // If no errors, save to database (pseudo-code for the database)
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        // Database insertion would go here
        // Example: insert into contacts (name, email, message) values (?, ?, ?)
    }
}

// Fetch contacts from database (pseudo-code)
$contacts = []; // Fetch contacts from database
// Example: SELECT name, email, message FROM contacts

?><!-- HTML form to collect contacts -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
</head>
<body>
    <h1>Contact Us</h1>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <span><?php echo $name_err; ?></span><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span><?php echo $email_err; ?></span><br>

        <label for="message">Message:</label><br>
        <textarea name="message"><?php echo htmlspecialchars($message); ?></textarea>
        <span><?php echo $message_err; ?></span><br><br>

        <input type="submit" value="Send">
    </form>

    <h2>Contact Messages</h2>
    <ul>
        <?php foreach ($contacts as $contact): ?>
            <li><?php echo htmlspecialchars($contact['name']) . ': ' . htmlspecialchars($contact['message']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>