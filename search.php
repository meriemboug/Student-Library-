<?php
// Database connection
$host = 'localhost'; // or your database host
$dbname = 'elibrary';
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

// Search the database
$sql = "SELECT * FROM resources WHERE title LIKE '%$query%' OR description LIKE '%$query%'";
$result = $conn->query($sql);

// Display results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
    <ul>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <a href="<?php echo $row['link']; ?>"><?php echo $row['title']; ?></a>
                    <p><?php echo $row['description']; ?></p>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No results found.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
<?php
// Close the connection
$conn->close();
?>
