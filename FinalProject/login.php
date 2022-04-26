<?php 
session_start();
//connect to the database;
	$server = "localhost";
	$userid = "uo8hchpccgagq"; 
	$pw = "hhxxttxs"; 
	$db= "db3guheulakj3q"; 
			
	// Create connection
	$conn = new mysqli($server, $userid, $pw );

	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	} else {
		echo "Connection succeeded";
	}

	$conn->select_db($db);
	$username  = "";
	$password  = "";

	//$sql = "SELECT ProductName, Price FROM products";
	//$result = $conn->query($sql);
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$errors    = [];
		$success   = false;
		$username  = $_POST['username'];
		$password  = $_POST['password'];


		if (!$username){
			$errors[] = "User Name is required.";
		}

		if (!$password){
			$errors[] = "Password is required.";
		}

        if(empty($errors)){
			$sql1 = "SELECT username FROM users WHERE username = '$username'";
			$result1 = $conn->query($sql1);
			$sql2 = "SELECT userid FROM users WHERE username = '$username' AND password = '$password'";
			$result2 = $conn->query($sql2);
			if ($result1->num_rows == 0){
				$errors[] = "This username doesn't exist.";	
			} else {
                if ($result2->num_rows == 0){
                    $errors[] = "Incorrect password.";	
                } else {
                    $row = $result2->fetch_array();
                    $id = $row[0];
                    $success = true;
                    $_SESSION["userid"] = $id;
                }
            }
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="signupstyle.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	 <style>
        .alert1{
			display:flex;
			justify-content:center;
			align-items: center;
			flex-direction: column;
			width: 50%;
			height:100px;
            background-color:rgba(241, 126, 126, 0.85);
            color:#972424;
			text-align: center;
			margin-bottom: 20px;
			font-weight: bold;
        }

		.success{
			display:flex;
			justify-content:center;
			align-items: center;
			background-color:rgba(89, 255, 6, 0.75);
            color:rgba(52, 135, 14, 1);
			width: 50%;
			height:60px;
			text-align: center;
			margin-bottom: 20px;
			font-weight: bold;
		}	
    </style>
	
</head>
<body>
	<div class="navbar">
		<a href="https://jluo01.github.io/CS20Projects/HomePage/homepage.html">
			<button class="logo"></button>
	    </a>
		<nav class="navbar-text">
			<ul>
				<li><a href="https://jluo01.github.io/CS20Projects/HomePage/homepage.html">Home</a></li>
				<li><a href="https://jluo01.github.io/CS20Projects/Services/Services.html">Service</a></li>
				<li><a href="https://jluo01.github.io/CS20Projects/About/AboutUs.html">About&nbspUs</a></li>
				<li><a href="https://jluo01.github.io/CS20Projects/Contact/ContactUs.html">Contact</a></li>
			</ul>
		</nav>

		<div class="hamburger">
			<div class="bar"></div>
			<div class="bar"></div>
			<div class="bar"></div>
		</div>

	</div>

	

	<div id="container">
		<div class="background">
			<div class="title">
				<h1>Logo</h1>
				<h2>Company slogan goes here </h2>
			</div>
		

			<div id="card">
				<center><h1>Log In</h1></center>
				<?php if (!empty($errors)): ?>
					<div class="alert1">
						<?php foreach ($errors as $error): ?>
							<div><?php echo $error ?></div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ($success): ?>
					<div class="success">				
						<div> Successfully logged in!</div>
					</div>
				<?php endif; ?>
				<form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div class="forminput">
						<label id="firstl">Username:</label><br>
						<input type="text" name="username" placeholder="Username" id="Username" value="<?php echo $username ?>">
					</div>
					<br>
					<div class="forminput">
						<label>Password:</label><br>
						<input type="text" name="password" placeholder="Password" id="Password">
					</div>
					<br>
					<div>
						<input type="submit" value="Log in" class="login" id = "btn" onclick="validateForm()">
					</div>
				</form>
			</div>

		</div>
	</div>

	
	
	

	<script type="text/javascript">
		const hamburger = document.querySelector(".hamburger");
		const navMenu = document.querySelector(".navbar-text");

		hamburger.addEventListener("click", mobileMenu);

		function mobileMenu() {
   		hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
        }

	</script>

	

</body>
</html>