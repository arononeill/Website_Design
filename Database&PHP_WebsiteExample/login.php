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
				<h2><b>Existing User</b></h2>
				
				<ul class="style2">
								
					<ul>
					<label>Username
					<span class="required"></span></label><input type="text" name="Username" class="field-divided" placeholder="Username" />
					</ul>
					
					<ul>
						<label>Password<span class="required"></span></label>
						<input type="text" name="Password" placeholder ="Password" class="field-long" />
					</ul>
					<br><br>
					
					<div class="button">
						<input type="submit" name="submit" value="submit" />
					</div>
				<h4>Not yet registered?</h4>
				
				<!-- A link to another page to create a new account -->
				<a href="newUser.php" class="signup">
					<h5>Sign Up here!</h5>
				</a>
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
					$query = "SELECT * FROM users WHERE Username = '$u' AND Password = '$p'";
					
					$result = mysqli_query($con, $query) or die(mysql_error());
					$row = mysqli_num_rows($result);
					
					/* Checks to see whether the username and password exists, ($row = 0 if they exist and $row =1 if they don't exist) */
					if ($row > 0 )
					{
						echo "<div class='message2'>";
							echo "<br><br>You are now logged in as<br><br>";
							echo $_SESSION['user'] = $u;
						echo "</div>";
					}
					
					else 
					{
					  echo "Sorry please try again";
					}
				}
			}
			mysqli_close($con);
		?>
		
	</body>
<html>