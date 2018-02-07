<html>
	<head>
		<title>Bookstore</title>
		
		<!-- accesses the CSS-->
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
		<?php
			/* Establishes a connection to the chosen database */
			$con=mysqli_connect("localhost", "root", "", "bookstore");
			
			if (mysqli_connect_errno($con))
			{
				echo "fail" . mysqli_connect_error();
			}
			
			mysqli_close($con);
		?>
		
		<br><br><br><br>
		
		<!-- Displays an image along with some text as a link to search.php -->
		<div class="floating-box">
			<a href="search.php">
				<img src="search.jpg" alt="Sign Up" width="400" height="345">
				<div class="label">
					Search
				</div>
			</a>
		</div>
		
		<!-- Displays an image along with some text as a link to reservation.php -->
		<div class="floating-box">
			<a href="reservation.php">
				<img src="reservation.png" alt="Sign Up" width="460" height="345">
				<div class="label">
					Reservation
				</div>
			</a>
		</div>
		
		<!-- Displays an image along with some text as a link to newUser.php -->
		<div class="floating-box">
			<a href="newUser.php">
				<img src="signup.png" alt="Sign Up" width="460" height="345">
				<div class="label">
					Login/ Sign Up
				</div>
			</a>
		</div>
		
	</body>
<html>