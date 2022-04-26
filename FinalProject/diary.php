<?php
	session_start();

	//establish connection info
	$server = "localhost";
	$userid = "uo8hchpccgagq";
	$pw = "hhxxttxs"; 
	$db= "db3guheulakj3q";
	
	// Create connection
	$conn = new mysqli($server, $userid, $pw, $db);
	
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	//select the database
	$conn->select_db($db);
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$errors    = [];
		$success   = false;
		$date = $_POST["date"];
		$food = $_POST["food"];
		$cal = $_POST["cal"];
		$protein = $_POST["protein"];
		$carb = $_POST["carb"];
		$fat = $_POST["fat"];

		// form validation
		if (!$date){
			$errors[] = "Date is required.";
		}
		if ($food == ""){
			$errors[] = "Food name is required.";
		}
		if ($cal == ""){
			$errors[] = "Please enter the calories amount.";
		}
		if ($protein == ""){
			$errors[] = "Please enter the protein amount.";
		}
		if ($carb == ""){
			$errors[] = "Please enter the carbohydrate amount.";
		}
		if ($fat == ""){
			$errors[] = "Please enter the fat amount.";
		}

	// insert values into table
	if (empty($errors)) 
    {
        $userid = $_SESSION["userid"];
		$t_id = 1;
		$sql = "INSERT INTO food(userid, date, food_name, calories, fat, carbs, protein)
		VALUES($userid,'$date', '$food', $cal, $fat, $carb, $protein)";
		
		if ($conn->query($sql) === TRUE) {
			$success = true;
			echo "<script>console.log('successfully inserted')</script>";
		} 
		else {
			echo "<script>console.log('Error: ' + $sql + ': '$conn->error);</script>";
			
		}
	}
	}	
    
		
	//close the connection	
	$conn->close();

    ?>  

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Diary Entry Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="reciperec1.css">

    <style>
	@import url('https://fonts.googleapis.com/css2?family=Lobster&family=Source+Sans+Pro:wght@300&display=swap');
    .diary_form {
		display: flex;
		justify-content: center;
		width: 50%;
		margin: 2% 24%;
		padding: 20px 30px;
		background-color: rgba(78, 71, 71, 0.5);
		/* padding-top: 30px; */
		padding-bottom: 30px;
	}
	label {
		display: inline-block;
		width: 150px;
		text-align: left;
		text-shadow: 2px 2px rgba(112, 128, 144, 0.247);
		font-size: 22px;
	}
	input {
		display: inline-block;
		}
	form {
		color: white;
		border-radius: 4px;
		font-size: 22px;
		font-family: 'Source Sans Pro', sans-serif;
		text-align: center;
	}
	h1 {
		font-family: 'Lobster', cursive;
		color: rgba(200, 107, 0, 0.9);
		text-shadow: 3px 3px rgba(112, 128, 144, 0.329);
		color: white;
		margin: 10px 30px 30px 30px;

	}
    
    h3{
        font-family: 'Source Sans Pro', sans-serif;
        color: white;

    }
	input[type=submit] {
		background-color:rgba(200, 93, 64, 0.493);
		padding: 10px 30px;
		font-size: 22px;
		font-family: 'Source Sans Pro', sans-serif;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		justify-content: center;
		margin: 0 30%;
		color: white;
	}
	input[type=text],[type=number],[type=date] {
		padding: 1px;
		font-size: 16px;
		font-family: 'Source Sans Pro', sans-serif;
	}
	.container {
		background-image:url('diary1.jpg');
		height:700px;
	}
	.alert1{
		display:flex;
		justify-content:center;
		align-items: center;
		flex-direction: column;
		padding:2px;
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
		text-align: center;
		margin-bottom: 20px;
		font-weight: bold;
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

	<div class = "container">
	<br>
	<div class="diary_form">
        <form action="" method="post">
            <h1>Enter Your Diary</h1>
            <h3><em>Keep track of what you've eaten.</em></h3><br><br>
            <?php if (!empty($errors)): ?>
                <div class="alert1">
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success">				
                    <div> Successfully Entered!</div>
                </div>
            <?php endif; ?>

            <div class="diary_entry">
                <label>Date</label><input type="date" id="date" name="date">
            </div><br>
            <div class="diary_entry">
                <label>Food Item</label><input type="text" id="food" name="food">
            </div><br>
            <div class="diary_entry">
                <label>Calories</label><input type="number" id="cal" name="cal">
            </div><br>
            <div class="diary_entry">
                <label>Protein</label><input type="number" id="protein" name="protein">
            </div><br>
            <div class="diary_entry">
                <label>Carbohydrate</label><input type="number" id="carb" name="carb">
            </div><br>
            <div class="diary_entry">
                <label>Fat</label><input type="number" id="fat" name="fat">
            </div><br>
            
            <input type="submit" id="submit" value="Enter">
        </form>
        </div>
	</div>
</body>
</html>

