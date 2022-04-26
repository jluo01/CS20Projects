<?php 
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
	$username  = "";
	$password  = "";
	$cpassword = "";
	$email     = "";
    $targetCal = "";
    $targetFat = "";
    $targetCarbs = "";
    $targetProtein = "";

	//$sql = "SELECT ProductName, Price FROM products";
	//$result = $conn->query($sql);
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$errors    = [];
		$success   = false;
		$username  = $_POST['username'];
		$password  = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$email     = $_POST['email'];
        $targetCal = $_POST['target_cal'];
        $targetFat = $_POST['target_fat'];
        $targetCarbs = $_POST['target_carbs'];
        $targetProtein = $_POST['target_protein'];



		if (!$username){
			$errors[] = "User Name is required.";
		}

		if (!$password){
			$errors[] = "Password is required.";
		}

		if (!$cpassword){
			$errors[] = "Please confirm your Password.";
		}

		if (!$email){
			$errors[] = "Your Email address is required.";
		}

        if (!$targetCal){
			$errors[] = "Your calories target is required.";
		}

        if (!$targetFat){
			$errors[] = "Your fat target is required.";
		}

        if (!$targetCarbs){
			$errors[] = "Your carbohydrates target is required.";
		}

        if (!$targetProtein){
			$errors[] = "Your protein target is required.";
		}

		if($cpassword != $password){
			$errors[] = "Please confirm your password correctly.";
		}

		if(empty($errors)){
			$sql1 = "SELECT username, password FROM users WHERE username = '$username'";
			$result1 = $conn->query($sql1);
			$sql2 = "SELECT email FROM users WHERE email = '$email'";
			$result2 = $conn->query($sql2);
			if ($result1->num_rows > 0){
				$errors[] = "This User Name has been occupied.";
				
			} 
			if ($result2->num_rows > 0){
				$errors[] = "This Email has been occupied.";
				
				
			} 
			if (empty($errors)){
				$insert = "INSERT INTO users (username, password, email, target_cal, target_fat, target_carbs, target_protein)
					VALUES ('$username', '$password', '$email', $targetCal, $targetFat, $targetCarbs, $targetProtein)";
				if ($conn->query($insert) === TRUE) {
					$success = true;
				} else {
					echo "Error: " . $insert . "<br>" . $conn->error;
				}

				echo "<script>window.location.replace('https://junxinggu.com/Final/homepage.php')</script>";
			}
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Logo Homepage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="signupstyle2.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script>
		// function validateForm() {
		// 	let x = document.getElementById("Username");
		// 	let y = document.getElementById("Password");
		// 	let check = []
		// 	let error = false
		// 	check.push(x,y)
		// 	for (let i = 0; i < check.length; i++){
		// 		if (check[i].value == ""){
		// 			alert(check[i].id + " cannot be empty.")
		// 			error = true
		// 			break;
		// 		}
		// 	}
        //     if(!error){
		// 		window.open("https://jluo01.github.io/CS20Projects/slogin.html","_self")
		// 	}
			
		// }	
	</script>
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
        #logo {
			font-family: courier;
		}
        .col {
            display:flex;
            flex-direction: row;
        }
        .submit {
            margin-top: 15%;
            margin-left: 28%;
        }
        h2 {
            text-align: center;
            font-family: courier;

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
				<li><a href="https://junxinggu.com/Final/homepage.php#container">Home</a></li>
				<li><a href="https://junxinggu.com/Final/homepage.php#profile">About&nbspUs</a></li>
				<li><a href="https://junxinggu.com/Final/homepage.php#feature1">Service</a></li>
				<li><a href="https://junxinggu.com/Final/homepage.php#contact">Contact</a></li>
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
				<h1 id="logo">food.log</h1>
                <br>
				<h2><em>Eat healthy, Track your Nutrition, Get recipe recommendation</em></h2>
			</div>
		

			<div id="card">
				<center><h1>Sign Up</h1></center>
				<?php if (!empty($errors)): ?>
					<div class="alert1">
						<?php foreach ($errors as $error): ?>
							<div><?php echo $error ?></div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ($success): ?>
					<div class="success">				
						<div> Successfully signed up!</div>
					</div>
				<?php endif; ?>
				<form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="col">
                        <div class="forminput">
                            <label id="firstl">Username:</label><br>
                            <input type="text" name="username" placeholder="Username" id="Username" value="<?php echo $username ?>">
                        </div>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        <div class="forminput">
                        <label>Target Calories</label><br>
                        <input type="number" name="target_cal" placeholder="Target calories" id="target_cal">
                        </div>
                    </div>
                    <br>
                    <div class="col">
                        <div class="forminput">
                            <label>Password:</label><br>
                            <input type="text" name="password" placeholder="Password" id="Password">
                        </div>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        <div class="forminput">
						<label>Target Fat</label><br>
						<input type="number" name="target_fat" placeholder="Target fat" id="target_fat">
					    </div>
                    </div>
                    <br>
                    <div class="col">
                        <div class="forminput">
                            <label>Confirm Password:</label><br>
                            <input type="text" name="cpassword" placeholder="Confrim Password" id="Password">
                        </div>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        <div class="forminput">
						    <label>Target Carbohydrates</label><br>
						    <input type="number" name="target_carbs" placeholder="Target carbs" id="target_carbs">
					    </div>
                    </div>
                    <br>
                    <div class="col">
                        <div class="forminput">
                            <label>Email:</label><br>
                            <input type="email" name="email" placeholder="Email" id="Email" value="<?php echo $email ?>">
                        </div>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        <div class="forminput">
                            <label>Target Protein</label><br>
                            <input type="number" name="target_protein" placeholder="Target protein" id="target_protein">
                        </div>
                    </div>
					<div class="submit">
						<input type="submit" value="Sign up" class="login" id = "btn" onclick="validateForm()">
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