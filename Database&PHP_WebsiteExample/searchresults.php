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
	
	<body><br><br><br><br><br><br>	
		<?php
			/* Establishes a connection to the chosen database */
			$con=mysqli_connect("localhost", "root", "", "bookstore");
			
			if (mysqli_connect_errno($con))
			{
				echo "fail" . mysqli_connect_error();
			}
			
			/* The user has not logged in yet */
			if (!isset($_SESSION['user'])) {
				echo "You are not logged in, please log in before reserving a book";
			}
			
			// The user has logged in previously
			if (isset($_SESSION['user'])) {
			
				/* If the reserve button is pressed */
				if (isset($_POST['delete'])) {
					
					// Checks to see whether the book has been already reserved
					$query = "SELECT Reserved FROM books WHERE (IBSN ='$_POST[topic]' AND Reserved ='N')";
					
					$result = mysqli_query($con, $query) or die(mysql_error());
					$row = mysqli_num_rows($result);
					
					// If the book has not been reserved already it enters this if statement
					if ($row > 0 )
					{
						$user = $_SESSION['user'];
						// Changes the book table to display that the book chosen has now been reserved and cant be reserved by another user
						$DeleteQuery = "UPDATE books SET Reserved = 'Y' WHERE IBSN ='$_POST[topic]'";
						// Puts the IBSN, Username (the session variable) and the date of reserving the book (now()) into the table reservations
						$ReservationQuery = "I
						NSERT INTO Reservations (IBSN, Username, ReservedDate) VALUES ('$_POST[topic]', '$user', now())";
						mysqli_query($con, $DeleteQuery);
						mysqli_query($con, $ReservationQuery);
						echo "You have successfully reserved this book<br><br>";
					}
					
					// If the book has alreasy been reserved, this message gets displayed
					else {
						echo "Sorry this book has already been reserved<br><br>";
					}
				}
				
				/* If the search button is pressed for book title only*/
				if (isset($_POST['search'])) {
					$search_sql="SELECT * FROM books WHERE BookTitle LIKE '%".$_POST['search']."%'";
					$search_query=mysqli_query($con, $search_sql);
					
					// If it could not find any related results, it displays this message
					if (mysqli_num_rows($search_query) == 0) {
						
						echo "There are no related results<br><br>Please go back to main menu";
					}
					
					// Displeys the headers for table book
					if (mysqli_num_rows($search_query) !=0) {
						$search_rs=mysqli_fetch_assoc($search_query);
						echo "<table border=1>
						<tr>
						<th>IBSN</th>
						<th>BookTitle</th>
						<th>Author</th>
						<th>Edition</th>
						</tr>"; 
						//counts how many rows it displays
						$counter = 0;
						$display_num = 5;
						
						//displays until each row in a table has been displayed or 5 have been displayed
						do { 
							$counter++;
							echo "<form action=searchresults.php method=post>";
							echo "<tr>";
							echo "<td>" . "<input type=text name=topic value=" . $search_rs['IBSN'] . " </td>";
							echo "<td>" . "<input type='text' name='name' value='" . $search_rs['BookTitle'] . "' </td>";
							echo "<td>" . "<input type='text' name='attendance' value='" . $search_rs['Author'] . "'</td>";
							echo "<td>" . "<input type=text name=hidden value=" . $search_rs['Edition'] . " </td>";
							echo "<td>" . "<input type=submit name=delete value=Reseve" . " </td>";
							echo "<tr>";
							echo "</form>";
							
						} while ($search_rs=mysqli_fetch_assoc($search_query) AND $counter < $display_num);
					} 
				}
				
				/* If the search button is pressed for author only*/
				if (isset($_POST['search2'])) {
					$search_sql="SELECT * FROM books WHERE Author LIKE '%".$_POST['search2']."%'";
					$search_query=mysqli_query($con, $search_sql);
					
					// If it could not find any related results, it displays this message
					if (mysqli_num_rows($search_query) == 0) {
						
						echo "There are no related results<br><br>Please go back to main menu";
					}
					
					// Displeys the headers for table book
					if (mysqli_num_rows($search_query) !=0) {
						$search_rs=mysqli_fetch_assoc($search_query);
						echo "<table border=1>
						<tr>
						<th>IBSN</th>
						<th>BookTitle</th>
						<th>Author</th>
						<th>Edition</th>
						</tr>";
						//counts how many rows it displays
						$counter = 0;
						$display_num = 5;
						
						//displays until each row in a table has been displayed or 5 have been displayed
						do { 
							$counter++;
							echo "<form action=searchresults.php method=post>";
							echo "<tr>";
							echo "<td>" . "<input type=text name=topic value=" . $search_rs['IBSN'] . " </td>";
							echo "<td>" . "<input type='text' name='name' value='" . $search_rs['BookTitle'] . "' </td>";
							echo "<td>" . "<input type='text' name='attendance' value='" . $search_rs['Author'] . "'</td>";
							echo "<td>" . "<input type=text name=hidden value=" . $search_rs['Edition'] . " </td>";
							echo "<td>" . "<input type=submit name=delete value=Reseve" . " </td>";
							echo "</tr>";
							echo "</form>";
						} while ($search_rs=mysqli_fetch_assoc($search_query) AND $counter < $display_num);
					} 
					else {
						echo "no results";
					}
				}
				
				/* If the search button is pressed for book title and author*/
				else if (isset($_POST['search3']) AND (isset($_POST['search4']))) {
					$search_sql="SELECT * FROM books WHERE BookTitle LIKE '%".$_POST['search3']."%' AND Author LIKE '%".$_POST['search4']."%'";
					$search_query=mysqli_query($con, $search_sql);
					
					// If it could not find any related results, it displays this message
					if (mysqli_num_rows($search_query) == 0) {
						
						echo "There are no related results<br><br>Please go back to main menu";
					}
					
					// Displeys the headers for table book
					if (mysqli_num_rows($search_query) !=0) {
						$search_rs=mysqli_fetch_assoc($search_query);
						echo "<table border=1>
						<tr>
						<th>IBSN</th>
						<th>BookTitle</th>
						<th>Author</th>
						<th>Edition</th>
						</tr>";
						//counts how many rows it displays
						$counter = 0;
						$display_num = 5;
						
						//displays until each row in a table has been displayed or 5 have been displayed
						do { 
							$counter++;
							echo "<form action=searchresults.php method=post>";
							echo "<tr>";
							echo "<td>" . "<input type=text name=topic value=" . $search_rs['IBSN'] . " </td>";
							echo "<td>" . "<input type='text' name='name' value='" . $search_rs['BookTitle'] . "' </td>";
							echo "<td>" . "<input type='text' name='attendance' value='" . $search_rs['Author'] . "'</td>";
							echo "<td>" . "<input type=text name=hidden value=" . $search_rs['Edition'] . " </td>";
							echo "<td>" . "<input type=submit name=delete value=Reseve" . " </td>";
							echo "</tr>";
							echo "</form>";
						} while ($search_rs=mysqli_fetch_assoc($search_query) AND $counter < $display_num);
					} 
				
					else {
						echo "no results";
					}
				}
				
				/* If the search button is pressed for category description*/
				if (isset($_POST['search6'])) {
					$search_sql="SELECT * FROM books WHERE Category = '008'";
					$search_query=mysqli_query($con, $search_sql);
					
					// If it could not find any related results, it displays this message
					if (mysqli_num_rows($search_query) != 0) {
						$search_rs=mysqli_fetch_assoc($search_query);
					}
					
					else {
						echo "There are no results";
					}
					
					// Displeys the headers for table book
					if (mysqli_num_rows($search_query) !=0) {
						echo "<table border=1>
						<tr>
						<th>IBSN</th>
						<th>BookTitle</th>
						<th>Author</th>
						<th>Edition</th>
						</tr>";
						//counts how many rows it displays
						$counter = 0;
						$display_num = 5;
						
						//displays until each rowin a table has been displayed or 5 have been displayed
						do { 
							$counter++;
							echo "<form action=searchresults.php method=post>";
							echo "<tr>";
							echo "<td>" . "<input type=text name=topic value=" . $search_rs['IBSN'] . " </td>";
							echo "<td>" . "<input type='text' name='name' value='" . $search_rs['BookTitle'] . "' </td>";
							echo "<td>" . "<input type='text' name='attendance' value='" . $search_rs['Author'] . "'</td>";
							echo "<td>" . "<input type=text name=hidden value=" . $search_rs['Edition'] . " </td>";
							echo "</tr>";
							echo "</form>";
						} while ($search_rs=mysqli_fetch_assoc($search_query) AND $counter < $display_num);
					} 
					else {
						echo "no results";
					}
				}
			}
			
			mysqli_close($con);
		?>