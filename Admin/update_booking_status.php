<?php

include '../connect.php';


// Check if form data is received
if(isset($_POST['booking_id'], $_POST['status'])) {
    // Sanitize and validate input
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
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
