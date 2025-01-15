<?php include 'layout/header.php'; ?>
<?php include 'config/database.php'; ?>
<?php

session_start(); 
$setup=0;

if(!isset($_SESSION['email'])){
     header('location: index.php');
}
if(isset($_SESSION['setup'])){
     $setup = $_SESSION['setup']; 
     if($setup>0){
          header('location: dashboard.php');   
     }
}

?>

<p>Thank you for registering</p>
<a href="dashboard.php?setup=1" class="btn btn-primary" role="button">Continue</a>

<?php include 'layout/footer.php'; ?>