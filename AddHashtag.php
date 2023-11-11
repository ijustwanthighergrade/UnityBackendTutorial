<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname="tictagtoe"; 
    //新增 public hashtag
    //variables user input
    $user=$_POST["username"];
    $detected_targetname=$_POST["detected_targetname"];
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
            
        $createTagid = "H".date('mdHis');

        //img_target獲取targetid 以便填寫hashtag_relationship
        $sql = "SELECT TargetId FROM img_target WHERE TargetName ='". $detected_targetname."'";
        $result = $conn->query($sql);
        $targetId;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $targetId = $row["TargetId"];
            }
            $sql = "INSERT INTO `hashtag`(`TagId`, `TagName`, `TagType`, `Owner`, `Status`, `Description`, `CreateTime`) VALUES "
            ."('".$createTagid."','".$addedhashtag."','4','".$user."','2','','".$now."')";
            
            if ($conn->query($sql) === TRUE) {

                $sql = "INSERT INTO `hashtag_relationship`(`TagId`, `ObjId`, `RelationshipType`, `Status`, `CreateTime`) VALUES"
                ." ('".$createTagid."','".$targetId."','1','0','".$now."')"; 
                if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                }else {
                    echo "hashtagrelationoship create failed";
                }


            } else {
                echo $createTagid." hashtag create failed";
            }

        }




    }

    

   
      
    $conn->close();
?>