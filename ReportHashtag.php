<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname="tictagtoe"; 
    //新增 public hashtag
    //variables user input
    $user=$_POST["username"];
    $addedhashtag=$_POST["addedhashtag"];
    $detected_targetname=$_POST["imagetarget"];
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
        $sql = "SELECT TargetId FROM img_target WHERE TargetName ='". $detected_targetname."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $targetId = $row["TargetId"];
            }
            $now = date('Y-m-d H:i:s');
            $createTagid = "F".date('mdHis');
            $sql = "INSERT INTO `feedback`(`DataId`, `MemId`, `TagId`, `Content`, `CreateTime`,`TargetId`,`Type`) VALUES ('".$createTagid."','".$user
            ."','".$addedhashtag."','不適當的tag','".$now."','".$targetId."','1')";
        
            if ($conn->query($sql) === TRUE) {
                echo "Report success";
            }
            else{
                echo "Report error" ;
            }
        }
    }
   
      
    $conn->close();
?>