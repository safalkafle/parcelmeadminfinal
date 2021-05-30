<?php
    include 'doodle/doodle.php';
    Api::get('/admin',function(){
        $sql = 'SELECT * FROM admin';
        $response = Database::query($sql);
        Api::send($response);
    });

    Api::post('/login',function(){
        if(!isset($_POST['email']) || !isset($_POST['password'])) Api::send("email and password required");
        $sql = "SELECT admin_email as email, admin_password as password FROM admin where admin_email=? and admin_password=?;";
        $response = Database::query($sql, $_POST['email'], $_POST['password']);
        if(count($response) != 1) Api::send("user not found");
        $token = Token::create($response);
        $data = [
            'token' => $token,
        ];
        Api::send($data);
    });

    //user register
    Api::post('/userRegister',function(){
        if(!isset($_POST['users_email']) || !isset($_POST['users_password']) || !isset($_POST['users_name'])) Api::send("Please fill all fields");
        $sql = "SELECT users_email FROM users where users_email=?;";
        $email_check = Database::query($sql, $_POST['users_email'],);
        if(count($email_check) >0) Api::send(['success'=>false,'msg'=>"Email Already Exists."]);
        $sql = 'INSERT INTO users (users_email, users_password,users_name) VALUES (?, ?, ?) ';
        $response = Database::query($sql, $_POST['users_email'], md5($_POST['users_password']), $_POST['users_name']);
        $response1 = Database::query('SELECT * FROM users WHERE users_id=?',$response['inserted_id']);

        $token = Token::create($response1[0]);
            $data = [
                'token' => $token,
                'data'=> $response1[0]
            ];
        Api::send($data);
    });

    //user register step 2
    Api::post('/userRegister2',function(){

        $token = Token::verify($_POST['token']);

        if(!$token) API::send("Invalid Token");

        if(!isset($_POST['users_country'])
            || !isset($_POST['users_province'])
            || !isset($_POST['users_district'])
            || !isset($_POST['users_address'])
            || !isset($_POST['users_phone'])) Api::send("Please fill all fields");

        $sql = 'UPDATE users SET users_country=?,users_province=?,users_district=?,users_address=?,users_phone=? WHERE users_id=?';

        $response = Database::query($sql, $_POST['users_country'], $_POST['users_province'],$_POST['users_district'], $_POST['users_address'], $_POST['users_phone'], $token['users_id']);
        if($response && $response['affected_rows'] > 0) {
            $payload = Database::query('SELECT * FROM users WHERE users_id=?', $token['users_id'])[0];
            Api::send([
                "token" => Token::create($payload),
                "data"=> $payload
            ]);
        }
        Api::send("Server Error Occured");
    });

    Api::post('/changePass',function(){

        $token = Token::verify($_POST['token']);

        if(!$token) API::send("Invalid Token");

        if(!isset($_POST['oldPass'])
            || !isset($_POST['users_password']) ) Api::send("Please fill all fields");

        $sql = 'UPDATE users SET users_password=? WHERE users_id=? AND users_password=?';

        $response = Database::query($sql, md5($_POST['users_password']), $token['users_id'], md5($_POST['oldPass']));

        if($response && $response['affected_rows'] > 0) {

            $payload = Database::query('SELECT * FROM users WHERE users_id=?', $token['users_id'])[0];

            Api::send([
                "token" => Token::create($payload),
                "data"=> $payload
            ]);
        }else{
            Api::send("Incorrect Old Password");
        }

        Api::send("Server Error Occured");
    });

    //userlogin
    Api::post('/userlogin',function(){
        if(!isset($_POST['users_email']) || !isset($_POST['users_password'])) Api::send("email and password required");

        $sql = "SELECT * FROM users where users_email=? AND users_password=?";
        $response = Database::query($sql, $_POST['users_email'],md5($_POST['users_password']));

        if(count($response) != 1) Api::send("user not found");

        $token = Token::create($response[0]);
        $data = [
            'token' => $token,
            'data' => $response[0],
        ];
        Api::send($data);
    });

    
    Api::post('/updateOrderStatus',function(){
        if(!isset($_POST['order_id'])
            || !isset($_POST['status_id']) ) Api::send("Please fill all fields");

        $sql = 'UPDATE order_status SET status_id=? WHERE order_id=?';

        $response = Database::query($sql, $_POST['status_id'], $_POST['order_id']);

        if($response && $response['affected_rows'] > 0) {
            Api::send([
                "success" => true,
                "msg"=> "Status Updated Successfully"
            ]);
        }else{
            Api::send("Could Not Update Status");
        }

        Api::send("Server Error Occured");
    });


    Api::post('/ptype',function(){
        $sql = 'INSERT INTO parcel_catagory (parcel_type, parcel_cost) VALUES (?, ?) ';
        $response = Database::query($sql, $_POST['ptype'], $_POST['pcost']);
        Api::send($response);
    });

    Api::get('/ptype/all',function(){
        $sql = 'SELECT * FROM parcel_catagory';
        $response = Database::query($sql);
        Api::send($response);
    });

    Api::post('/ptype/delete',function(){
        $sql = 'DELETE FROM parcel_catagory where parcel_catagory_id = ?';
        $response = Database::query($sql, $_POST['deleteID']);
        Api::send($response);
    });

    Api::get('/users/all',function(){
        $sql = 'SELECT users_id, users_name, users_email, users_address, users_phone FROM users';
        $response = Database::query($sql);
        Api::send($response);
    });

    Api::get('/user/total', function(){
        $sql = 'Select * FROM users';
        $response = Database::query($sql);
        Api::send($response);
    });

    Api::get('/ptype/total', function(){
        $sql = 'Select * FROM parcel_catagory';
        $response = Database::query($sql);
        Api::send($response);
    });

    Api::post('/parcelHistory', function(){

            $token = Token::verify($_POST['token']);
            if(!$token) API::send("Invalid Token");

            $sql = 'SELECT dd.*, ord.*, par.*, pc.* FROM delivery_details as dd LEFT JOIN orders as ord ON dd.delivery_details_id = ord.delivery_details_id LEFT JOIN parcel as par ON par.order_id = ord.order_id LEFT JOIN parcel_catagory as pc ON pc.parcel_catagory_id = par.parcel_catagory_id WHERE ord.users_id = ?';
            $response = Database::query($sql,$token['users_id']);

            Api::send($response);

    });

    Api::get('/getAllOrders', function(){

        $sql = 'SELECT dd.*, ord.*, par.*, pc.*,user.*,os.status_id,st.statu_type FROM delivery_details as dd LEFT JOIN orders as ord ON dd.delivery_details_id = ord.delivery_details_id LEFT JOIN parcel as par ON par.order_id = ord.order_id LEFT JOIN parcel_catagory as pc ON pc.parcel_catagory_id = par.parcel_catagory_id LEFT JOIN users as user ON user.users_id = ord.users_id LEFT JOIN order_status as os ON os.order_id = ord.order_id LEFT JOIN status as st on st.status_id = os.status_id';
        $response = Database::query($sql);
        Api::send($response);

});

    Api::post('/trackparcel', function(){

        $token = Token::verify($_POST['token']);
        if(!$token) API::send("Invalid Token");

        $sql = 'SELECT dd.*, ord.*, par.*, pc.*,os.status_id,st.statu_type FROM delivery_details as dd LEFT JOIN orders as ord ON dd.delivery_details_id = ord.delivery_details_id LEFT JOIN parcel as par ON par.order_id = ord.order_id LEFT JOIN parcel_catagory as pc ON pc.parcel_catagory_id = par.parcel_catagory_id LEFT JOIN order_status as os ON os.order_id = ord.order_id LEFT JOIN status as st on st.status_id = os.status_id  WHERE ord.users_id = ? AND os.status_id IS NOT NULL';
        $response = Database::query($sql,$token['users_id']);

        Api::send($response);

    });

    Api::post('/parcelAdd',function(){

            $token = Token::verify($_POST['token']);

            if(!$token) API::send("Invalid Token");

            if(!isset($_POST['delivery_email']) 
                || !isset($_POST['category_id']) 
                || !isset($_POST['receiver_name']) 
                || !isset($_POST['delivery_country']) 
                || !isset($_POST['delivery_province']) 
                || !isset($_POST['delivery_zone']) 
                || !isset($_POST['delivery_address']) 
                || !isset($_POST['delivery_phone']) 
                || !isset($_POST['delivery_district'])) Api::send("Please fill all fields");

            $sql_delivery_address = 'INSERT INTO delivery_details (delivery_email, receiver_name, delivery_country, delivery_province, delivery_district, delivery_zone, delivery_address, delivery_phone) VALUES (?,?,?,?,?,?,?,?)';
            $response_delivery_address = Database::query($sql_delivery_address, $_POST['delivery_email'], $_POST['receiver_name'],$_POST['delivery_country'], $_POST['delivery_province'], $_POST['delivery_district'], $_POST['delivery_zone'], $_POST['delivery_address'], $_POST['delivery_phone']);
            $delevery_details_id = $response_delivery_address['inserted_id'];

            $sql_history = 'INSERT INTO history (users_id, delivery_details_id) VALUES (?,?)';
            $response_history = Database::query($sql_history,$token['users_id'],$delevery_details_id);

            $sql_orders = 'INSERT INTO orders (users_id, delivery_details_id) VALUES (?,?)';
            $response_orders = Database::query($sql_orders,$token['users_id'],$delevery_details_id);
            $orders_id=$response_orders['inserted_id'];

            $sql_orders_status = 'INSERT INTO order_status (order_id) VALUES (?)';
            $response_order_status = Database::query($sql_orders_status,$orders_id);

            $sql_parcel='INSERT INTO parcel (order_id, parcel_catagory_id) VALUES (?,?)';
            $response_parcel = Database::query($sql_parcel,$orders_id,$_POST['category_id']);

            Api::send([
                "success"=>'true',
                "msg"=>"Data Submitted Successfully"
            ]);

    });



?>