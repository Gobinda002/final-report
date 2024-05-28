<?php

require '../connect.php';
if (isset($_POST['submit'])) {

    $package_title = $_POST['destination'];
    $package_description = $_POST['description'];
    $package_duration = $_POST['duration'];

    $package_image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['temp_name'];
    $folder = 'images/' . $package_image;

    $query = mysqli_query($conn, "Insert into packages (package_image) values ('$package_image')");

    if (move_uploaded_file($tempnmae, $folder)) {
        echo "<h2>File uploaded sucessfully </h2>";
    } else {
        echo "<h2>File not uploaded  </h2>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    HTML form to add a new travel package
    <form method="post" enctype="multipart/form-data">
        Destination: <input type="text" name="destination"><br>
        Image: <input type="file" name="image"><br>
        Description: <input type="text" name="description"><br>
        Price: <input type="number" name="price"><br>
        Duration: <input type="text" name="duration"><br>
        <input type="submit" value="Add Package">
    </form>
    <div>
        <?php
            $res = mysqli_query($conn,"Seelct * from images");
            while($row = mysqli_fetch_assoc($res)){
        ?>
        <img src="image/<?php echo $row['file']?>" alt="">
        <?php } ?>
    </div>
</body>

</html>
<!-- 
// // Function to add a new travel package to the database
// function addTravelPackage($package_title, $package_image, $package_description, $package_duration) {
//     global $conn;
    // Corrected SQL query with single quotes around values
//     $sql = "INSERT INTO packages (package_title, package_image, package_description, package_duration, package_creator) VALUES ('$package_title', '$package_image', '$package_description', '$package_duration',1)";
//     if ($conn->query($sql) === TRUE) {
//         echo "New travel package added successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Check if file upload is successful
//     if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
//         // Retrieve form data
//         $package_title = $_POST["destination"];
//         $package_image = base64_encode(file_get_contents($_FILES["image"]["tmp_name"]));
//         $package_description = $_POST["description"];
//         $package_duration = $_POST["duration"];

//         // Call the function to add the travel package
//         addTravelPackage($package_title, $package_image, $package_description, $package_duration);
//     } else {
//         // Handle file upload error
//         echo "Error uploading file.";
//     }
// }

// ?> -->

<!-- HTML form to add a new travel package -->
<!-- <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    Destination: <input type="text" name="destination"><br>
    Image: <input type="file" name="image"><br>
    Description: <input type="text" name="description"><br>
    Price: <input type="number" name="price"><br>
    Duration: <input type="text" name="duration"><br>
    <input type="submit" value="Add Package">
</form> -->