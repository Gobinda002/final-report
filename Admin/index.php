<?php
require '../connect.php';
session_start();

if(isset($_POST['login'])){
    $query = "Select * From 'admin' where 'admin_name' = '$_POST[admin_name]' AND 'admin_password'= $_POST[admmin_password]' " ;
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){
        $_SESSION['adminID'] = $_POST['adminID'];
        header("location: admin.php");
        $ $success_message = "correct";

    }else{
        $error = "incorrect";
    }

}
// $error = "";
// $success_message = "";

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['admin_email']) && isset($_POST['admin_password'])) {
//         $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
//         $admin_password = $_POST['admin_password'];

//         $admin_sql = "SELECT * FROM admin WHERE admin_email='$admin_email'";
//         $admin_result = mysqli_query($conn, $admin_sql);

//         if ($admin_result && $admin_result->num_rows > 0) {
//             $row = $admin_result->fetch_assoc();
//             // Verify password (assuming it's hashed using password_hash)
//             if (password_verify($admin_password, $row['admin_password'])) {
//                 $_SESSION['adminID'] = $row['adminID'];
//                 $_SESSION['admin_name'] = $row['admin_name'];
//                 header("Location: abc.html");
//                 exit();
//             } else {
//                 $error = "Invalid email or password.";
//             }
//         } else {
//             $error = "Invalid email or password.";
//         }
//     } else {
//         $error = "Email and Password are required.";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <a href="admin.html"></a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(../user/data/bg_login.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
        }

        .login-container {
            background: transparent;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
            padding: 20px;
            width: 300px;
            margin: 19rem 20rem; 
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

        .success-message {
            padding: 10px;
            background-color: #04AA6D;
            color: white;
            border-radius: 4px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($error)) { ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php } ?>
        <?php if (!empty($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div> <!-- Print success message -->
        <?php } ?>
        <form id="login-form" action="login.php" method="post">
            <div class="form-group">
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" name="admin_email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="admin_password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="btn" name="login">Login</button>
        </form>
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
