

<!-- // include '../connect.php';


// // Check if form data is received
// if (isset($_POST['booking_id'], $_POST['status'])) {
//     // Sanitize and validate input
//     $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
//     $status = mysqli_real_escape_string($conn, $_POST['status']);

//     // Update the booking status
//     $sql = "UPDATE bookings SET status='$status' WHERE booking_id=$booking_id";
//     $result = mysqli_query($conn, $sql);

//     // Check if update was successful
//     if ($result) {
//         echo "Booking status updated successfully.";
//     } else {
//         echo 'Error updating booking status: ' . mysqli_error($conn);
//     }
// }

// // Close the database connection
// mysqli_close($conn);

// // Redirect back to the admin view
// header('Location: bookings.php');
// exit; -->


<?php
// Include the database connection file
include '../connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the booking ID and the new status from the form
    $booking_id = $_POST['booking_id'];
    $status = $_POST['status'];

    // Update the booking status in the database
    $query = "UPDATE bookings SET status = '$status' WHERE booking_id = '$booking_id'";
    if (mysqli_query($conn, $query)) {
        // Redirect back to the bookings page with a success message
        header("Location: bookings.php?message=Booking status updated successfully");
        exit();
    } else {
        // Redirect back to the bookings page with an error message
        header("Location: bookings.php?error=Failed to update booking status");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
