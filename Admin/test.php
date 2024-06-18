<!DOCTYPE html>
<html>

<head>
    <title>Popular Packages</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: sans-serif;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            width: 200px;
            height: 200px;
            margin: 10px;
            border: 1px solid white;
            position: relative;
            overflow: hidden;
            background-color: #222;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card.package-name {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 14px;
        }

        .add-package {
            width: 200px;
            height: 200px;
            margin: 10px;
            border: 1px solid white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .add-package i {
            font-size: 30px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #f1f1f1;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Popular Packages</h1>
    <div class="container">
        <?php
        require '../connect.php';

        // Fetch data from the database
        $sql = "SELECT * FROM popularpackage";
        $result = $conn->query($sql);

        // Display data in cards
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="' . $row["pimage"] . '" alt="' . $row["package_name"] . '">';
                echo '<div class="package-name">' . $row["package_name"] . '</div>';
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
                    $package_description = $_POST["package_description"];

                    // Insert data into the database
                    $sql = "INSERT INTO popularpackage (package_name, pimage, pdescription) VALUES (?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $package_name, $pimage, $package_description);
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

                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Add Package</h2>
                <form id="add-package-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                    enctype="multipart/form-data">
                    <label for="pimage">Image:</label>
                    <input type="file" id="pimage" name="pimage"><br><br>
                    <label for="package_name">Package Name:</label>
                    <input type="text" id="package_name" name="package_name"><br><br>
                    <label for="package_description">Package Description:</label>
                    <textarea id="package_description" name="package_description"></textarea><br><br>
                    <input type="submit" value="Add Package">
                </form>
            </div>
        </div>
    </div>



</body>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.querySelectorAll(".add-package a");
    var span = document.getElementsByClassName("close")[0];

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
</script>

</html>