<?php
session_start();

// Query to get the bookings of the logged-in user
$query = "SELECT b.id, b.package_id, p.title, p.image, b.status
          FROM bookings b
          JOIN packages p ON b.package_id = p.id
          WHERE b.user_id = '$user_id'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if there are any bookings
if (mysqli_num_rows($result) > 0) {
    // Display the bookings
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<th><img src='" . $row['image'] . "' alt='default image'></th>";
        echo "<th>" . $row['title'] . " - " . $row['status'] . "</th>";
        echo "</tr>";
    }
} else {
    echo "No bookings found.";
}

// Close the database connection
mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/CSS/mybooking.css">
</head>

<body>


    <!--**********  Navbar Section *********--->
    <header class="nav-section">
        <div class="nav ">
            <a href="../index.php" class="logo">
                <img src="../data/logod.png" alt="logo">
                NepTours
            </a>

            <ul class="navbar">
                <li><a href="#">home</a></li>
                <li><a href="#2">Packages</a></li>
                <li><a href="#3">Services</a></li>
                <li><a href="#4">Review</a></li>
                <li><a href="routes/contact.php">contact</a></li>
            </ul>

            <ul class="inout">
                <?php if (isset($_SESSION['username'])) { ?>
                <li style="font-size: 1.6rem; font-weight: 600;color:#fc7c12;">
                    <?php echo $_SESSION['username']; ?>
                </li>
                <li><a href="../controller/logout.php">Logout</a></li>
                <?php } else { ?>
                <li><a href="../controller/login.php">Login</a></li>
                <li><a href="../controller/register1.php">Signup</a></li>
                <?php } ?>
            </ul>
        </div>
    </header>


    <div class="container">
        
        <table>
        <h2 class="heading">My Bookings</h2>
            <tr>
                <th>Package Title</th>
                <th>Number of People</th>
                <th>Package Cost</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>
                    <?php echo $row['package_title']; ?>
                </td>
                <td>
                    <?php echo $row['num_people']; ?>
                </td>
                <td>
                    <?php echo $row['package_cost']; ?>
                </td>
                <td>
                    <?php echo $row['status']; ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>

</html>