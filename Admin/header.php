<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="admin.css">
</head>
<body>
	<header>
		<h1>Tours and Travels</h1>
		<nav>
			<ul>
				<li><a href="../admin/admin.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : ''; ?>">Dashboard</a></li>
                <li><a href="../admin/bookings.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'bookings.php' ? 'active' : ''; ?>">Bookings</a></li>
                <li><a href="../admin/user.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'user.php' ? 'active' : ''; ?>">Users</a></li>
                <li><a href="..\image\index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Packages</a></li>
			    <li><a href="../index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ?>">Logout</a></li>	
			</ul>
		</nav>
	</header>
</body>
</html>
