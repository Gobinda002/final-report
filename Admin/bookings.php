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
        <li><a href="packages.php">Packages</a></li>
        <li><a href="../login.php">Logout</a></li>
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
    echo "<table>";
    echo "<tr><th>ID</th><th>User ID</th><th>Package ID</th><th>Number of People</th><th>Total Cost</th><th>Payment Method</th><th>Status</th></tr>";
    while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['booking_id'] . "</td>";
      echo "<td>" . $row['user_id'] . "</td>";
      echo "<td>" . $row['package_id'] . "</td>";
      echo "<td>" . $row['num_people'] . "</td>";
      echo "<td>" . $row['packageAvailable_id'] . "</td>";
      
      echo "<td>" . $row['total_cost'] . "</td>";
      echo "<td>" . $row['payment_method'] . "</td>"; ?>
      <td>
        <form action="update_booking_status.php" method="post">
          <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
          <select name="state">
            <option value="pending" <?php if ($row['state'] == 'pending')
              echo 'selected'; ?>>Pending</option>

            <option value="confirmed" <?php if ($row['state'] == 'confirmed')
              echo 'selected'; ?>>Confirmed</option>

            <option value="cancelled" <?php if ($row['state'] == 'cancelled')
              echo 'selected'; ?>>Cancelled</option>

            <option value="completed" <?php if ($row['state'] == 'completed')
              echo 'selected'; ?>>Completed</option>
              
          </select>
          <button type="submit">Update</button>
        </form>

      </td>
      <?php echo "</tr>";
    }
    echo "</table>"; ?>
    <?php
    // close the database connection
    mysqli_close($conn);
    ?>
  </div>
</body>
<?php include ('footer.php') ?>

</html>