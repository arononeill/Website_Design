<html>
	<head>
		<title>Sign Up</title>
	</head>

	<body>
		<!-- Form for a new user to fill in -->
		<form method="post">	
			<label>Username</label>
			<input type="text" name="Username" placeholder="Username" />
			
			<label>Password</label>
			<input type="text" name="Password" placeholder ="Password"/>
			<input type="submit" name="submit" value="submit" />
		</form>


	<?php
		/* Establishes a connection to the chosen database */
		$con=mysqli_connect("localhost", "root", "", "login_page");
		
		if (mysqli_connect_errno($con))
		{
			echo "fail" . mysqli_connect_error();
		}
		
		/* If the login button is pressed */
		if (isset($_POST["submit"]))
		{ 
			// get form data, making sure it is valid
			$u = $_POST['Username'];
			$p = $_POST['Password'];
			
			if (empty ($u) || empty ($p)) //if username or password field is empty echo below statement
			{
				echo "fill out the required fields";
			}

			else 
			{
				/* username and password fields were filled out */
				$query = "SELECT * FROM login WHERE Username = '$u' AND Password = '$p'";
				
				$result = mysqli_query($con, $query) or die(mysql_error());
				$row = mysqli_num_rows($result);
				
				/* Checks to see whether the username and password exists, ($row = 0 if they exist and $row =1 if they don't exist) */
				if ($row > 0 )
				{
					echo "Welcome $u";
				}
				
				else 
				{
				  echo "That user does not exist";
		
				  // A link to another page to create a new account
				  echo "<a href=newUser.php
				  >Sign Up here</a>";
				}
			}
		}
		mysqli_close($con);
	?>
			