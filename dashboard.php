<?php

// Start a session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Sample data for demonstration
$welcomeMessage = 'Welcome to your Student Dashboard!';
$enrolledCourses = [
    'Course 1: Introduction to Programming',
    'Course 2: Data Structures',
    'Course 3: Web Development'
];
$progressTracking = [
    'Course 1' => '75%',
    'Course 2' => '50%',
    'Course 3' => '30%'
];

// Profile update form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Here you would handle the form submission, e.g., save to a database
    // For this example, we'll just simulate a profile update.
    $profileUpdateMessage = 'Profile updated successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <h1><?php echo $welcomeMessage; ?></h1>
    <h2>Enrolled Courses</h2>
    <ul>
        <?php foreach ($enrolledCourses as $course) { ?>
            <li><?php echo $course; ?></li>
        <?php } ?>
    </ul>
    <h2>Progress Tracking</h2>
    <ul>
        <?php foreach ($progressTracking as $course => $progress) { ?>
            <li><?php echo $course . ': ' . $progress; ?></li>
        <?php } ?>
    </ul>
    <h2>Update Profile</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <input type="submit" value="Update Profile">
    </form>
    <?php if (isset($profileUpdateMessage)) { ?>
        <p><?php echo $profileUpdateMessage; ?></p>
    <?php } ?>
</body>
</html>