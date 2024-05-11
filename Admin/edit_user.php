<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        /* Main styles for the edit form */

body {
    background-color: #f5f5f5;
    font-family: sans-serif;
  }
  
  .edit-user {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    margin: 50px auto;
    max-width: 500px;
    padding: 20px;
  }
  
  .edit-user h2 {
    color: #444;
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  .edit-user label {
    color: #777;
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
  }
  
  .edit-user input[type="text"],
  .edit-user input[type="email"],
  .edit-user input[type="password"],
  .edit-user textarea {
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    display: block;
    font-size: 16px;
    margin-bottom: 10px;
    padding: 10px;
    width: 100%;
  }
  
  .edit-user textarea {
    height: 100px;
  }
  
  .edit-user input[type="submit"] {
    background-color: #005eff;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
    padding: 10px;
    transition: background-color 0.3s;
  }
  
  .edit-user input[type="submit"]:hover {
    background-color: blue;
  }
  
  /* Additional styles for responsiveness */
  
  @media screen and (max-width: 500px) {
    .edit-user {
      margin: 20px;
      max-width: none;
    }
  }
  .edit-user button[type="button"] {
        background-color: gray;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
        font-weight: bold;
  }
  
  .edit-user button[type="button"]:hover {
	background-color: #2c2c2c;
  }
    </style>
</head>
<body>

<?php
// Connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tat';
$conn = mysqli_connect($host, $username, $password, $dbname);

// Handle form submission if requested
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $query = "UPDATE user SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$password', address='$address', date_updated=NOW() WHERE id=$id";
  mysqli_query($conn, $query);

  // check if the update was successful
  if (mysqli_affected_rows($conn) > 0) {
    echo "Edited successfully";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }

  header('location: user.php');
}


// Query the database for user data
$id = $_GET['id'];
$query = "SELECT * FROM user WHERE id=$id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Display the HTML for the form or a success message
if (isset($message)) {
  echo '<div class="message">' . $message . '</div>';
} else {
  echo '<div class="edit-user">
    <h2>Edit User</h2>
    <form method="post">
      <input type="hidden" name="id" value="' . $row['id'] . '">
      <label for="firstname">First name:</label>
      <input type="text" name="firstname" value="' . $row['firstname'] . '"><br>
      <label for="lastname">Last name:</label>
      <input type="text" name="lastname" value="' . $row['lastname'] . '"><br>
      <label for="username">Username:</label>
      <input type="text" name="username" value="' . $row['username'] . '"><br>
      <label for="email">E-mail:</label>
      <input type="email" name="email" value="' . $row['email'] . '"><br>
      <label for="password">Password:</label>
      <input type="password" name="password" value="' . $row['password'] . '"><br>
      <label for="address">Address:</label>
      <textarea name="address">' . $row['address'] . '</textarea><br>
      <input type="submit" name="submit" value="Update">
      <a href="user.php"><button type="button">Back</button></a>
    </form>
  </div>';
}

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>