<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname="tictagtoe"; 

    //variables user input
    $login_user=$_POST["login_user"];
    $login_pass=$_POST["login_pass"];

    $login_name=$_POST["login_name"];
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    $sql = "SELECT MemId, Account, Password FROM sys_admin WHERE Account ='". $login_user."'";
    $result = $conn->query($sql);

    $sqla = "SELECT Count(*) FROM sys_admin";
    $resulta = $conn->query($sqla);
    $value;
    if ($resulta->num_rows > 0) {
    // 讀取第一筆資料
        $row = $resulta->fetch_assoc();
        $value = $row["Count(*)"];

        // 將值加 1
        $new_value = $value + 1;
    }

    if ($result->num_rows > 0) {
    // output data of each row
        echo "Account is already exist";
    } else {
        $sql = "INSERT INTO sys_admin (MemId, Account,Name,Permissions,CreateTime, Password)
        VALUES ('".$value."', '".$login_user."', '".$login_name."', '1', '".date('Y-m-d')."', '".$login_pass."')";

        if ($conn->query($sql) === TRUE) {
        echo "Created successfully";
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

   
      
    $conn->close();
?>