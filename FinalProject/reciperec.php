<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Recipe Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <style>
	@import url('https://fonts.googleapis.com/css2?family=Lobster&family=Source+Sans+Pro:wght@300&display=swap');
    .recipe_form {
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
		width: 180px;
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
		margin-left: 20%;
	}
	input[type=text],[type=number] {
		padding: 1px;
		font-size: 16px;
		font-family: 'Source Sans Pro', sans-serif;
	}
    </style>
</head> 

<body>
    <div class="recipe_form">
    <form action="" method="get">
    <h1>Search for your next meal:</h1>
    <div class="recipe_search">
        <label>Cuisine</label><input type="text" id="cuisine" name="cuisine">
    </div><br>
    <div class="recipe_search">
        <label>Ingredients to Include</label><input type="text" id="food" name="food">
    </div><br>
    <div class="recipe_search">
        <label>Calories Cap</label><input type="number" id="cal" name="cal">
    </div><br>
    
    <!-- use API to get result -->
    <?php
	
    ?>  
	<input type="submit" id="submit" value="Search for Recipe">
    </form>
    </div>
</body>
</html>
