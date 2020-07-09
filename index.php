<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" media="screen">
<title>Login</title>
</head>

<header>
	<nav>
		<div>
			<?php
				if(isset($_SESSION["userID"])) {
					echo "<form action='includes/logout-inc.php' method='POST'>
					<button type='submit' name='logout-submit'>Logout</button>
					</form>";
				}
		
				else {
					echo "<form action='includes/login-inc.php' method='POST'>
					<input type='text' name='mailuid' placeholder='Username or E-mail'>
					<input type='password' name='pwd' placeholder='Password'>
					<button type='submit' name='login-submit'>Submit</button>
					</form>";
				}
			?>
		<li><a href="signup.php">Register</a></li>
		</div>
	</nav>
</header>

<main>
	<?php
		if(isset($_SESSION["userID"])) {
			echo "<p>You are logged in!</p>";
		}

		else {
			echo "<p>You are logged out!</p>";
		}
	?>

</main>
</html>
