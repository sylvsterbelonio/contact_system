<?php include 'layout/admin_header.php'; ?>
<?php include 'config/database.php'; ?>
<?php 


if(isset($_GET['id']) && isset($_SESSION['id'])){
     $id = $_GET['id'];
     $user_id = $_SESSION['id'];
     $sql="DELETE FROM contacts where id=$id and user_id=$user_id";
     $conn->query($sql);
     header("location: dashboard.php");
}else{
     header("location: index.php");
}


exit;

