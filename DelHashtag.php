<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname="tictagtoe"; 
    //新增 public hashtag
    //variables user input
    $user=$_POST["username"];
    $addedhashtag=$_POST["addedhashtag"];
    // $user="abc";
    // $detected_targetname="tictagtoe";
    // $addedhashtag="search";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // echo $detected_targetname."<br>";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        //現在時間
        $sql = "UPDATE `hashtag` SET `Status`='0' WHERE `TagId`='".$addedhashtag."' and `Owner`='".$user."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql1 = "UPDATE `hashtag_relationship` SET `Status`='3' WHERE `TagId`='".$addedhashtag."'";
            $result1 = $conn->query($sql1);
            if ($result1 === TRUE && $result === TRUE) {
                echo "1";
            } else {
                echo "Error: " . $conn->error;
            }
        }
        else{
            echo "Error: " . $conn->error;
        }
    }

    

   
      
    $conn->close();
?>