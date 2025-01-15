<?php include 'layout/admin_header.php'; ?>
<?php include 'config/database.php'; ?>

<?php

   $user_id = $_SESSION['id'];  

   $id = $name = $email = $company = $phone =  '';
   $nameErr =  '';

   if($_SERVER['REQUEST_METHOD']=='GET')
    {
      if(isset($_GET['id'])){

        $user_id = $_SESSION['id'];
        $id = $_GET['id'];

        $sql = "SELECT * from contacts where id=$id and user_id=$user_id";
        $result = $conn->query($sql);
        if(!$result){
            die('Invalid query:' . $conn->error);
        }

        if($result->num_rows==0){
          header('location: dashboard.php');
        }

        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $name = $row['name'];
            $company = $row['company'];
            $phone = $row['phone'];
            $email = $row['email'];
        }


      }
    }
   else
    {
      if (isset($_POST['submit'])) {
        // Validate name
        if (empty($_POST['name'])) {
          $nameErr = 'Name is required';
        } else {
          // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $name = filter_input(
            INPUT_POST,
            'name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
          );
        }
      
   
        if (empty($nameErr)) {
          // add to database
          $id = $_POST['id'] ?? 0;
          $user_id = $_POST['user_id'] ?? 1;
          $name = $_POST['name'] ?? '';
          $company = $_POST['company'] ?? '';
          $phone = $_POST['phone'] ?? '';
          $email = $_POST['email'] ?? '';

          $sql = "UPDATE contacts 
          SET name='$name', company='$company', phone='$phone', email='$email'
          WHERE id=$id and user_id=$user_id";
   
          if (mysqli_query($conn, $sql)) {
            // success
            header('Location: dashboard.php');
          } else {
            // error
            echo 'Error: ' . mysqli_error($conn);
          }
        }
      
      }
    }
// Form submit


?>

<nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">Contact System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Contacts</a>
          </li>
          <li class="nav-item">
            <a id="link-address" class="nav-link" href="logout.php?id=<?=$_SESSION['id']?>">Log out</a>
          </li>
        </ul>
      </div>
  </div>
</nav>

<main>
<div class="container d-flex flex-column align-items-center">



<h2>Update Contact</h2>
    <?php echo isset($name) ? $name : ''; ?>

    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">


      <input type="hidden" value="<?=$id?>" name="id"/>
      <input type="hidden" value="<?=$user_id?>" name="user_id"/>

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo !$nameErr ?:
          'is-invalid'; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          <?=$nameErr?>
        </div>
      </div>

      <div class="mb-3">
        <label for="company" class="form-label">Company</label>
        <input type="text" class="form-control <?php echo !$companyErr ?:
          'is-invalid'; ?>" id="email" name="company" placeholder="Enter your company" value="<?php echo $company; ?>">    
      </div>


      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control <?php echo !$phoneErr ?:
          'is-invalid'; ?>" id="email" name="phone" placeholder="Enter your phone" value="<?php echo $phone; ?>">         
      </div>


      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control <?php echo !$emailErr ?:
          'is-invalid'; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
      </div>


      <div class="mb-3">
        <input type="submit" name="submit" value="Update" class="btn btn-primary w-100">
        
      </div>
      <div class="mb-3">
      <div class="d-grid">
               <a href="dashboard.php"  class="btn btn-outline-danger" role="button">Cancel</a>
      </div>
        
      </div>
      


    </form>


<?php include 'layout/footer.php'; ?>