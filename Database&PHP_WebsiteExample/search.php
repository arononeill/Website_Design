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
	
	<div class="new">
		<h2><b>Search for a Book</b></h2>
		
		Search by Title:
		<!-- Form for a new user to fill in -->
		<form name="form1" method="post" action="searchresults.php">
			<input name="search" type="text" size="40"/>	
			<input type="submit" name="submit" value="search"/>
		</form><br><br>
		
		Search by Author:
		<!-- Form for a new user to fill in -->
		<form name="form2" method="post" action="searchresults.php">
			<input name="search2" type="text" size="40"/>	
			<input type="submit" name="submit" value="search"/>
		</form><br><br>
		
		Search by Title & Author:<br><br>
		Title
		<!-- Form for a new user to fill in -->
		<form name="form2" method="post" action="searchresults.php">
			<input name="search3" type="text" size="40"/><br><br>
			Author<br>
			<input name="search4" type="text" size="40"/>	
			<input type="submit" name="submit" value="search"/>
		</form><br><br>
		
		<!-- 
		Dropdown menu for the user to chose from -->
		<form action="searchresults.php" method="post">
			<select id="ddlViewBy" name="search6">
			  <option value="1" selected="selected">Health</option>
			  <option value="2" selected="selected">Business</option>
			  <option value="3" selected="selected">Biography</option>
			  <option value="4" selected="selected">Technology</option>
			  <option value="5" selected="selected">Travel</option>
			  <option value="6" selected="selected">Self-Help</option>
			  <option value="7" selected="selected">Cookery</option>
			  <option value="8" selected="selected">Fiction</option>
			</select>
		  </select>
		  <input type="submit" name="delete6" >
		</form>
	</div>
		<?php
			/* Establishes a connection to the chosen database */
			$con=mysqli_connect("localhost", "root", "", "bookstore");
			
			if (mysqli_connect_errno($con))
			{
				echo "fail" . mysqli_connect_error();
			}
			
			mysqli_close($con);
		?>
	</body>
<html>