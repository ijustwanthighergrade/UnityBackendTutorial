<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname="tictagtoe"; 

    //variables user input
    $login_user=$_POST["login_user"];
    $login_pass=$_POST["login_pass"];

    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    $thismemdata=array();
    $sql = "SELECT MemId, Email, Password FROM member WHERE Email ='". $login_user."' and Status='1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        //echo "MemId: " . $row["MemId"]. " - Email: " . $row["Email"]. " - Password: " . $row["Password"]. " - MemName: " . $row["MemName"]."<br>";
        while($row = $result->fetch_assoc()) {
            if($row["Password"]== $login_pass){
                
                $sql = "SELECT * FROM member WHERE Email ='". $login_user."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $thismemdata[]=$row; 
                    }
                    $data = array(
                        "members" => $thismemdata
                    );
                
                    $jsonData = json_encode($data);
                    header('Content-Type: application/json');
                    echo $jsonData;
                    // $jsonData = json_encode($thismemdata);
                    // header('Content-Type: application/json');
                    // echo $jsonData;
                }
            }
            else{
                echo 0;
            }
        }
    } 
    else {
        echo "Account not exist";
    }
    $conn->close();
?>