<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="BASPP_style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/header.jpg" alt="">
      </div>

      <div class="content">
         <h3>Our Mission</h3>
         <p>Our purpose is to sustainably reduce e-waste by allowing customers 
            to sell their pre-owned phones and to afford used phones at a reasonable price.</p>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Our Team</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>CEO & Founder</p>
         <h3>John Deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>Designer</p>
         <h3>Adam Mal</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>Developer</p>
         <h3>Mickey</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">Why pre-owned devices?</h1>

   <div class="box-container">

      <div class="box">
         <i class="bi bi-phone"></i>
         <h3>UP TO 60 elements to make 1 smartphone.</h3>
      </div>

      <div class="box">
         <i class="bi bi-trash"></i>
         <h3>OVER 50 MILLION metric tonnes of e-waste to rise.</h3>
      </div>

      <div class="box">
         <i class="bi bi-recycle"></i>">
         <h3>968 TWH Energy used from 2007 to 2017.</h3>
      </div>

     
   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>