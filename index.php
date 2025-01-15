<?php include 'layout/header.php'; ?>
<?php include 'config/database.php'; ?>

<?php
// Set vars to empty values
session_start(); 

$name = $email = $password  =  '';
$nameErr = $emailErr = $passwordErr  =  '';

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


  //CHECK IF EMAIL ALREADY EXISTED/////////////
  /////////////////////////////////////////////
  $sql = "SELECT * from users where email='$email' and password = md5('$password')";
  $result = $conn->query($sql);
  if(!$result){
       die('Invalid query:' . $conn->error);
  }

  if ($result->num_rows == 0) {
    $emailErr = '* The email address and password does not match, please try again.';
  }else{

    while($row = $result->fetch_assoc()){
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['setup'] = 1;
    }
    header('Location: dashboard.php');

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

    <h2>Log In Account</h2>
    <?php echo isset($name) ? $name : ''; ?>
    <p class="lead text-center">Log in your account</p>

    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">


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

      <p class="mt-3 flex justify-content-end text-end">Doesn't have an account? Register 
          <a href="signup.php">here</a>
        </p>


      <div class="mb-3">
        <input type="submit" name="submit" value="Login" class="btn btn-primary w-100">
      </div>


    </form>


<?php include 'layout/footer.php'; ?>
