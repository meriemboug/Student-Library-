<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['registerUsername'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert data into the users table
    $sql = "INSERT INTO users (Username, Email, PasswordHash, Role) VALUES (?, ?, ?, 'User')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the query
    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #FAF3E0;
            color: #4D362E;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 2em;
            background-color: #FFF8E7;
            border-radius: 12px;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            color: #4D362E;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1.5em;
        }

        .form-group {
            margin-bottom: 1.5em;
        }

        label {
            display: block;
            font-weight: bold;
            color: #A67242;
            margin-bottom: 0.5em;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #D1A87D;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background-color: #D89D46;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #BB7B32;
        }

        .error-message {
          color: red; 
          margin-top: -10px; 
          margin-bottom: 10px; 
          font-size: 0.9rem; 
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Register an Account</h2>
        <form id="registrationForm" action="" method="post">
              <div class="form-group">
                  <label for="registerUsername">Username:</label>
                  <input type="text" id="registerUsername" name="registerUsername" required value="<?php echo isset($username) ? $username : ''; ?>">
                  <div class="error-message"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></div>
              </div>
              <div class="form-group">
                  <label for="registerEmail">Email:</label>
                  <input type="email" id="registerEmail" name="registerEmail" required value="<?php echo isset($email) ? $email : ''; ?>">
                  <div class="error-message"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></div>
              </div>
              <div class="form-group">
                  <label for="registerPassword">Password:</label>
                  <input type="password" id="registerPassword" name="registerPassword" required>
                  <div class="error-message"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></div>
              </div>
              <button type="submit">Register</button>
              <div class="link-to-login">
                  Already have an account? <a href="login.html">Login here</a>
              </div>
          </form>
      </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
