<?php
session_start();
require '../../connect.php'; // Adjust the path as necessary

$sql = "SELECT package_id, package_title, package_image FROM packages"; // Adjust the query to include package_image
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/CSS/trekingf.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!--**********  Navbar Section *********--->
    <header class="nav-section">
        <div class="nav ">
            <a href="#" class="logo">
                <img src="../Data/logod.png" alt="logo">
                NepTours</a>

            <ul class="navbar">
                <li><a href="../index.php">home</a></li>
                <li><a href="#2">Packages</a></li>
                <li><a href="#3">Services</a></li>
                <li><a href="#">Review</a></li>
                <li><a href="../routes/contact.php">contact</a></li>
            </ul>

            <ul class="inout">
                <?php if (isset($_SESSION['username'])) { ?>
                <li>
                    <?php echo $_SESSION['username']; ?>
                </li>
                <li><a href="../controller/logout.php">Logout</a></li>
                <?php } else { ?>
                <li><a href="../controller/login.php">Login</a></li>
                <li><a href="../controller/register.php">Signup</a></li>
                <?php } ?>
            </ul>
        </div>
    </header>

    <!-- *****all section***** -->

    <section class="packages">
        <div class="allpack">
             <!-- <a href="../routes/packages/everest.html">
                <div class="card">
                    <div class="card-img">
                        <img src="../Data/ebcu.jpg" alt="">
                    </div>                    
                    <h1 class="card-title">Everest Base camp</h1>                  
                </div>
            </a>
         -->
            <!-- <a href="#">
                <div class="card">
                    <div class="card-img">
                        <img src="../Data/annapurna circuit trek.jpg" alt="" style="height: 100%;">
                    </div>                    
                    <h1 class="card-title">aanapurna circuit trek</h1>
                </div>
            </a>

            <a href="#">
                <div class="card">
                    <div class="card-img">
                        <img src="../Data/annapurna circuit trek.jpg" alt="" style="height: 100%;">
                    </div>                    
                    <h1 class="card-title">aanapurna circuit trek</h1>
                </div>
            </a>

            <a href="#">
                <div class="card">
                    <div class="card-img">
                        <img src="../Data/annapurna circuit trek.jpg" alt="" style="height: 100%;">
                    </div>                    
                    <h1 class="card-title">aanapurna circuit trek</h1>
                </div>
            </a>        

            <a href="#">
                <div class="card">
                    <div class="card-img">
                        <img src="../Data/annapurna circuit trek.jpg" alt="" style="height: 100%;">
                    </div>                    
                    <h1 class="card-title">aanapurna circuit trek</h1>
                </div>
            </a>    -->
              
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image_path = '../../packagesimage/' . $row["package_image"]; // Construct the image path
                    echo '<a href="package_details.php?package_id=' . $row["package_id"] . '&package_name=' . urlencode($row["package_title"]) . '">';
                    echo '<div class="card">';
                    echo '<div class="card-img">';
                    echo "<img src='{$image_path}' alt='" . htmlspecialchars($row["package_title"]) . "' style='width:100%;height:100px;'>";
                    echo '</div>';
                    echo '<h1 class="card-title">' . htmlspecialchars($row["package_title"]) . '</h1>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo "No packages found.";
            }
            $conn->close();
            ?>
        </div>



        </div>
    </section>

    <script src="../public/main.js"></script>

</html>


  <?php
//for package added


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Database connection
//     require '../../connect.php';

//     $package_title = $_POST['package_title'];
//     $image_name = $_FILES['image']['name'];
//     $target_dir = "../uploads/";
//     $target_file = $target_dir . basename($image_name);

//     // Move uploaded file to the target directory
//     if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
//         // Insert package data into the database
//         $sql = "INSERT INTO packages (package_title, image_name) VALUES ('$package_title', '$image_name')";
//         if ($conn->query($sql) === TRUE) {
//             echo "Package added successfully!";
//         } else {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     } else {
//         echo "Error uploading file.";
//     }

//     // Close database connection
//     $conn->close();
// } 
?>
