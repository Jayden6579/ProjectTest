<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $coins = $_POST["coins"];

    // Establish a connection to the MySQL database
    $servername = "localhost";
    $username = "root";
    $password = ""; // Make sure your password is correct
    $dbname = "coincoin";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the table exists, and if not, create it
    $tableName = "game_scores";
    $createTableQuery = "CREATE TABLE IF NOT EXISTS $tableName (
        id INT AUTO_INCREMENT PRIMARY KEY,
        coins INT
    )";

    if ($conn->query($createTableQuery) === TRUE) {
        // Table created or already exists
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Insert the data into the database
    $sql = "INSERT INTO game_scores (coins) VALUES ('$coins')";
    if ($conn->query($sql) === TRUE) {
        echo "Data stored successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
