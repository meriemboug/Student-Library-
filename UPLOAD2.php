<?php
include('db.php');  // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Prepare SQL query to get the user data from the database
    $sql = "SELECT * FROM users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the username exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['PasswordHash'])) {
            // Successful login
            session_start();  // Start the session
            $_SESSION['userID'] = $user['UserID'];  // Store user data in session
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['Role'];

            header("Location: upload_material.html");  // Redirect to another page after successful login
            exit();
        } else {
            // Invalid password
            $error_message = "Invalid username or password.";
        }
    } else {
        // Invalid username
        $error_message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
           padding :20px; 
       }

       .container {
           width :100%; 
           max-width :400px; 
           padding :2em; 
           background-color:#FFF8E7; 
           border-radius :12px; 
           box-shadow :0 12px 20px rgba(0,0,0,.15);
       }

       h2 {
           text-align:center; 
           color:#4D362E; 
           font-size :1.8rem; 
           font-weight :bold; 
           margin-bottom :1.5em; 
       }

       .form-group {
           margin-bottom :1.5em; 
       }

       label {
           display:block; 
           font-weight:bold; 
           color:#A67242; 
           margin-bottom:.5em; 
       }

       input[type=text], input[type=password] {
           width :100%; 
           padding :12px; 
           border :2px solid #D1A87D; 
           border-radius :8px; 
           font-size :1rem; 
       }

       button {
           width :100%; 
           padding :14px; 
           border:none; 
           border-radius :8px; 
           background-color:#D89D46; 
           color:white; 
           font-size :1.2rem; 
           cursor:pointer; 
       }

       button:hover {
          background-color:#BB7B32; 
      }

      .error-message {
          color:red ;  
          margin-top:-10px ;  
          margin-bottom :10px ;  
          font-size :.9rem ;  
      }
   </style>
</head>

<body>

   <div class ="container">
       <h2>Login to Your Account</h2>

      
       <form id ="loginForm" action ="upload_material.html" method ="post">
          <div class ="form-group">
               <label for ="loginUsername">Username:</label >
               <input type ="text" id ="loginUsername" name ="loginUsername" required />
               
               <div class ="error-message" id ="loginUsernameError"></div >
          </div >

          <div class ="form-group">
               <label for ="loginPassword">Password:</label >
               <input type ="password" id ="loginPassword" name ="loginPassword" required />
              
               <div class ="error-message" id ="loginPasswordError"></div >
          </div >

          
          <button type ="submit">Login</button >

         
          <div class ="link-to-register">
               Don't have an account? <a href ="register.html">Register here</a >
          </div >
      </form >

   </div >

   
   <script >
       document.getElementById('loginForm').addEventListener('submit', function(e) {
           e.preventDefault(); 

           
           document.querySelectorAll('.error-message').forEach(function(el) {
               el.textContent = '';
           });

           let isValid = true;

          
           const username = document.getElementById('loginUsername').value.trim();
           if (username.length === 0) {
               document.getElementById('loginUsernameError').textContent = 'Username cannot be empty.';
               isValid = false; 
           }

           
           const password = document.getElementById('loginPassword').value.trim();
           if (password.length === 0) {
               document.getElementById('loginPasswordError').textContent = 'Password cannot be empty.';
               isValid = false; 
           }

          
           if (isValid) {
               alert("Login successful!"); 
               window.location.href = "upload_material.html"; 
           }
       });
   </script >

</body >
</html >