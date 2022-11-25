<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');


   }else{
      $message[] = 'incorrect email or password!';
   }
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- custom css file link  -->
        <link rel="stylesheet" href="BASPP_style.css">

    </head>
    <body>
	
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

        <div class="container">
            <h1>Welcome to BASPP</h1>
            <h3>*Please register or sign in to access the page of BASPP</h3>


            <div class="form-container">

                <form action="" method="post">
                    <h3>login now</h3>
                    <input type="email" name="email" placeholder="Email" required class="box">
                    <input type="password" name="password" placeholder="Password" required class="box">
                    <input type="submit" name="submit" value="login now" class="btn">
                    <p>Don't have an account? <a href="register.php">Register now</a></p>
                </form>

            </div>
        </div>

    </body>
</html>