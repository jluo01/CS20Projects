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
		echo "<script>console.log('Connection succeeded')</script>";
	}

	$conn->select_db($db);


	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$errors = [];
		$success = false;
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (!$username){
			$errors[] = "User Name is required.";
		}

		if (!$password){
			$errors[] = "Password is required.";
		}

		if(empty($errors)){
			$sql = "SELECT username, password, userid FROM users WHERE username = '$username'";
			$result = $conn->query($sql);
			if ($result->num_rows == 0){
				$errors[] = "User doesn't exist.";
			} else {
				$row = $result->fetch_assoc();
				if($row['password'] == $password){
					$success = true;
                    $_SESSION["userid"] = $row['userid'];
					
				} else{
					$errors[] = "The password doesn't match the username.";
				}
			}
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="homepagestyle2.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        .alert1{
			display:flex;
			justify-content:center;
			align-items: center;
			flex-direction: column;
			width: 100%;
			height:50px;
            background-color:#e79a9a;
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
			width: 100%;
			height:50px;
			text-align: center;
			margin-bottom: 20px;
			font-weight: bold;
		}	
		p {
			text-align: justify;
		}
		#logo {
			font-family: courier;
		}
		h2 {
			text-align: center;
		}
    </style>
	
</head>
<body>
	<div class="navbar">
		<a href="https://junxinggu.com/Final/homepage.php">
			<button class="logo"></button>
	    </a>
		<nav class="navbar-text">
			<ul>
				<li><a href="#container">Home</a></li>
				<li><a href="#profile">About&nbspUs</a></li>
				<li><a href="#feature1">Service</a></li>
				<li><a href="#contact">Contact&nbspUs</a></li>
				<li><a href="https://junxinggu.com/Final/userPortal.php">My&nbspPortal</a></li>
				<li><a href="https://junxinggu.com/Final/reciperec.html">Recipe&nbspSearch</a></li>
				<li><a href="https://junxinggu.com/Final/diary.php">Diary&nbspLog</a></li>
			</ul>
		</nav>

		<div class="hamburger">
			<div class="bar"></div>
			<div class="bar"></div>
			<div class="bar"></div>
		</div>

	</div>

	

	<div id="container">
		<div class="title">
			<h1 id="logo">food.log</h1>
			<br>
			<h2><em>Eat healthy, Track your Nutrition, Get recipe recommendation</em></h2>
		</div>

		<div id="card">
			<center><h1>Sign In</h1></center>
			<?php if (!empty($errors)): ?>
				<div class="alert1">
					<?php foreach ($errors as $error): ?>
						<div><?php echo $error ?></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?php if ($success): ?>
				<div class="success">				
					<div> Successfully signed in!</div>
				</div>
			<?php endif; ?>
			<form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="forminput">
					<label id="firstl">Username:</label><br>
					<input type="text" name="username" placeholder="Username" id="Username">
				</div>
				<br>
				<div class="forminput">
					<label>Password:</label><br>
					<input type="text" name="password" placeholder="Password" id="Password">
				</div>
				<div>
					<input type="submit" value="Login" class="login" id = "btn" onclick="validateForm()">
				</div>
			</form>
			
			<div class="forgot">
				<a href="https://junxinggu.com/Final/signup.php">Sign-up</a> /
				<a href="notfound.html">Forget Password?</a>
			</div>
		</div>
	</div>

	<div class="profile" id="profile">
		<div class="text">
			<h1>Your Health Matters</h1>
			<p>At food.log, we are dedicated to helping our clients achieve personal health goals through adjusting your diet patterns. Our in-house professional dietitians are here to help set your goals and will always be alongside your journey. Get started by signing up and entering your first food diary today! 
</p>
		</div>
		<div class="img1">
			
		</div>
	</div>

	<div class="letsgo1">
		<h1>Let us be your nutritionist!</h1>
	</div>


	<div class="feature1" id="feature1">
		<div class="img2"></div>
		<div class="text">
			<h1>Tracking your everyday meal</h1>
			<p>Using our diary tracking form, you can keep a personal journal of your everyday meals. In addition to recording the meal name, you will also be able to enter the amount of calories, protein, carbohydrates, and fat and check back later in the user portal. 

			</p>
			<a href="https://junxinggu.com/Final/signup.php">Start Now</a>
		</div>
		
	</div>

	<div class="feature2">
		<div class="text">
			<h1>Don't know what to eat today?</h1>
			<p>Unsure of what to eat? Check out our recipe searching page to brainstorm your
next meal. Beside choosing from a variety of cuisines from Italian, Japanese, to Chinese, you can also select which ingredients to include and the maximum calories amount you’d prefer. 

			</p>
			<a href="https://junxinggu.com/Final/signup.php">Start Now</a>
		</div>
		
		<div class="img3"></div>
	</div>

	<div class="feature1">
		<div class="img4"></div>
		<div class="text">
			<h1>Professional nutrition analytics</h1>
			<p>Our individualized user portal will note your personal goals and keep track of the
nutritional values such as calories, fat, and protein you’ve entered through the
diary entry form. You will be able to see directly whether you’ve reached or 
exceeded your nutritional goals.  

			</p>
			<a href="https://junxinggu.com/Final/signup.php">Start Now</a>
		</div>
		
	</div>

	<div class="contact" id="contact">
		<h1>Contact Us!</h1>
		<div class="form container">
			<form class='contactform' action="" method="post">
				<p class="lname"><label>Last Name*</label><input type="text" placeholder="Last name"></p>
				<p class="fame"><label>First Name</label><input type="text" placeholder="First name"></p>
				<p class="number"><label>Phone*</label><input type="text" placeholder="Phone number"></p>
				<p class="email"><label>Email*</label><input type="email" placeholder="Email"></p>
				<p class="comment"><label>Comment</label><input type="textbox"></p>
				<p class="sub"><a href="notfound.html">Submit</a></p>
			</form>
		</div>
		<div class="companyinfo">
			<div>Logo</div>
			<div>Our Number: +1 1234567</div>
			<div>Email: ciao@logo.com</div>
			<div>Address: 389 Boston Ave, Meford, MA</div>
			
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