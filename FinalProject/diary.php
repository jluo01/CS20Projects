<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Diary Entry Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <style>
	@import url('https://fonts.googleapis.com/css2?family=Lobster&family=Source+Sans+Pro:wght@300&display=swap');
    .diary_form {
		display: flex;
		justify-content: center;
		width: 40%;
		margin: 5% 25%;
		padding: 20px 30px;
		border: 4px rgba(159, 84, 145, 0.58) solid;
		background-color: rgba(149, 26, 171, 0.11);
	}
	label {
		display: inline-block;
		width: 120px;
		text-align: left;
		text-shadow: 2px 2px rgba(112, 128, 144, 0.247);
	}
	input {
		display: inline-block;
		}
	form {
		color: black;
		border-radius: 4px;
		font-size: 18px;
		font-family: 'Source Sans Pro', sans-serif;
	}
	h1 {
		font-family: 'Lobster', cursive;
		color: rgba(161, 59, 145, 0.78);
		text-shadow: 3px 3px rgba(112, 128, 144, 0.329);
	}
	input[type=submit] {
		background-color:rgba(161, 59, 145, 0.41);
		padding: 10px 30px;
		font-size: 18px;
		font-family: 'Source Sans Pro', sans-serif;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		justify-content: center;
		margin: 0 30%;
	}
	input[type=text],[type=number],[type=date] {
		padding: 1px;
		font-size: 16px;
		font-family: 'Source Sans Pro', sans-serif;
	}
    </style>
</head> 

<body>
	<div class="diary_form">
    
    <form action="" method="post">
	<h1>Enter Your Diary</h1>
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
	
    <?php
	/*
	//establish connection info
	$server = "localhost";// your server
	$userid = "ugcxocz7h3owg"; // your user id
	$pw = "ntkxefbe9yja"; // your pw
	$db= "dbbu2iid3dlxrn"; // your database
	
	// Create connection
	$conn = new mysqli($server, $userid, $pw, $db);
	
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	//select the database
	$conn->select_db($db);
	
	$date = $_POST("date");
	$food = $_POST("food");
	$cal = $_POST("cal");
	$protein = $_POST("protein");
	$carb = $_POST("carb");
	$fat = $_POST("fat");

	// insert values into table
	if (isset ($_POST['name']) && ($_POST['food']) && ($_POST['cal']) 
		&& ($_POST['protein']) && ($_POST['carb']) && ($_POST['fat'])) 
    {
		$sql = "INSERT INTO diary(date, food_item, calories, protein, carb, fat)
		VALUES($date, $food, $cal, $protein, $carb, $fat)";
	}
	
    // check value correctly inserted 
	if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
		
	//close the connection	
	$conn->close();
	  */
    ?>  
	<input type="submit" id="submit" value="Enter">
    </form>
	</div>
</body>
</html>

