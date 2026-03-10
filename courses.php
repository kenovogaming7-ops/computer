<?php

// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search functionality
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Filtering by category
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Pagination variables
$limit = 10; // courses per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// SQL query to fetch courses
$sql = "SELECT * FROM courses WHERE
    (course_name LIKE '%$searchQuery%' OR course_description LIKE '%$searchQuery%')
    AND (category = '$categoryFilter' OR '$categoryFilter' = '')
    LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Total courses for pagination
$totalSql = "SELECT COUNT(*) as total FROM courses WHERE
    (course_name LIKE '%$searchQuery%' OR course_description LIKE '%$searchQuery%')
    AND (category = '$categoryFilter' OR '$categoryFilter' = '')";
$totalResult = $conn->query($totalSql);
$totalCourses = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalCourses / $limit);

// Fetching all categories for filtering
$categoriesSql = "SELECT DISTINCT category FROM courses";
$categoriesResult = $conn->query($categoriesSql);

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Listing</title>
</head>
<body>
    <h1>Course Listing</h1>
    <form method="GET" action="courses.php">
        <input type="text" name="search" placeholder="Search courses..." value="<?php echo htmlspecialchars($searchQuery); ?>">
        <select name="category">
            <option value="">All Categories</option>
            <?php while ($category = $categoriesResult->fetch_assoc()): ?>
                <option value="<?php echo $category['category']; ?>" <?php echo $categoryFilter == $category['category'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['category']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Search</button>
    </form>

    <ul>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($course = $result->fetch_assoc()): ?>
                <li>
                    <h2><?php echo htmlspecialchars($course['course_name']); ?></h2>
                    <p><?php echo htmlspecialchars($course['course_description']); ?></p>
                    <button onclick="enroll(<?php echo $course['id']; ?>)">Enroll</button>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No courses found.</li>
        <?php endif; ?>
    </ul>

    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchQuery); ?>&category=<?php echo urlencode($categoryFilter); ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>

</body>
</html>
