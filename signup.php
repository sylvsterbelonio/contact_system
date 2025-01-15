<?php include 'layout/header.php'; ?>
<?php include 'config/database.php'; ?>

<?php
// Set vars to empty values
session_start(); 

$name = $email = $password = $confirmPassword =  '';
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr =  '';

// Form submit
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

  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  // Validate body
  if (empty($_POST['password'])) {
    $passwordErr = '* Password is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(
      INPUT_POST,
      'password',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  // Validate body
  if (empty($_POST['confirm_password'])) {
    $confirmPasswordErr = '* Confirm Password is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_input(
      INPUT_POST,
      'confirm_password',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  //CHECK IF PASSWORD MUST MATCH!
  if(isset($_POST['password']) && $_POST['confirm_password']){
    if($_POST['password']!=$_POST['confirm_password']){
      $passwordErr = '* Password doest not match, please try again.';
    }
  }

  //CHECK IF EMAIL ALREADY EXISTED/////////////
  /////////////////////////////////////////////
  $sql = "SELECT * from users where email='$email'";
  $result = $conn->query($sql);
  if(!$result){
       die('Invalid query:' . $conn->error);
  }

  while($row = $result->fetch_assoc()){
    if($_POST['email']==$row['email']){
      $emailErr = '* Email address is already existed. Please try another email.';
    }
  }
  ////////////////////////////////////////////



  if (empty($nameErr) && empty($emailErr) && empty($passwordyErr) && empty($confirmPasswordErr)) {
    // add to database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', md5('$password'))";
    if (mysqli_query($conn, $sql)) {
      // success


        //GET THE CURRENT USER FROM DATABASE/////////////
        /////////////////////////////////////////////////
        $sql = "SELECT * from users where email='$email'";
          $result = $conn->query($sql);
          if(!$result){
              die('Invalid query:' . $conn->error);
          }

        while($row = $result->fetch_assoc()){
          $_SESSION['id'] = $row['id'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['setup'] = 0;
        }
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////


      header('Location: thankyou.php');
    } else {
      // error
      echo 'Error: ' . mysqli_error($conn);
    }
  }

}
?>

    <h2>Register Account</h2>
    <?php echo isset($name) ? $name : ''; ?>
    <p class="lead text-center">Sign up your account</p>

    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">


      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo !$nameErr ?:
          'is-invalid'; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          <?=$nameErr?>
        </div>
      </div>


      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control <?php echo !$emailErr ?:
          'is-invalid'; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          <?=$emailErr?>
        </div>
      </div>


      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?php echo !$passwordErr ?:
          'is-invalid'; ?>" id="email" name="password" placeholder="Enter your password" value="<?php echo $password; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          <?=$passwordErr?>
        </div>
            
      </div>


      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control <?php echo !$confirmPasswordErr ?:
          'is-invalid'; ?>" id="confirm_password" name="confirm_password" placeholder="Enter your confirm password" value="<?php echo $confirmPassword; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          <?=$confirmPasswordErr?>
        </div>  

        <p class="mt-3 flex justify-content-end text-end">Already have an account?
          <a href="index.php">Login</a>
        </p>
    
    </div>


      <div class="mb-3">
        <input type="submit" name="submit" value="Sign Up" class="btn btn-success w-100">
      </div>


    </form>


<?php include 'layout/footer.php'; ?>
