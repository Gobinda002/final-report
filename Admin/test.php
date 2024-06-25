<?php
require '../connect.php';

// Handle deletion of popular package
if (isset($_GET['remove_popular'])) {
    $id = $_GET['remove_popular'];
    $update_query = "UPDATE packages SET is_popular = 0 WHERE package_id = ?";
    if ($stmt = $conn->prepare($update_query)) {
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            handleError("Error executing statement: " . $stmt->error);
        }
        $stmt->close();
    } else {
        handleError("Error preparing statement: " . $conn->error);
    }
}

// Handle marking a package as popular
if (isset($_GET['make_popular'])) {
    $id = $_GET['make_popular'];
    $update_query = "UPDATE packages SET is_popular = 1 WHERE package_id = ?";
    if ($stmt = $conn->prepare($update_query)) {
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            handleError("Error executing statement: " . $stmt->error);
        }
        $stmt->close();
        echo "Package marked as popular successfully";
    } else {
        handleError("Error preparing statement: " . $conn->error);
    }
}

// Handle deletion of Allpackage
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM packages WHERE package_id = ?";
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            handleError("Error executing statement: " . $stmt->error);
        }
        $stmt->close();
        echo "Package deleted successfully";
    } else {
        handleError("Error preparing statement: " . $conn->error);
    }
}

// Handle addition of Allpackages
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_title = isset($_POST['package_title']) ? htmlspecialchars(trim($_POST['package_title'])) : '';
    $package_description = isset($_POST['package_description']) ? htmlspecialchars(trim($_POST['package_description'])) : '';
    $package_duration = isset($_POST['package_duration']) ? intval($_POST['package_duration']) : '';

    // Handle file upload
    $imagePaths = [];
    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $filename = basename($_FILES['images']['name'][$key]);
            $targetFile = $targetDir . $filename;
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $validExtensions = array('jpg', 'jpeg', 'png');
            if (!in_array($fileType, $validExtensions)) {
                handleError("Invalid file type: " . $filename);
            }

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $imagePaths[] = $filename;
            } else {
                handleError("Error uploading file: " . $filename);
            }
        }
    }

    $images_json = json_encode($imagePaths);

    $stmt = $conn->prepare("INSERT INTO packages (package_title, package_description, package_duration, package_image) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        handleError("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssis", $package_title, $package_description, $package_duration, $images_json);

    if ($stmt->execute()) {
        echo '<script>
                Swal.fire("Success!", "Package added successfully!", "success").then(function() {
                    window.location.href = window.location.href;
                });
            </script>';
    } else {
        handleError("Error: " . $stmt->error);
    }

    $stmt->close();
}

// Fetch all packages
$query_all = 'SELECT * FROM packages';
$result_all = mysqli_query($conn, $query_all);
$all_packages = [];

if ($result_all) {
    while ($row = mysqli_fetch_assoc($result_all)) {
        $all_packages[] = $row;
    }
} else {
    handleError("Error fetching all packages: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link rel="stylesheet" href="finalpack.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <header>
        <h1>NEPTOURS</h1>
        <nav>
            <ul>
                <li><a href="admin.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : ''; ?>">Dashboard</a></li>
                <li><a href="bookings.php">Bookings</a></li>
                <li><a href="user.php">Users</a></li>
                <li><a href="test.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'test.php' ? 'active' : ''; ?>">Packages</a></li>
                <li><a href="../login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="packages container">
        <div class="popularpack">
            <?php
            require '../connect.php';

            // Fetch popular packages
            $sql = "SELECT * FROM packages WHERE is_popular = 1 LIMIT 6";
            $result = $conn->query($sql);
            $popular_packages = [];

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $popular_packages[] = $row;
                }
            }

            if (!empty($popular_packages)) {
                foreach ($popular_packages as $row) {
                    $images = json_decode($row["package_image"], true);
                    echo '<div class="card">';
                    if (!empty($images)) {
                        foreach ($images as $image) {
                            echo "<img src='uploads/{$image}' alt='{$row["package_title"]}' class='card-image'>";
                        }
                    }
                    echo '<h1 class="card-title">' . $row["package_title"] . '</h1>';
                    echo '<div class="card-buttons">';
                    echo '<button href="test.php?remove_popular=' . $row["package_id"] . '" class="delete-button">Remove from Popular</button>';
                    echo '</div>';
                    echo '</div>';
                }

                $remainingCards = 6 - count($popular_packages);
                for ($i = 0; $i < $remainingCards; $i++) {
                    echo '<div class="add-popular" id="addPackageButton"><a href="#" onclick="openModal(\'myModal\')"><i class="fas fa-plus"></i> Add Package</a></div>';
                }
            } else {
                for ($i = 0; $i < 6; $i++) {
                    echo '<div class="add-popular" id="addPackageButton"><a href="#" onclick="openModal(\'myModal\')"><i class="fas fa-plus"></i> Add Package</a></div>';
                }
            }
            ?>
        </div>

        <div class="allpack">
            <div class="package-list">
                <h2>Package Lists</h2>
                <button class="button addpack" href="#" onclick="openModal('myModalAll')">Add Packages</button>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Package Title</th>
                            <th>Package Image</th>
                            <th>Package Description</th>
                            <th>Package Duration</th>
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
                                            echo "<img src='uploads/{$image}' alt='{$package['package_title']}' style='width:100px;height:100px;'>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php echo $package['package_description']; ?></td>
                                <td><?php echo $package['package_duration']; ?> Days</td>
                                <td>
                                    <a href="edit_package.php?id=<?php echo $package['package_id']; ?>" class="button edit">Edit</a>
                                    <a href="test.php?delete=<?php echo $package['package_id']; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this package?');">Delete</a>
                                    <a href="test.php?make_popular=<?php echo $package['package_id']; ?>" class="button select-popular">Select as Popular</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="myModalAll" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('myModalAll')">x</span>
                    <form id="loginForm" action="test.php" method="post" enctype="multipart/form-data">
                        <label for="packageName">Package Title:</label>
                        <input type="text" id="packageName" name="package_title" required>
                        <label for="description">Description:</label>
                        <textarea id="description" name="package_description" required></textarea>
                        <label for="duration">Duration:</label>
                        <input type="number" id="duration" name="package_duration" required>
                        <div id="imageContainer">
                            <label for="packageImages">Package Images:</label>
                            <input type="file" name="images[]" accept=".jpg, .jpeg, .png" required>
                            <input type="file" name="images[]" accept=".jpg, .jpeg, .png" required>
                            <input type="file" name="images[]" accept=".jpg, .jpeg, .png" required>
                            <input type="file" name="images[]" accept=".jpg, .jpeg, .png" required>
                        </div>
                        <label for="category">Category:</label>
                        <select id="category" name="category" required>
                            <option value="hiking">Hiking</option>
                            <option value="tours">Tours</option>
                            <option value="jungledafari">Jungle Safari</option>
                            <option value="rafting">Rafting</option>
                        </select>
                        <button type="submit" class="buton">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="btn-field">
            <button type="button" class="packbutton popular">Popular Tour</button>
            <button type="button" class="packbutton packall">Packages</button>
        </div>
    </section>

    <script src="main.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this package?");
        }
    </script>
</body>
</html>
