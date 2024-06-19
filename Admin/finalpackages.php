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
                    echo '<div class="add-package" id="addPackageButton"><a href="#" onclick="openModal()"><i class="fas fa-plus"></i> Add Package</a></div>';
                }
            } else {
                // Show 6 "Add Package" buttons if no data is found
                for ($i = 0; $i < 6; $i++) {
                    echo '<div class="add-package" id="addPackageButton"><a href="#" onclick="openModal()"><i class="fas fa-plus"></i> Add Package</a></div>';
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


                    <!-- popup to add popular package  -->
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Add Package</h2>
                    <form id="add-package-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                        enctype="multipart/form-data">
                        <label for="pimage">Image:</label>
                        <input type="file" id="pimage" name="pimage" required><br><br>
                        <label for="package_name">Package Name:</label>
                        <input type="text" id="package_name" name="package_name" required><br><br>
                        <label for="package_name">Package Description:</label>
                        <textarea id="package_description" name="package_description"></textarea><br><br>
                        <input type="submit" class="button-submit" value="Add Package">
                    </form>
                </div>
            </div>
        </div>


        <div class="allpack">
            <div class="allpackages">
                sdas
            </div>


        </div>

        <div class="btn-field">
            <button type="button" class="packbutton popular ">Popular Tour</button>
            <button type="button" class="packbutton packall">Packages</button>
        </div>

    </section>
</body>


<script>
    var modal = document.getElementById("myModal");
    var btn = document.querySelectorAll(".add-package a");
    var span = document.getElementsByClassName("close")[0];

    //  for toogle
    const packageBtn = document.querySelectorAll('.btn-field .packbutton');
    const popularpack = document.querySelector('.popularpack');
    const allpack = document.querySelector('.allpack');


    // When the user clicks the button, open the modal
    for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function () {
            openModal();
        }
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        closeModal();
    }

    // Open the modal
    function openModal() {
        modal.style.display = "block";
    }

    // Close the modal
    function closeModal() {
        modal.style.display = "none";
    }


    // js to toogle between popular pack and all packages

    packageBtn.forEach(Option => {
        Option.addEventListener('click', () => {
            document.querySelector('.btn-field.popular').classList.remove('popular');
            Option.classList.add('popular');
        })
    })

    document.querySelector('.popular').addEventListener('click', () => {
        allpack.style.display = 'none';
        popularpack.style.display = 'grid';
    })

    document.querySelector('.packall').addEventListener('click', () => {
        allpack.style.display = 'grid';
        popularpack.style.display = 'none';
    })



</script>

</html>