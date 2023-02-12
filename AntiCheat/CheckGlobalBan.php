<?php
$steamhex = $_GET['steamhex'];
$license = $_GET['license'];
$discord = $_GET['discord'];
$token = $_GET['token'];
$conn = new mysqli("localhost","Unnamed","Root123@","pixelac"); 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sqlid = "SELECT id FROM globalban";
$resultid = $conn->query($sqlid);
if ($resultid->num_rows > 0) {
    while($rowid = $resultid->fetch_assoc()) {
        $id = $rowid["id"];
    }
}
$sql = "SELECT id, steamhex, license, discord, token FROM globalban";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row["steamhex"] === $steamhex) {
            exit('{"data":true}');
        } else {
            if ($row["license"] === $license) {
                exit('{"data":true}');
            } else {
                if (($row["discord"] === $discord) && ($row["discord"] != "NONE")  ) {
                    exit('{"data":true}');
                } else {
                    if ($row["token"] === $token) {
                        exit('{"data":true}');
                    } else {
                        if ($row["id"] === $id) {
                            exit('{"data":false}');
                        }
                    }
                }
            }
        }
    }
}
$conn->close();
?>