<?php
// Include the database connection
include('db.php');   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $resource_name = $_POST['resource-name'];
    $resource_author = $_POST['resource-author'];
    $resource_category = $_POST['resource-category'];
    $resource_description = $_POST['resource-description'];

    // File upload handling
    $file = $_FILES['resource-file'];
    $file_name = basename($file['name']);
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

    // Check for allowed file types
    $allowed_extensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt'];
    if (!in_array(strtolower($file_type), $allowed_extensions)) {
        echo "Invalid file type. Only PDF, DOC, DOCX, PPT, PPTX, TXT are allowed.";
        exit;
    }

    // Check file size (max 5MB)
    if ($file_size > 5 * 1024 * 1024) {  // 5MB
        echo "File is too large. Maximum allowed size is 5MB.";
        exit;
    }

    // Define the upload folder
    $upload_dir = 'uploads/';

    // Check if the upload directory exists, if not, create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);  // Create the directory with read/write/execute permissions
    }

    // Define the file path for saving the uploaded file
    $file_path = $upload_dir . $file_name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file_tmp_name, $file_path)) {
        // Prepare SQL query to insert data into the resources table
        $sql = "INSERT INTO resources (ResourceName, Author, CategoryID, Description, FilePath, FileType, FileSize)
                VALUES ('$resource_name', '$resource_author', '$resource_category', '$resource_description', '$file_path', '$file_type', '$file_size')";

        // Execute the query and check for success
        if ($conn->query($sql) === TRUE) {
            echo "Resource uploaded successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the file.";
    }
}

// Close the database connection
$conn->close();
?>
<?php
include('db.php');   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $resource_name = $_POST['resource-name'];
    $resource_author = $_POST['resource-author'];
    $resource_category = $_POST['resource-category'];
    $resource_description = $_POST['resource-description'];

    // File upload handling
    $file = $_FILES['resource-file'];
    $file_name = basename($file['name']);
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

    // Check for allowed file types
    $allowed_extensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt'];
    if (!in_array(strtolower($file_type), $allowed_extensions)) {
        echo "Invalid file type. Only PDF, DOC, DOCX, PPT, PPTX, TXT are allowed.";
        exit;
    }

    // Check file size (max 5MB)
    if ($file_size > 5 * 1024 * 1024) {  // 5MB
        echo "File is too large. Maximum allowed size is 5MB.";
        exit;
    }

    // Define the upload folder
    $upload_dir = 'uploads/';

    // Check if the upload directory exists, if not, create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);  // Create the directory with read/write/execute permissions
    }

    // Define the file path for saving the uploaded file
    $file_path = $upload_dir . $file_name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file_tmp_name, $file_path)) {
        // Prepare SQL query to insert data into the resources table
        $sql = "INSERT INTO resources (ResourceName, Author, CategoryID, Description, FilePath, FileType, FileSize)
                VALUES ('$resource_name', '$resource_author', '$resource_category', '$resource_description', '$file_path', '$file_type', '$file_size')";

        // Execute the query and check for success
        if ($conn->query($sql) === TRUE) {
            echo "Resource uploaded successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resource</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style sheet.css">
</head>
<body>
    <h1>Upload Resource</h1>
    <form id="upload-resource-form" enctype="multipart/form-data" method="POST" action="">

        <label for="resource-name">Resource Name:</label>
        <input type="text" id="resource-name" name="resource-name" required><br>

        <label for="resource-author">Author:</label>
        <input type="text" id="resource-author" name="resource-author" required><br>

        <label for="resource-category">Category:</label>
        <select id="resource-category" name="resource-category" required>
            <option value="" disabled selected>Select a category</option>
            <option value="inf">Informatique</option>
            <option value="shem">Shemie</option>
            <option value="elec">Electronique</option>
        </select><br>

        <label for="resource-description">Description:</label>
        <textarea id="resource-description" name="resource-description" rows="4" required></textarea><br>

        <label for="resource-file">Upload File:</label>
        <input type="file" id="resource-file" name="resource-file" required><br>

        <button type="submit" id="submit-button">Upload Resource</button>
        <button type="button" id="cancel-button">Cancel</button>
    </form>

    <script>
        $(document).ready(function () {

            // Cancel button functionality
            $('#cancel-button').on('click', function () {
                window.location.href = 'manage_ressources.html';  // Adjust this path based on where you want to go after cancel
            });

        });
    </script>
</body>
</html>
