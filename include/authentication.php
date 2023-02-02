<?php 

    //if there is an error in login check whether database password column size is 10.if it is 10 update the column to 100.     
    include('connection.php');  
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
   
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);
        $password=md5($password);
        $sql = "select *from users where User_Name = '$username' and Password = '$password'"; 
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header("Location: http://localhost/NearBuy/index.php");
            exit();
        }  
        else{  
            //echo "<h1> Login failed. Invalid username or password.</h1>";  
            header("Location: http://localhost/NearBuy/login.php?error=Incorect User name or password");
            exit();
        }     
?>  