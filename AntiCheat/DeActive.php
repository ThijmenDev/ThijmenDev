<?php
$x1 = $_GET['x1'];
    if ($x1) {
        $conn = new mysqli("localhost","Unnamed","Root123@","pixelac"); 
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE licenses SET Verify='false' WHERE License='$x1'";
        $result = mysqli_query($conn, $sql);
		if($result){
            exit($result);
        } else {
            exit($result);
        }
    } else {
        exit("```Good Try To Hack ```");
    }
?>