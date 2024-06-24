<?php
session_start();

require '../../connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $username = $_POST["username"];
    $destination = $_POST["package_title"];
    $date = $_POST["packageAvailable_id"];
    $participants = $_POST["num_people"];
    $package_cost = $_POST["package_cost"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO bookings (username, package_title, num_people, package_cost) 
            VALUES ('$username', '$destination', '$participants', '$package_cost')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Booking successful! Thank you for booking with us.');
                window.location.href = '../index.php'; // Redirect to index.php
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Booking</title>
    <link rel="stylesheet" href="../public/CSS/booking.css">
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <div class="booking">
        <h1>Book Your Trek or Hike</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"
                    value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly required>

                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="package_title" required>

                <label for="participants">Number of Participants:</label>
                <input type="number" id="participants" name="num_people" min="1" value="1" required
                    oninput="updatePrice()">

                <label>Total Price :</label>
                <p id="total-price">$2000</p>
                <input type="hidden" id="package_cost" name="package_cost" value="2000">
                <!-- Hidden input for date -->
                <input type="hidden" id="packageAvailable_id" name="packageAvailable_id" value="<?php echo $date; ?>">
            </div>
            <button type="submit">Book Now</button>
        </form>
    </div>
    <script>
        function updatePrice() {
            const basePrice = 2000;
            const participants = parseInt(document.getElementById('participants').value, 10) || 1;
            const totalPrice = basePrice * participants;
            document.getElementById('total-price').innerText = "$" + totalPrice;
            document.getElementById('package_cost').value = totalPrice;
        }
    </script>
</body>

</html>