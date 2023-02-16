<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- <link rel="stylesheet" href="login.css"> -->
  <style>
    h1 {text-align: center;}
    h4 {text-align: center;}
    p {text-align: center;}

    .login-box {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: 2rem solid #FFFFFF;
        padding: 4rem;
    }

    .button {
      margin:0 auto;
      display:block;
      font-size: 1rem;
    }
    /* div {text-align: center;} */
  </style>
	<title>Admin Login Page</title>
</head>

<body>
	<form action="adminAuth.php" method="post">
		<div class="login-box">
			<h1>Admin Login</h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Adminname"
						name="adminname" value="">
			</div>

      <br>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password"
						name="password" value="">
			</div>

      <br>

			<input class="button" type="submit"
					name="login" value="Sign In">
		</div>
	</form>
</body>

</html>
