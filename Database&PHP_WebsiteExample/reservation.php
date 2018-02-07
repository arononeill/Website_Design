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
	
	<body><br><br><br><br>
		<?php
			/* Establishes a connection to the chosen database */
			$con=mysqli_connect("localhost", "root", "", "bookstore");
			
			if (mysqli_connect_errno($con))
			{
				echo "fail" . mysqli_connect_error();
			}
			
			/* If there is a user logged in */
			if (isset($_SESSION['user'])) {
				
				/* If the unreserve button is pressed */
				if (isset($_POST['delete'])) {
					/* Changes the Reserved column from books of the chosen book title to 'N' */
					$DeleteQuery = "UPDATE books SET Reserved = 'N' WHERE IBSN ='$_POST[topic]'";
					/* Deletes the book chosen from the reservations table */
					$ReservationQuery = "DELETE FROM Reservations WHERE IBSN ='$_POST[topic]'";
					mysqli_query($con, $DeleteQuery);
					mysqli_query($con, $ReservationQuery);
				}
				
				$search_sql="SELECT * FROM Reservations";
				$search_query=mysqli_query($con, $search_sql);
				
				/* Checks whether there are any results */
				if (mysqli_num_rows($search_query) != 0) {
					$search_rs=mysqli_fetch_assoc($search_query);
				}
				
				echo "Reservation Results<br><br>";
				if (mysqli_num_rows($search_query) !=0) {
					
						/* Displays table headings for reservations */
						$user = $_SESSION['user'];
						$username = $search_rs['Username'];
						echo "<table border=1>
						<tr>
						<th>IBSN</th>
						<th>Username</th>
						<th>ReservedDate</th>
						</tr>";
						
						/* Displays every row of the table reservations until there are no more books resereved */
						do { 
							$username = $search_rs['Username'];
							if ($user == $username) {
								$username = $search_rs['Username'];
								echo "<form action=reservation.php method=post>";
								echo "<tr>";
								echo "<td>" . "<input type=text name=topic value=" . $search_rs['IBSN'] . " </td>";
								echo "<td>" . "<input type=text name=name value=" . $search_rs['Username'] . " </td>";
								echo "<td>" . "<input type=text name=attendance value=" . $search_rs['ReservedDate'] . " </td>";
								echo "<td>" . "<input type=submit name=delete value=Unreseve" . " </td>";
								echo "</tr>";
								echo "</form>";
							}
						} while ($search_rs=mysqli_fetch_assoc($search_query));
					
					echo "</form>";
					echo "</table>";
					
				} 
				
				//If the user has no books reserved it displays this message
				else {
					echo "You have no books reserved";
				}
			}
			
			// If the user has not yet logged in, it displays this message
			else {
				echo "<br><br><br>Please login to view reservations";
			}
				
				mysqli_close($con);
		?>
	</body>
<html>