<?php

include '../connect.php';

// // Get the form data
// $booking_id = $_POST['booking_id'];
// $status = $_POST['state'];


// // Update the booking status
// $sql = "UPDATE bookings SET state='$status' WHERE id=$booking_id";
// echo "SQL: " . $sql . "<br>";
// $result = mysqli_query($conn, $sql);
// echo "Result: " . $result . "<br>";

// // Check for errors
// if (!$result) {
//   echo 'Error updating booking status: ' . mysqli_error($conn);
// }

// // Close the database connection
// mysqli_close($conn);

// // Redirect back to the admin view
// header('Location: bookings.php');
// exit;




// Check if form data is received
if(isset($_POST['booking_id'], $_POST['state'])) {
    // Sanitize and validate input
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    $status = mysqli_real_escape_string($conn, $_POST['state']);
    
    // Update the booking status
    $sql = "UPDATE bookings SET state='$status' WHERE booking_id=$booking_id";
    $result = mysqli_query($conn, $sql);

    // Check if update was successful
    if ($result) {
        echo "Booking status updated successfully.";
    } else {
        echo 'Error updating booking status: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid request. Please submit the form.';
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the admin view
header('Location: bookings.php');
exit;


?>
