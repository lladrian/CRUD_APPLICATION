<?php
    
    $servername = "localhost";
    $username = "id17963706_root";
    $password = "@LuckyMe11";
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=id17963706_lab_info", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password =$_POST['password'];

    
   
 if ($fullname==="" || $email==="" || $password==="") {
echo "Fill in the blanks!";
 } else {
     $sql = "SELECT * FROM java_users2 WHERE email = '$email'";
     $stmt = $conn->query($sql);

     if($stmt->rowCount() > 0){
        echo "User already exist!";
     }else{
         $data = [
            'fullname' => $fullname,
            'emailaddress' => $email,
            'password' => $password,
        ];
      /*  $data = [
            'fullname' => $fullname,
            'emailaddress' => $email,
            'password' => md5($password),
        ];*/
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid Email Address";
        } else {
             $sql = "INSERT INTO java_users2 (fullname, email, password) VALUES (:fullname, :emailaddress, :password)";
            $stmt= $conn->prepare($sql);
            $stmt->execute($data);
           if($stmt->rowCount() > 0){
              echo "Register successfully!";
           }
        }

   }
 }

	
	
?>