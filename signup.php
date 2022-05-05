<?php
	session_set_cookie_params(0);
    session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $insur = $_POST['insur'];
        
        if(!empty($username) && !is_numeric($username)){
            $q1 = "select * from user where username = '$username'";
            $result = mysqli_query($con, $q1);
            if(mysqli_num_rows($result) > 0)
            {
                echo "<script>alert('User already exists!');</script>";
            }
            elseif(!empty($password))
            {
                $q2 = "select * from user where password = MD5('$password')";
                $result = mysqli_query($con, $q1);
                if(mysqli_num_rows($result) > 0)
                {
                    echo "<script>alert('Password already taken!');</script>";
                }
                elseif(!empty($name) && !empty($age) && !empty($gender) && !empty($insur))
                {
					$q3 = "select max(pass_number) as max from montly_pass";
					$max = mysqli_fetch_assoc(mysqli_query($con, $q3))['max'];
					$max++;
					$date_paid = date_create();
					$date_expiry = date_create();
					date_add($date_expiry,date_interval_create_from_date_string("30 days"));
					$date_expiry = date_format($date_expiry, "Y-m-d");
					$date_paid = date_format($date_paid, "Y-m-d");
					
					mysqli_query($con, "set autocommit = 0");
					mysqli_query($con, "start transaction");	
                    $q4 = "insert into user (username, password, name, age, gender, insurance) values ('$username',MD5('$password'), '$name', $age, '$gender', '$insur')";
					$a1 = mysqli_query($con, $q4);
					
					$q5 = "select userid from user where username = '$username'";
					$userid = mysqli_fetch_assoc(mysqli_query($con, $q5))['userid'];

                    $q6 = "insert into montly_pass(pass_status, expiry_date, payment_method, last_payment_date, pass_number, userid) values('Active', '$date_expiry', 'Debit Card', '$date_paid', '$max', '$userid')";
					$a2 = mysqli_query($con, $q6);
					
					if($a1 && $userid && $a2){
						mysqli_query($con, "commit");
						mysqli_query($con, "set autocommit = 1");
						echo '<script type ="text/JavaScript">alert("Signup Complete!")</script>';
                    	echo "<script>window.location = 'login.php'</script>";
					}
					else {
						mysqli_query($con, "rollback");
						mysqli_query($con, "set autocommit = 1");
						echo '<script type ="text/JavaScript">alert("Signup Failed!")</script>';
                    	echo "<script>window.location = 'signup.php';</script>";
					}
                    die;
                }
            }
        }
        echo "<script>alert('Not Valid Info!');</script>";
        echo "<script>window.location = 'signup.php'</script>";
        die;
    }
?>
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
								<h2>Welcome to Signup</h2>
								<p>Already have an account?</p>
								<a href="login.php" class="btn btn-white btn-outline-white">Log In</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign Up</h3>
			      		</div>
			      	</div>
							<form method = "post" class="signin-form">
								<div class="form-group mb-3"><label class="label" for="name">Name</label><br>
									<input type="text" class="form-control" placeholder="name" name = "name" type = "text"></div>
									<div class="form-group mb-3"><label class="label" for="gender">Gender&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
										<input name = "gender" id = "male" type = "radio" value = "M" checked>
										<label for="male">Male &nbsp&nbsp</label>  
										<input name = "gender" id = "female" type = "radio" value = "F" selected>
										<label for="female">Female &nbsp&nbsp</label>   
										<input name = "gender" id = "others" type = "radio" value = "O" selected>
										<label for="others">Others</label>  </div>
									<div class="form-group mb-3"><label class="label" for="age">Age</label>
										<input type="text" class="form-control" placeholder="age" name = "age" type = "number">
										</div>
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" class="form-control" placeholder="username" name = "username" type="text" required >
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" placeholder="password" name = "password" type = "password" required>
		            </div>
					<div class="form-group mb-3"> <label class="label" for="insur">Insurance&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
						<input name = "insur" type = "radio" value = "yes">
						<label for="yes">Yes&nbsp&nbsp&nbsp&nbsp</label>
						<input name = "insur" type = "radio" value = "no">
						<label for="no">No</label></div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3">Signup</button>
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

