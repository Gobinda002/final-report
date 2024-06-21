<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="finalpack.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
        <div class="popularpack">
            <?php
            require '../connect.php';


            // Handle delete popular package request
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
                $delete_id = $_POST['delete_id'];

                // Delete the package from the database
                $sql_delete = "DELETE FROM popularpackage WHERE id =?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("i", $delete_id);

                if ($stmt_delete->execute()) {
                    // Success message
                    echo '<p>Package deleted successfully!</p>';
                    header('Location: ' . $_SERVER['PHP_SELF']);
                    exit;
                } else {
                    // Error message
                    echo '<p>Failed to delete package.</p>';
                    error_log("Failed to delete package: " . $stmt_delete->error);
                }
            }

            // Handle add popular package request
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['package_name'])) {
                $target_dir = "image/";
                $target_file = $target_dir . basename($_FILES["pimage"]["name"]);

                // Attempt to move the uploaded file to the designated folder
                if (move_uploaded_file($_FILES["pimage"]["tmp_name"], $target_file)) {
                    $package_name = $_POST["package_name"];
                    $description = $_POST["pdescription"];
                    $pimage = basename($_FILES["pimage"]["name"]);

                    // Insert data into the database
                    $sql = "INSERT INTO popularpackage (package_name, pdescription, pimage) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $package_name, $description, $pimage);
                    if ($stmt->execute()) {
                        // Success message
                        echo '
                <script>
                    Swal.fire("Success!", "Package added successfully!", "success").then(function() {
                        window.location.href = window.location.href; // Refresh the page
                    });
                </script>';
                    } else {
                        // Error message
                        echo '
                <script>
                    Swal.fire("Error!", "Failed to add package.", "error");
                </script>';
                        // Log the error
                        error_log("Failed to add package: " . $stmt->error);
                    }
                }
            }

            // Fetch data from the database
            $sql = "SELECT * FROM popularpackage LIMIT 6";
            $result = $conn->query($sql);

            // Display data in cards
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<img src="' . $row["pimage"] . '" alt="' . $row["package_name"] . '">';
                    echo '<h1 class="card-title">' . $row["package_name"] . '</h1>';
                    echo '<div class="card-buttons">';
                    echo '<button class="edit-button">Edit</button>';

                    // Add confirmation dialog to delete button
                    echo '<form method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">';
                    echo '<input type="hidden" name="delete_id" value="' . $row["id"] . '">';
                    echo '<input type="hidden" name="confirm_delete" id="confirm_delete" value="">'; // Hidden input for confirmation
                    echo '<button type="submit" class="delete-button">Delete</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                }

                // Display "Add Package" button for remaining cards
                $remainingCards = 6 - $result->num_rows;
                for ($i = 0; $i < $remainingCards; $i++) {
                    echo '<div class="add-popular" id="addPackageButton"><a href="#" onclick="openModal(\'myModal\')"><i class="fas fa-plus"></i> Add Package</a></div>';
                }
            } else {
                // Show 6 "Add Package" buttons if no data is found
                for ($i = 0; $i < 6; $i++) {
                    echo '<div class="add-popular" id="addPackageButton"><a href="#" onclick="openModal(\'myModal\')"><i class="fas fa-plus"></i> Add Package</a></div>';
                }
            }

            // Close database connection
            $conn->close();
            ?>

            <!-- The Modal -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('myModal')">&times;</span>
                    <h2>Add Popular Package</h2>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="package_name" required>
                        <label for="description">Description</label>
                        <textarea id="description" name="pdescription" required></textarea>
                        <input type="file" id="fileInput" name="pimage" required>
                        <button type="submit" class="button-submit">Submit</button>
                    </form>
                </div>
            </div>

            <!-- JavaScript function for confirmation dialog -->

        </div>


        <!-- all package section  -->

        <div class="allpack">
            <div class="package-list">
                <h2>Package List</h2>
                <button class="button addallpack" onclick="openModal('myModalAll')">Add Packages</button>

                <!-- php code to show data -->
                <?php
                require '../connect.php';

                // Retrieve all packages from the database
                $sql = "SELECT * FROM packages";
                $result = $conn->query($sql);

                // Store the results in an array
                $all_packages = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $all_packages[] = $row;
                    }
                }


                // Handle deletion of package
                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    $delete_query = "DELETE FROM packages WHERE package_id = ?";
                    if ($stmt = $conn->prepare($delete_query)) {
                        $stmt->bind_param("i", $id);
                        if (!$stmt->execute()) {
                            handleError("Error executing statement: " . $stmt->error);
                        }
                        $stmt->close();
                        handleError("Package deleted successfully");
                    } else {
                        handleError("Error preparing statement: " . $conn->error);
                    }
                }
                


                // Close the database connection
                $conn->close();
                ?>

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
                    <tbody>
                        <?php foreach ($all_packages as $package): ?>
                            <tr>
                                <td><?php echo $package['package_id']; ?></td>
                                <td><?php echo $package['package_title']; ?></td>
                                <td>
                                    <?php
                                    $images = json_decode($package['package_image'], true);
                                    if (!empty($images)) {
                                        foreach ($images as $image) {
                                            echo "<img src='image/{$image}' alt='{$package['package_title']}' style='width:100px;height:100px;'>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php echo $package['package_description']; ?></td>
                                <td><?php echo $package['package_duration']; ?> Days</td>
                                <td><?php echo $package['package_creator']; ?></td>
                                <td>
                                    <a href="edit_package.php?id=<?php echo $package['package_id']; ?>"
                                        class="button edit">Edit
                                    </a>

                                    <button class="button delete" onclick="return confirm('Are you sure you want to delete this package?');">Delete</button>


                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pop up to add package-->
            <div id="myModalAll" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('myModalAll')">&times;</span>
                    <h2>Add All Package</h2>
                    <form>
                        <label for="packageTitle">Package Title</label>
                        <input type="text" id="nameAll" name="packageTitle" required>

                        <label for="packagedescription">Package_Description</label>
                        <textarea id="packagedescription" name="packagedescription" required></textarea>

                        <label for="packageTitle">Package Duration</label>
                        <input type="number" id="packageduration" name="packageduration" required>

                        <input type="file" id="packageimage" required>
                        <button type="submit" class="button-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="btn-field">
            <button type="button" class="packbutton popular">Popular Tour</button>
            <button type="button" class="packbutton packall">Packages</button>
        </div>
    </section>
</body>
<script src="main.js"></script>

<script>
    function confirmDelete() {
        // Show confirmation dialog
        var result = confirm("Are you sure you want to delete this package?");
        if (result) {
            document.getElementById('confirm_delete').value = 'yes'; // Set confirmation value
            return true; // Allow form submission
        } else {
            return false; // Cancel form submission
        }
    }
</script>

</html>