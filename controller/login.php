<?php


if(isset($_POST['email']) && isset($_POST['password'])) {
    
    $cURLConnection = curl_init('http://localhost:8888/parcelme/api/login');
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $_POST);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    
    $apiResponse = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    $apiResponse = json_decode($apiResponse,TRUE);
    
//    var_dump($apiResponse);
//     exit;

    if(isset($apiResponse) && $apiResponse){

        if(!isset($apiResponse['token'])){

            header('Location: ../dashboard/login.php');
            exit;

        }   

        setcookie('token', $apiResponse['token'], time()+24*60*60, "/");

        header('Location: ../dashboard');
        exit;

    }else{
        
        header('Location: ../dashboard/login.php');
        exit;

    }
}


?>