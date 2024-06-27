<!DOCTYPE html>
<html>

<head>
  <title>Booking List</title>
  <link rel="stylesheet" type="text/css" href="booking.css">
</head>

<body>
  <header>
    <h1>Tours and Travels</h1>
    <nav>
      <ul>
        <li><a href="admin.php">Dashboard</a></li>
        <li><a href="bookings.php"
            class="<?php echo basename($_SERVER['PHP_SELF']) == 'bookings.php' ? 'active' : ''; ?>">Bookings</a></li>
        <li><a href="user.php">Users</a></li>
        <li><a href="test.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <div class="content">
    <h1>Booking List</h1>
    <?php
    // Include the database connection file
    include '../connect.php';

    // get the bookings from the bookings table
    $query = "SELECT * FROM bookings";
    $result = mysqli_query($conn, $query);

    // display the bookings in a table
    
    // display the bookings in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Package Title</th><th>Number of People</th><th>Total Cost</th></tr>";
    while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['booking_id'] . "</td>";
      echo "<td>" . $row['username'] . "</td>";
      echo "<td>" . $row['package_title'] . "</td>";
      echo "<td>" . $row['num_people'] . "</td>";
      echo "<td>" . $row['package_cost'] . "</td>";
      echo "<td>";
      echo "<form action='update_booking_status.php' method='post'>";
      echo "<input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>";
      echo "<select name='status'>";
      echo "<option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>";
      echo "<option value='confirmed' " . ($row['status'] == 'confirmed' ? 'selected' : '') . ">Confirmed</option>";
      echo "<option value='cancelled' " . ($row['status'] == 'cancelled' ? 'selected' : '') . ">Cancelled</option>";
      echo "</select>";
      echo "<input type='submit' value='Update'>";
      echo "</form>";
      echo "</tr>";
    }
    echo "</table>"; ?>
    <?php
    // close the database connection
    mysqli_close($conn);
    ?>
  </div>

  <?php include ('footer.php') ?>
</body>

</html>