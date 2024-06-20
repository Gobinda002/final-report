<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="finalpack.css">
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

            // Handle delete request
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
                $package_id = $_POST['delete_id'];

                // Delete the package from the database
                $sql = "DELETE FROM popularpackage WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $package_id);
                $stmt->execute();

                // Display success message using SweetAlert
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>
                        Swal.fire("Deleted!", "Package has been deleted.", "success").then(function() {
                            window.location.href = window.location.href; // Refresh the page
                        });
                      </script>';

                // Close database connection
                $conn->close();
                exit;
            }

            // Fetch data from the database
            $sql = "SELECT * FROM popularpackage";
            $result = $conn->query($sql);

            // Display data in cards
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {

                    echo '<div class="card">';
                    echo '<img src="' . $row["pimage"] . '" alt="' . $row["package_name"] . '">';
                    echo '<h1 class="card-title">' . $row["package_name"] . '</h1>';
                    echo ' <div class="card-buttons">
                        <button class="edit-button">Edit</button>
                        <button class="delete-button">Delete</button>
                    </div>';
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
                    <?php
                    require '../connect.php';
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $pimage = $_FILES["pimage"]["name"];
                        $package_name = $_POST["package_name"];

                        // Insert data into the database
                        $sql = "INSERT INTO popularpackage (package_name, pimage) VALUES (?,?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $package_name, $pimage);
                        $stmt->execute();

                        // Close database connection
                        $conn->close();

                        // Display success message using SweetAlert
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>Swal.fire("Success!", "Package added successfully!", "success").then(function() {
                              window.location.href = window.location.href; // Refresh the page
                          });</script>';
                        exit;

                    }
                    ?>

                    <span class="close" onclick="closeModal('myModal')">&times;</span>
                    <h2>Add Popular Package</h2>
                    <form>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name">
                        <label for="description">Description</label>
                        <textarea id="description" name="description"></textarea>
                        <input type="file" id="fileInput">
                        <button type="submit" class="button-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        </div>

        </div>


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
                                        class="button edit">Edit</a>
                                    <a href="packages.php?delete=<?php echo $package['package_id']; ?>"
                                        class="button delete"
                                        onclick="return confirm('Are you sure you want to delete this package?');">Delete</a>
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
                        <label for="nameAll">Name</label>
                        <input type="text" id="nameAll" name="nameAll">
                        <label for="descriptionAll">Description</label>
                        <textarea id="descriptionAll" name="descriptionAll"></textarea>
                        <input type="file" id="fileInputAll">
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

</html>