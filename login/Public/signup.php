<?php

    require "../private/autoload.php"; 
    $Error = "";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = $_POST['email']; 
        if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email))
        {
            $Error = " Please enter a valid email address";
        }

        $PermissionsLvl = 0;
        $user_name = esc($_POST['user_name']); 

        $url_address = a(60);
     //   $url_address = "FixmeLater";

        $password = esc($_POST['password']);


        if ($Error == "") {
            
            //create an initialization vector for AES encryption
            $iv = openssl_random_pseudo_bytes(16);
            $encryptionKey = require 'retrieve.php';

            $query = "INSERT INTO users (url_address, user_name, password, email, PermissionsLvl) VALUES (:url_address, :user_name, :password, :email, :PermissionsLvl, :iv)";
    
            $stmt = $connection->prepare($query);
            
            $stmt->bindParam(':url_address', $url_address);
            $stmt->bindParam(':user_name', encrypt($user_name,$encryptionKey,$iv));
            $stmt->bindParam(':password', encrypt($password,$encryptionKey,$iv));
            $stmt->bindParam(':email', encrypt($email,$encryptionKey,$iv));
            $stmt->bindParam(':PermissionsLvl', encrypt($PermissionsLvl,$encryptionKey,$iv));
            //iv must also be saved into database
            $stmt->bindParam(':iv', $iv);

            echo $query;
            $stmt->execute();
    
        }

}

?>


<! DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>

<form method= "post">

        <div><?php
            if(isset($Error) && $Error != ""){

                echo $Error;

            }


        ?></div>



    <div>Signup</div>
    <input type="varchar" name="user_name" required><br><br>
    <input type="email" name="email" required><br><br>
    <input type="password" name="password" required><br><br>

    <input type= "submit" value= "signup">
</form>

</body>
</html>
