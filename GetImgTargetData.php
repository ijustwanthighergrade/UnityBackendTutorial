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
    $sql = "SELECT TargetId FROM img_target WHERE TargetName ='". $detected_targetname."'";
    $result = $conn->query($sql);
    $targetId;
    //從hashtag relationship找出與imgtarget相關的tagid //將tagid存進陣列中
    if ($result->num_rows > 0) {
        $TagIds = array();
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $targetId = $row["TargetId"];
        }
        // echo "here you go: ";
        // var_dump($targetId); // 將查詢結果輸出為字符串
        // echo $targetId."<br>";
        //從hashtag_relationship抓此TARGETID(OBJID)相關的TagID
        $TagIds=array();

        $sql = "SELECT TagId FROM hashtag_relationship WHERE ObjId ='". $targetId."' and Status='1'";
        // echo $sql;
        $tagResult = $conn->query($sql);
        // echo "here you go2: ";
        // var_dump($tagResult); // 將查詢結果輸出為字符串

        if ($tagResult ->num_rows > 0) {
            while($tagrelationRow = $tagResult->fetch_assoc()) {
                $TagIds[] = $tagrelationRow["TagId"];
            }

        //對每個查詢到的相關tagid查找其資訊
            $TagNames=array();
            foreach ($TagIds as $TagId) {
                $sql = "SELECT * FROM hashtag WHERE TagId ='". $TagId."' and Status='1'" ;
                $tagNameResult = $conn->query($sql);

                if ($tagNameResult ->num_rows > 0) {
                    while ($tagNameData = $tagNameResult->fetch_assoc()) {
                        $TagNames[]= $tagNameData;
                        // echo "here you go3: ";
                        // var_dump($tagResult); // 將查詢結果輸出為字符串
                    }
                }
                else{
                    echo "cannot find hashtagname";
                }
            }
            
            // print_r($TagNames);
            $data = array(
                "hashtags" => $TagNames
            );
        
            $jsonData = json_encode($data);
            header('Content-Type: application/json');
            echo $jsonData;
            // $jsonData = json_encode($TagNames);
            // header('Content-Type: application/json');
            // echo $jsonData;

        }else {
            echo "cannot find relationship<br>";
        }
        // print_r($TagIds);
        // echo "<br>";

    } else {
        echo "cannot find targetid<br>";
    }
    
    $conn->close();
?>