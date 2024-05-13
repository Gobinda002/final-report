<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(../data/bg_login.png);
            background-position: center;
            background-size: cover;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
        }

        .form-container {
            background: transparent;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
            padding: 20px;
            width: 300px;
            margin: 10rem 20rem; /* Center the form horizontally */
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2a2185;
        }

        .error-message {
            padding: 20px;
            background-color: #f44336;
            color: white;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
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

        .switch-form {
            margin-top: 10px;
            text-align: center;
        }

        .switch-form a {
            color: #2a2185;
            text-decoration: none;
        }

        /* Add red border to confirm password input */
        .error-input {
            border-color: red !important;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Register</h2>
        <!-- Display error message if present -->
        <?php if (!empty($error)) { ?>
            <div class="error-message">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <!-- Registration form -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
        $error = '';
        include ' ../../../../connect.php';
        if (isset($_POST['submit'])) {

            $username = mysqli_real_escape_string($conn, $_POST['username']);

            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);
            $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

            $password = password_hash($pass, PASSWORD_BCRYPT);
            $cpassword = password_hash($cpass, PASSWORD_BCRYPT);

            $emailquery = "SELECT * FROM user WHERE email = '$email' ";
            $query = mysqli_query($conn, $emailquery);

            $emailcount = mysqli_num_rows($query);
            if ($emailcount > 0) {
                $error = 'Email already exists';
            } else {
                if ($pass === $cpass) {
                    $insertquery = "INSERT INTO user( username,phone, email, password) values('$username','phone', '$email', '$password')";
                    $iquery = mysqli_query($conn, $insertquery);
                    if ($iquery) {
                        ?>
                        <script>
                            Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "login.php";
                            });
                        </script>
                        <?php
                    }
                } else {
                    $error = 'Password and confirm password do not match';
                }
            }
        }
        ?>
        <form id="register-form" action="#" method="post">
            <div class="form-group">
                <label for="register-username">Username</label>
                <input type="text" id="register-username" name="username" required>
            </div>

            <div class="form-group">
                <label for="register-phone">Phone number</label>
                <input type="int" id="register-phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="register-email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="register-password">Password</label>
                <input type="password" id="register-password" name="pass" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="cpass" required onkeyup="checkPasswordMatch()">
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
        </form>
        <div class="switch-form">
            <p>Already have an account? <a href="login.php" id="switch-to-login">Login</a></p>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
</body>

</html>