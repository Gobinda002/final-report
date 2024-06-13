<?php

require '../connect.php';

if (isset($_POST['submit'])) {

    $package_title = $_POST['destination'];
    $package_description = $_POST['description'];
    $package_duration = $_POST['duration'];

    $package_image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'image/' . $package_image;

    // Move uploaded file to destination folder
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h2>File uploaded successfully </h2>";
    } else {
        echo "<h2>File not uploaded  </h2>";
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO packages (package_title, package_image, package_description, package_duration, package_creator) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param("ssss", $package_title, $package_image, $package_description, $package_duration);
    
    if ($stmt->execute()) {
        echo "New travel package added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
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

    <!-- HTML form to add a new travel package -->
    <form method="post" enctype="multipart/form-data">
        Destination: <input type="text" name="destination"><br>
        Image: <input type="file" name="image"><br>
        Description: <input type="text" name="description"><br>
        Price: <input type="number" name="price"><br>
        Duration: <input type="text" name="duration"><br>
        <input type="submit" name="submit" value="Add Package">
    </form>

    <div>
        <?php
        // Display uploaded images
        $res = mysqli_query($conn, "SELECT * FROM packages");
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <img src="image/<?php echo $row['package_image'] ?>" alt="">
        <?php } ?>
    </div>
</body>

</html>
