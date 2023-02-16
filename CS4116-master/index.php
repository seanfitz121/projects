<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="icon" href="images/uniConnectLogo.png" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <title>Register</title>

  <style>
    h1 {text-align: center;}
    h4 {text-align: center;}
    p {text-align: center;}

    body{
    background-color: #868c93;
    }

    img{
    border-radius: 5%
    }

    .login-register-text {
        color: #113;
        font-weight: 600;
    }

    .container {
    width: 400px;
    min-height: 400px;
    background: #FFF;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    padding: 40px 30px;
    margin-top: 30px;
    }


    </style>

</head>

<body>

 <?php
   session_start();
   if(!empty($_SESSION['loggedin'])){ header("location: home.php");}  //check if user already logged in
   // $email= $_POST['email'];
   // $name= $_POST['user'];
   // $password = $_POST['password'];

   if(isset($_POST['register'])) {
       echo "First name:".$_POST['firstname'].'<br />';
       echo "Surname:".$_POST['surname'].'<br />';
       echo "Password:".$_POST['password'].'<br />';
       echo "Email:".$_POST['email'].'<br />';
        $uppercase = preg_match('@[A-Z]@', $_POST['password']);
        $lowercase = preg_match('@[a-z]@', $_POST['password']);
        $number    = preg_match('@[0-9]@', $_POST['password']);
     // Check if name has been entered
     if(empty($_POST['Firstname'])) {
       $errName= 'Please enter your first name';
     }
     if(empty($_POST['Surname'])) {
       $errName= 'Please enter your surname';
     }
     // Check if email has been entered and is valid
     if(empty($_POST['email'])) {
       $errEmail = 'Please enter a valid email address';
     }
     // check if a password has been entered and if it is a valid password
     if(empty($_POST['password']) || !$uppercase || !$lowercase || !$number || strlen($_POST['password'] < 8)) {
       $errPass = '<p class="errText">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
     }
     if(empty($_POST['cpassword'])) {
       $errEmail = 'Please Confirm Password';
     }
     if($_POST['password'] != $_POST['cpassword'])
    {
        echo('Passwords do not match!');
    }

     else {
       echo "The form has been submitted";
     }
   }

    // if (isset($_POST['submit'])) { //the POST form has been submitted
    //   echo "First name:".$_POST['firstname'].'<br />';
    //   echo "Surname:".$_POST['surname'].'<br />';
    // }

    if(array_key_exists('buttonSignIn', $_POST)) { //go to sign in
        header("location: login.php");
    }

 ?>
 <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
   <div class="container-fluid">
   <!-- <div class="navbar-header">
     <a class="navbar-brand" href="#">WebSiteName</a>
   </div> -->
   <a class= "navbar-brand" href="index.php"><img src="images/uniConnectLogo.png"></a>
   <button class="navbar-toggler" type="button" data-toggle="collapse"
   data-target="#navbarResponsive">
        <span class="navbar=toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="aboutUs.php">About Us</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
            </li>




 </div>
 </nav>

<div class="container-fluid">

      <div class="col-12"><img src="images/Hero.jpeg" width="100%" height="700px" border-radius: "5%" alt="Picture" ></div>

  </div>






  <div class="container">
   <form role="form" method="post" action = "register.php" method="POST">
   <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
     <div class="form-group row">
       <label for="inputEmail" class="col-sm-3 col-form-label"></label>
       <div class="input-group">
         <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
         <?php echo $errEmail; ?>
       </div>
     </div>
     <div class="form-group row">
      <label for="inputFirst" class="col-sm-3 col-form-label"></label>
      <div class="input-group">
        <input type="text" class="form-control" id="inputFirst" name="firstname" placeholder="First Name" required>
        <?php echo $errName;?>

      </div>
    </div>
    <div class="form-group row">
      <label for="inputSurname" class="col-sm-3 col-form-label"></label>
      <div class="input-group">
        <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="Surname" required>
        <?php echo $errName; ?>
    </div>
    </div>
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
       <div class="input-group">
         <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
         <?php echo $errPass; ?>
       </div>
     </div>
     <div class="form-group row">
       <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
       <div class="input-group">
         <input type="password" class="form-control" id="confirmPassword" name="cpassword" placeholder="Confirm Password" required>
         <?php echo $errPass; ?>
       </div>
     </div>
     <div class="form-group row">
       <div class="offset-sm-5 col-sm-">
         <input type="submit" value="Register" name="register" class="btn btn-primary"/>
       </div>
     </div>
   </form>
      <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
    </form>
   </div>
   <br>

 <div class="container-fluid">
   <h4 style="padding: 4em 0em 1em 0em;">What is Uni-Connect?</h4>
      <div class="row justify-content-center">
        <p style="padding: 2em 0em 2em 0em;border-width: 2px;">
          Uni-connect is a dating application tailored for third level students.
        </p>
       <p style="padding: 2em 0em 2em 0em;border-width: 2px;">
          There are dating apps for a plethora of niches, as a university student,
           you have specific needs and probably don't want to wade through all of the older people trying to get married.
         </p>
        <p style="padding: 1em 0em 2em 0em;border-width: 2px;">
             You need dating apps that are specifically tailored for your lifestyle like Uni-Connect!
        </p>
      </div>
   </div>
 </div>
   <br>
   <footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a style="padding: 0em 1em 0em 0em;border-width: 2px;" class="text-dark" href="https://github.com/Chedz/CS4116">Group-14 Git Repo</a>
    Admin:
    <a class="text-dark" href="http://14-cs4116.infinityfreeapp.com/adminLogin.php"> Login</a>
  </div>

  <!-- <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    Admin:
    <a class="text-dark" href="http://14-cs4116.infinityfreeapp.com/adminLogin.php"> Login</a>
  </div> -->
  <!-- Copyright -->
</footer>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 <script src="js/register.js"</script>
</body>
</html>
