<?php 
    $cURLConnection = curl_init('http://localhost:8888/parcelme/api/ptype');
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $_POST);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $apiResponse = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    $apiResponse = json_decode($apiResponse,TRUE);
 
     

        
         header('Location: ../dashboard/addParcel.php');

?>