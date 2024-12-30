<?php
// db.php - Include the database connection
include('db.php');

// Check if the 'id' parameter is present in the URL (for editing)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the resource details from the database
    $sql = "SELECT * FROM resources WHERE ResourceID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $resource = $result->fetch_assoc();
}

// Handle the form submission (update the resource)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['resource-id']; // Resource ID
    $name = $_POST['resource-name'];
    $author = $_POST['resource-author'];
    $category = $_POST['resource-category'];
    $description = $_POST['resource-description'];

    // Handle file upload (if a new file is uploaded)
    $filePath = $resource['FilePath'];  // Keep the current file path if no new file is uploaded
    if ($_FILES['resource-file']['name']) {
        $fileName = $_FILES['resource-file']['name'];
        $fileTmpName = $_FILES['resource-file']['tmp_name'];
        $filePath = "uploads/" . $fileName; // Set folder for uploaded files
        
        // Validate the file type
        $allowedExtensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            die("Invalid file type.");
        }

        // Move the uploaded file to the server
        if (!move_uploaded_file($fileTmpName, $filePath)) {
            die("File upload failed.");
        }
    }

    // Update the resource in the database
    $sql = "UPDATE resources SET ResourceName = ?, Author = ?, Category = ?, Description = ?, FilePath = ? WHERE ResourceID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $author, $category, $description, $filePath, $id);
    $stmt->execute();

    // Redirect or display a success message
    echo "Resource updated successfully!";
    header("Location: manage-resources.php");
    exit;
}
?>
