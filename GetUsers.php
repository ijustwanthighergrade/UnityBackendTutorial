<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname="tictagtoe"; 
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $sql = "SELECT MemId, Account, Password, Name FROM sys_admin";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "MemId: " . $row["MemId"]. " - Account: " . $row["Account"]. " - Password: " . $row["Password"]. " - Name: " . $row["Name"]."<br>";
    }
    } else {
    echo "0 results";
    }
    $conn->close();
?>