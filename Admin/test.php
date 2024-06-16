<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Example</title>
    <style>
        .card {
            border: 1px solid #000;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            width: 200px;
            text-align: center;
        }
        .card .add-button {
            display: none;
        }
        .card.empty .add-button {
            display: block;
        }
        .card.empty .content {
            display: none;
        }
    </style>
</head>
<body>
    <div id="card-container" class="card">
        <div class="content"></div>
        <button class="add-button">Add</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('index.php?action=getCard')
                .then(response => response.json())
                .then(data => {
                    const cardContainer = document.getElementById('card-container');
                    const contentDiv = cardContainer.querySelector('.content');
                    const addButton = cardContainer.querySelector('.add-button');

                    if (data.isEmpty) {
                        cardContainer.classList.add('empty');
                    } else {
                        contentDiv.textContent = data.content;
                        addButton.style.display = 'none';
                    }
                });
        });
    </script>
</body>
</html>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'getCard') {
    header('Content-Type: application/json');

    // Mock database query result
    // In a real application, you would query your database here
    $card = [
        'content' => '',  // Set to empty to simulate no data
        'isEmpty' => true // Change to false if there's data
    ];

    // Example with data (uncomment to simulate data present)
    // $card = [
    //     'content' => 'Card content from database',
    //     'isEmpty' => false
    // ];

    echo json_encode($card);
    exit;
}
?>
