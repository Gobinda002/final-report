<?php
require '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="packages.css">
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
				<li><a href="user.php">Users</a></li>
				<li><a href="packages.php"
						class="<?php echo basename($_SERVER['PHP_SELF']) == 'packages.php' ? 'active' : ''; ?>">Packages</a>
				</li>
				<li><a href="../login.php">Logout</a></li>
			</ul>
		</nav>
	</header>

	<section class="packages container">
		<div class="popularPack">
			<div class="row">
				<a href="#" class="card">
					<div class="cimg">
						<img src="image/scot1.jpg" alt="">
						<div class="card-body">
							<h1 class="card-title">Everest Base Camp</h1>
						</div>
					</div>
				</a>
				<a href="#" class="card">
					<div class="cimg">
						<img src="image/scot4.jpg" alt="">
						<div class="card-body">
							<h1 class="card-title">Everest Base Camp</h1>
						</div>
					</div>
				</a>
				<a href="#" class="card">
					<div class="cimg">
						<img src="image/scot1.jpg" alt="">
						<div class="card-body">
							<h1 class="card-title">Everest Base Camp</h1>
						</div>
					</div>
				</a>
			</div>
			<div class="row">
				<a href="#" class="card">
					<div class="cimg">
						<img src="image/scot1.jpg" alt="">
						<div class="card-body">
							<h1 class="card-title">Everest Base Camp</h1>
						</div>
					</div>
				</a>
				<a href="#" class="card">
					<div class="cimg">
						<img src="image/scot1.jpg" alt="">
						<div class="card-body">
							<h1 class="card-title">Everest Base Camp</h1>
						</div>
					</div>
				</a>
				<a href="#" class="card">
					<div class="cimg">
						<img src="image/scot1.jpg" alt="">
						<div class="card-body">
							<h1 class="card-title">Everest Base Camp</h1>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="allpack" style="display: none;">
			<?php
			// Handle delete action if requested
			if (isset($_GET['delete'])) {
				$id = $_GET['delete'];
				$query = "DELETE FROM packages WHERE package_id=$id";
				mysqli_query($conn, $query);
			}

			// Query the database for package data
			$query = 'SELECT * FROM packages';
			$result = mysqli_query($conn, $query);

			// Generate the HTML for the table
			$html = '
			<div class="package-list">
    			<h2>Package List</h2>
    			<button class="button addpack">Add Packages</button>
    			<table>
        			<thead>
            			<tr>
                			<th>Id</th>
                			<th>Package Title</th>
                			<th>Package Image</th>
                			<th>Package Description</th>
                			<th>Package Duration</th>
                			<th>Package Creator</th>
                			<th>Actions</th>
            			</tr>
        			</thead>
					
        			<tbody>';

			// Loop through query result and output package data in table rows
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['package_id'];
				$html .= "<tr>";
				$html .= "<td>" . $id . "</td>";
				$html .= "<td>" . $row['package_title'] . "</td>";
				$html .= "<td><img src='" . $row['package_image'] . "' alt='" . $row['package_title'] . "' style='width:100px;height:100px;'></td>";
				$html .= "<td>" . $row['package_description'] . "</td>";
				$html .= "<td>" . $row['package_duration'] . "</td>";
				$html .= "<td>" . $row['package_creator'] . "</td>";
				$html .= "<td>";
				$html .= "<a href='edit_package.php?id=" . $id . "' class='button edit'>Edit</a> ";
				$html .= "<a href='?delete=" . $id . "' class='button delete'>Delete</a>";
				$html .= "</td>";
				$html .= "</tr>";
			}

			$html .= '</tbody>
			</table>
			</div>';

			// Display the HTML
			echo $html;
			?>
		</div>

		<div class="btn-field">
			<button type="button" class="packbutton popular active">Popular Tour</button>
			<button type="button" class="packbutton packall">Packages</button>

		</div>
	</section>

	<!-- Pop up to add package-->
	<div id="myModal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<form id="loginForm" action="login_action.php" method="post">
				<h2>Login Form</h2>

				<div id="imageContainer">
					<label for="packageImages">Package Images:</label>
					<input type="file" name="packageImages[]" accept="image/*" required>
					<input type="file" name="packageImages[]" accept="image/*" required>
					<input type="file" name="packageImages[]" accept="image/*" required>
					<input type="file" name="packageImages[]" accept="image/*" required>
				</div>

				<label for="packageName">Package Name:</label>
				<input type="text" id="packageName" name="packageName" required>

				<label for="description">Description:</label>
				<textarea id="description" name="description" rows="4" required></textarea>

				<label for="packageDuration">Package Duration (days):</label>
				<input type="number" id="packageDuration" name="packageDuration" min="1" required>

				<button type="submit">Login</button>
			</form>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const popularPack = document.querySelector('.popularPack');
			const allPack = document.querySelector('.allpack');
			const popularBtn = document.querySelector('.popular');
			const packallBtn = document.querySelector('.packall');

			// for popup
			const modal = document.getElementById("myModal");
			const addPackBtn = document.querySelector('.addpack');
			const closeModal = document.querySelector(".close");


			popularBtn.addEventListener('click', () => {
				allPack.style.display = 'none';
				popularPack.style.display = 'block';
				popularBtn.classList.add('active');
				packallBtn.classList.remove('active');
			});

			packallBtn.addEventListener('click', () => {
				allPack.style.display = 'block';
				popularPack.style.display = 'none';
				packallBtn.classList.add('active');
				popularBtn.classList.remove('active');
			});

			// for popp

			addPackBtn.addEventListener('click', () => {
				modal.style.display = "block";
			});

			closeModal.addEventListener('click', () => {
				modal.style.display = "none";
			});

			window.addEventListener('click', (event) => {
				if (event.target === modal) {
					modal.style.display = "none";
				}
			});
		});
	</script>
</body>

</html>