<?php

    if (isset($_COOKIE['token'])) {

        unset($_COOKIE['token']); 
        setcookie('token', null, -1, '/'); 


    }

    header('Location: ../dashboard/login.php');
    exit;