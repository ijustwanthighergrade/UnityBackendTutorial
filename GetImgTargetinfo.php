<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname="tictagtoe"; 

    //variables user input
    $detected_targetname=$_POST["detected_targetname"];
    //$detected_targetname="tictagtoe";

    if($detected_targetname==null||$detected_targetname==""){
        $detected_targetname="tictagtoe";
    }
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo $detected_targetname."<br>";
    //展示用的目前名稱暫時以TARGETNAME為主鍵 為避免TARGETNAME重複 日後應以TARGETID為圖片名稱
    $sql = "SELECT Description FROM img_target WHERE TargetName ='". $detected_targetname."'";
    $result = $conn->query($sql);
    //從hashtag relationship找出與imgtarget相關的tagid //將tagid存進陣列中
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $description = $row["Description"];
        }
        echo  $description;

    } else {
        echo "cannot find target<br>";
    }
    
    $conn->close();
?>