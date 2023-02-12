<?php
header("Content-Type:application/json");
function GetIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}
if (isset($_GET['license']) && $_GET['license']!="") {
    $con = mysqli_connect("localhost","Unnamed","Root123@","pixelac"); 
    if (mysqli_connect_errno()){ 
        echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
        die(); 
    } 
    $license = $_GET['license'];
    $result = mysqli_query($con,"SELECT * FROM licenses WHERE License='$license'");
    if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_array($result);
        $expire = $row['Expire'];
        $ip = $row['IP'];
        $verify = $row['Verify'];
        $servername = $row['Servername'];
        $Date = $row['Date'];
        $Active = $row['Active'];
        $reason = $row['Reason'];

        if ($ip==GetIp()){
            if ($verify =="true"){

                if ($Active=="true"){

                    response($license, $expire, $ip, $Active,$servername,$Date);

                }else{
                    
                    response(null, null, null, false, null,null , "Your License inActive");

                }
            }else{
                response(null, null, null, false, null,null , "Your License Disabled By Modrator");
            }
        }else{

            response(null, null, null, false, null,null , "Your IP Does Not Match With License");

        }

        mysqli_close($con);

    }else{

        response(null, null, null, false, null, null, "Your license is not valid");
    }

}else{

    response(null, null, null, false, null, null, "License has not set!");

}

function response($license,$expire,$ip,$Active,$servername,$Date,$reason=null) {
    if ($license == null) {
        $response['Reason'] = $reason;
        $response['Active'] = $Active;
        $response['RealIP'] = $_SERVER['REMOTE_ADDR'];

    } else {
        $response['License'] = $license;
        $response['Expire'] = $expire;
        $response['IP'] = $ip;
        $response['Servername'] = $servername;
        $response['Date'] = $Date;
        $response['Realip'] = $_SERVER['REMOTE_ADDR'];
        if($reason != null) {
            $response['Reason'] = $reason;
        }
        $response['Active'] = $Active;
        
    }
    $json_response = json_encode($response);
    echo $json_response;
}
?>