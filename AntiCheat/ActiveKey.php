<?php
  $con=mysqli_connect("localhost","Unnamed","Root123@","pixelac");

  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql="SELECT License FROM licenses ORDER BY id";
  $sql2="SELECT steamhex FROM globalban ORDER BY id";

  if ($result=mysqli_query($con,$sql)){
    if ($result2=mysqli_query($con,$sql2))
    {

    $rowcount=mysqli_num_rows($result);
    $rowcount2=mysqli_num_rows($result2);
    response($rowcount, $rowcount2); 
    mysqli_free_result($result2);
    mysqli_free_result($result);
    }

  }
  function response($keys,$bans){ 
    $response['Keys'] = $keys; 
    $response['Bans'] = $bans; 
    $json_response = json_encode($response); 
    echo $json_response; 
} 

  mysqli_close($con);
?>