

<!DOCTYPE html>
<html>

<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="admin.css">
</head>

<body>
	<header>
		<h1>NEPTOURS</h1>
		<nav>
			<ul>
				<li><a href="admin.php"
						class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : ''; ?>">Dashboard</a>
				</li>
				<li><a href="bookings.php">Bookings</a></li>
				<li><a href="../inquiry/view_inquiry.php">Issues</a></li>
				<li><a href="user.php">Users</a></li>
				<li><a href="..\image\index.php">Packages</a></li>
				<li><a href="../login.php">Logout</a></li>
			</ul>
		</nav>
	</header>

	<div class="content">
		<div class="box blue">
			<h1>Total Bookings</h1>
			
				<?php
			
			// $servername = "localhost";
			// $username = "root";
			// $password = "";
			// $dbname = "tat";

			// $conn = new mysqli($servername, $username, $password, $dbname);

			// if ($conn->connect_error) {
			// 	die("Connection failed: " . $conn->connect_error);
			// }

			require'../connect.php';

			// Query to retrieve total bookings
			$sql = "SELECT COUNT(*) as total_bookings FROM bookings";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while ($row = $result->fetch_assoc()) {
					echo "<p>" . $row["total_bookings"] . "</p>";
				}
			} else {
				echo "<p>No bookings found.</p>";
			}

			$con->close();
			?>
		</div>

		<div class="box green">
			<h1>Total Users</h1>
			<?php
			// // Connect to database
			// $servername = "localhost";
			// $username = "root";
			// $password = "";
			// $dbname = "tat";

			// $conn = new mysqli($servername, $username, $password, $dbname);

			// if ($conn->connect_error) {
			// 	die("Connection failed: " . $conn->connect_error);
			// }

			require'../connect.php';

			// Query to retrieve total users
			$sql = "SELECT COUNT(*) as total_users FROM user";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while ($row = $result->fetch_assoc()) {
					echo "<p>" . $row["total_users"] . "</p>";
				}
			} else {
				echo "<p>No users found.</p>";
			}

			$con->close();
			?>
		</div>

		<div class="box purple">
			<h1>Total Issues</h1>
			<?php
			

			include'../connect.php';

			// Query to retrieve total issues
			$sql = "SELECT COUNT(*) as total_issues FROM inquiry";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while ($row = $result->fetch_assoc()) {
					echo "<p>" . $row["total_issues"] . "</p>";
				}
			} else {
				echo "<p>No issues found.</p>";
			}

			$con->close();
			?>
		</div>
	</div>
	<div class="container">
		<div class="box orange">
			<h1>Total Packages</h1>
			<?php
			

			require'../connect.php';

			// Query to retrieve total packages
			$sql = "SELECT COUNT(*) as total_packages FROM packages";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while ($row = $result->fetch_assoc()) {
					echo "<p>" . $row["total_packages"] . "</p>";
				}
			} else {
				echo "<p>No packages found.</p>";
			}

			$con->close();
			?>
		</div>

	</div>

</body>

<?php include ('footer.php') ?>

</html>