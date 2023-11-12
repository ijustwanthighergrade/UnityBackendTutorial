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

        $now = date('Y-m-d H:i:s');
        $createTagid = "F".date('mdHis');
        $sql = "INSERT INTO `feedback`(`DataId`, `MemId`, `TagId`, `Content`, `CreateTime`) VALUES ('".$createTagid."','".$user
        ."','".$addedhashtag."','不適當的tag','".$now."')";
     
        if ($conn->query($sql) === TRUE) {
            echo "成功回報";
        }
        else{
            echo "回報錯誤" ;
        }

    }
   
      
    $conn->close();
?>