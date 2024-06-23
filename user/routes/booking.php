<?php
session_start();

require '../../connect.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $destination = $_POST["package_title"];
    $date = $_POST["packageAvailable_id"];
    $participants = $_POST["num_people"];
    $package_cost = $_POST["package_cost"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO bookings (package_title, num_people, package_cost) 
            VALUES ( '$destination' ,'$participants',  '$package_cost')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Booking successful! Thank you for booking with us.');
                window.location.href = '../index.php'; // Redirect to index.php
                // You can also use window.location.reload(); to refresh the current page
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

    <div class="container">
        <h1>Book Your Trek or Hike</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="package_title">

                <!-- value="<?php echo $destination; ?>" required readonly -->
            </div>

            <div class="form-group">
                <label for="participants">Number of Participants:</label>
                <input type="number" id="participants" name="num_people" min="1" value="1" required
                    oninput="updatePrice()">
            </div>
            <div class="form-group">
                <label>Trek or Hike Package:</label>
                <p id="total-price">$2000</p>
                <input type="hidden" id="package_cost" name="package_cost" value="2000">
            </div>
            <div class="form-group">
                <label for="preferences">Special Preferences or Comments:</label>
                <textarea id="preferences" name="preferences" rows="4"></textarea>
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