<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Data to Database</title>
</head>
<body>

    <h2>Add Product Data to Database</h2>

    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection details
        $host = 'db';
        $username = 'db_user';
        $password = 'db_password';
        $db = 'mydatabase';
        $charset = 'utf8mb4';

        // Create a connection
        $conn = new mysqli($host, $username, $password, $db);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get data from the request
        $name = $conn->real_escape_string($_POST['name']);

        // Insert data into the database
        $sql = "INSERT INTO product (name) VALUES ('$name')";

        if ($conn->query($sql) === TRUE) {
            echo '<p>Data inserted successfully!</p>';
            
            // Redirect to index.php after successful submission
            header("Location: index.php");
            exit(); // Make sure to exit to prevent further execution
        } else {
            echo '<p>Error: ' . $sql . '<br>' . $conn->error . '</p>';
        }

        // Close the connection
        $conn->close();
    }
    ?>

    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>