<?php 
	session_set_cookie_params(0);
	session_start();
    include("connection.php");
    include("functions.php");

	check_logout();	

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !is_numeric($username))
        {
            $q1 = "select * from user where username = '$username' limit 1";
            $result = mysqli_query($con, $q1);

            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                $pass = mysqli_fetch_assoc( mysqli_query( $con, "select MD5('$password') as pass") );
                if($user_data['Password'] === $pass['pass'])
                {
                    $_SESSION['userid'] = $user_data['userid'];
                    echo "<script>alert('Logged in!')</script>";
                    echo "<script>window.location = 'index.php';</script>";
                    die;
                }
                echo "<script>alert('Wrong Password!')</script>";
            }
        }
        echo "<script>alert('No such user!')</script>";
        echo "<script>window.location = 'login.php';</script>";
        die;
    }
    
?>
--->
<!doctype html>
<html lang="en">
  <head>
  	<title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style1.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Welcome to Login</h2>
								<p>Don't have an account?</p>
								<a href="signup.php" class="btn btn-white btn-outline-white">Sign Up</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">LOG IN</h3>
			      		</div>
			      	</div>
							<form method = "post" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="username">Username</label>
			      			<input type="text" class="form-control" placeholder="username" name = "username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" placeholder="password" name = "password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

