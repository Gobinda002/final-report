<?php

session_start();

// Check if the user is already  logged in,if yes,redirect to dashboard
if(isset($_SESSION["email"])){
    header("Location: ../../Admin/index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require ' ../../../../connect.php';
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    //check for admin 
    $admin_sql = "SELECT * FROM admin WHERE email = '$email' AND pass='$pass' ";
    $admin_result = mysqli_query($con,$admin_sql);

    if($admin_result && mysqli_num_rows($admin_result)>0){
        header("Location: ../../Admin/index.php");
        exit;
    }else{
        $user_sql = "SELECT * FROM user WHERE email='$email' and pass ='$pass'";
        $user_result = mysqli_query($con, $user_sql);
        if ($user_result && mysqli_num_rows($user_result) > 0) {
            
            // Regular user credentials matched, redirect to index.php
            $user_data = mysqli_fetch_assoc($user_result);
            $_SESSION['username'] = $username; // Assuming username is a column in your user table
            header("location: ../index.php") ;
            exit;
        }else{
            $error = 'Invalid Username or Password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 10rem auto; /* Center the form horizontally */
        }

        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: calc(100% - 30px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2a2185;
        }

        .toggle-password {
            position: absolute;
            top: 68%;
            right: 2.3rem;
            transform: translateY(-50%);
            padding: 5px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .btn {
            background-color: #2a2185;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            display: block;
            text-align: center;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #1c166d;
        }

        .error-message {
            padding: 10px;
            background-color: #f44336;
            color: white;
            border-radius: 4px;
            margin-bottom: 10px;
            text-align: center;
        }

        .switch-form {
            margin-top: 10px;
            text-align: center;
        }

        .switch-form a {
            color: #2a2185;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <!-- Display error message if present -->
        <?php if (!empty($error)) { ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php } ?>
        <!-- Login form -->
        <form id="login-form" action="#" method="post">
            <div class="form-group">
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="pass" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="switch-form">
            <p>Don't have an account? <a href="register.php" id="switch-to-register">Register</a></p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("login-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>

</html>