<html>
	<head>
		<title>Bookstore</title>
		<link rel="stylesheet" type="text/css" href="site.css">
	</head>
	
	<div id="main">
		<header>
			<section class="box">
				<a href="index.php">
					<h1>Bookstore</h1>
				</a>
				
				<nav>
					<ul>
					<li class="dropdown">
						<a href="search.php" class="dropbtn">Search</a>
					</li> 
					
					<li class="dropdown">
						<a href="reservation.php" class="dropbtn">Reservation</a>
					</li> 
					
					<li class="dropdown">
						<a href="login.php" class="dropbtn">Login</a>
					</li>
					</ul>
				</nav>
				
				<div id="signIn">
				<?php
					/*checks if there is a user logged in and if so it displays the username in the right of the header and if not it displays that there is no user logged in*/
					session_start();
					if (isset($_SESSION['user'])) {
						echo "You are logged in as ";
						echo $_SESSION['user'];
					}
					else {
						echo "Not logged in";
					}
				?>
					<!-- If the logout button is pressed then the user is brought to the die.php page -->
					<a href="die.php">
						<input type="submit" name="submit2" value="Logout" />
					</a>
				</div>
				
			</section>
		</header>
	</div>
	
	<body>
		<!-- Form for a new user to fill in -->
		<form method="post">
			<div class="new">
				<h2>New User</h2>
				
				
				<ul class="style2">
					<ul>
					<label>Username
					<span class="required"></span></label><input type="text" name="Username" placeholder="Username" />
					</ul>
					
					<ul>
						<label>Password<span class="required"></span></label>
						<input type="text" name="Password" placeholder ="Password" />
					</ul>
					
					<ul>
						<label>Confirm Password<span class="required"></span></label>
						<input type="text" name="Password2" placeholder ="Password" />
					</ul>
					
					<ul>
						<label>First Name</label>
						<input type="text" name="FirstName" placeholder ="firstname"/>
						
					</ul>
					
					<ul>
						<label>Surname</label>
						<input type="text" name="Surname" placeholder = "Surname"/><br>
					</ul>
					
					<ul>
						<label>Address Line 1</label>
						<input type="text" name="AddressLine" placeholder ="Address Line 1"/><br>
					</ul>
					
					<ul>
						<label>Address Line 2</label>
						<input type="text" name="AddressLine2" placeholder ="Address Line 2"/><br>
					</ul>
					 
					<ul>
						<label>City</label>
						<input type="text" name="City" placeholder ="City"/><br>
					</ul>
					
					<ul>
						<label>Telephone</label>
						<input type="text" name="Telephone" placeholder ="Telephone"/><br>
					</ul>
					
					<ul>
						<label>Mobile</label>
						<input type="text" name="Mobile" placeholder ="Mobile"/>
					</ul>
					
					<div class="button">
						<input type="submit" name="submit" value="submit" />
					</div>
				</ul>
			</div>
		</form>
		<?php
			/* Establishes a connection to the chosen database */
			$con=mysqli_connect("localhost", "root", "", "bookstore");
			
			if (mysqli_connect_errno($con))
			{
				echo "fail" . mysqli_connect_error();
			}
			
			/* If the submit button is pressed */
			if (isset($_POST["submit"]))
			{ 
				// get form data, making sure it is valid
				$u = $_POST['Username'];
				$p = $_POST['Password'];
				$p2 = $_POST['Password2'];
				$f = $_POST['FirstName'];
				$s = $_POST['Surname'];
				$a1 = $_POST['AddressLine'];
				$a2 = $_POST['AddressLine2'];
				$c = $_POST['City'];
				$t = $_POST['Telephone'];
				$m = $_POST['Mobile'];
				
				$len = strlen($p);
				$min = 6; /* sets a variable to 6 which will be used to check the length  of the password, it avoids hard coding */
				$set_mobile_length = 10; /* sets a variable to 10 which will be used to check the length  of the mobile, it avoids hard coding */
				$num_length = strlen((string)$m); /* used to get the length of the number the user enters in for mobile */
				
				/* Checks whether any of the text boxes are empty */
				if (empty ($u) || empty ($p) || empty ($p2) || empty ($f) || empty ($s) || empty ($a1) || empty ($a2) || empty ($c) || empty ($t) || empty ($m)) //if username field is empty echo below statement
				{
					echo "<div class='message'>";
					echo "*fill out the required fields*";
					echo "</div>";
				}
				
				/* validates whether the password given does not equal to their confirmed password also given */
				else if($_POST['Password']!= $_POST['Password2'])
				{
					echo "<div class='message'>";
						echo("*Oops! Password did not match! Try again*");
					echo "</div>";
				}
				
				/* Checks whether the length of the user's entered password is less than $min which was given the value 6 */
				else if($len < $min)
				{
					echo "*Password is too short, minimum is $min characters*";
				}
				
				/* Checks whether the length of the user's entered mobile does not equal $num_length which was given the value 10 */
				else if ($num_length != $set_mobile_length)
				{
					echo "*Mobile number must be 10 digits long*";
				}
				
				/* All conditions were met */
				else 
				{
					/* Adds the new user to the database */
					$sql = "INSERT INTO users (Username, Password, FirstName, Surname, AddressLine, AddressLine2, City, Telephone, Mobile)
					VALUES ('$u', '$p', '$f', '$s', '$a1', '$a2', '$c', '$t', '$m')";
					
					/* Checks to see if it worked or not */
					if ($con->query($sql) === TRUE) {
						echo "New record created successfully";
					} 
					
					else
					{
						echo "Error: " . $sql . "<br>" . $con->error;
					}
				}
			}
			mysqli_close($con);
		?>
	
	</body>
</html>