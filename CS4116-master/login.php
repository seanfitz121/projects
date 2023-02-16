 <!DOCTYPE html>
 <html>
 <head>
  <link rel="icon" href="images/uniConnectLogo.png" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <title>Login</title>

   <style>

    .login-register-text {
        color: #113;
        font-weight: 600;
    }

    body {
    background-color: #868c93;
    }

    .container1 {
    width: 500px;
    min-height: 500px;
    background: #FFF;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    padding: 50px 50px;
    margin-top: 20px;
    margin:0 auto;
    }

    .container {
    width: 400px;
    min-height: 400px;
    background: #FFF;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    padding: 50px 50px;
    margin-top: 20px;
    margin:0 auto;
    }


    </style>
 </head>
 <body>
    <?php
        session_start();
        if(!empty($_SESSION['loggedin'])){ header("location: home.php");}  //check if user already logged in
        //echo "Test login page";
    ?>

    <div class="container1">
    <div class="row" style="min-width:800">
      <div class="col-sm-1"><img src="images/uniConnectLogo.png" alt="Logo" ></div>

     </div>
    <div class="container">
    <form action="auth.php" method="POST">
    <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
    <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label"></label>
            <div class="input-group">
            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
        </div>
    </div>
    <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label"></label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required >
    </div>
    <div class="form-group row">
       <div class="offset-sm-5 col-sm-">
        <input type="submit" class="btn btn-primary" value="Login" name="">
        </div>
     </div>
    </form>
    <form method="post">
       <p class="login-register-text">New User? <a href="index.php">Register Here</a>.</p>
       <p class="login-register-text">Admin User? <a href="adminLogin.php">Login Here</a>.</p>
     </form>

    <?php
     if(array_key_exists('buttonRegister', $_POST)) {
         header("location: index.php"); //re-direct to register page
     }
     ?>


 </body>
 </html>
