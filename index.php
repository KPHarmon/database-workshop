<html>
	<head>
		<title>Database Workshop</title>
	</head>
	<body style="font-size=30px;">
	<!--Login Form that sends user to login.php-->
		<h3>LOGIN</h3>
		<form method="POST" action="login.php">
			Username: <input type="text" name="username"></input><br />
			Password: <input type="password" name="password"></input><br />
			<button type="submit">Login</button>
		</form>
		<p style="font-size=14px;">Don't have an account? Use the form below to create one!</p>		
		<br />
		<p>========================================</p>
		<!--Registration Form that sends user to register.php-->
		<h3>REGISTER</h3>	
		<form method="POST" action="register.php">
			Username: <input type="text" name="username"></input><br />
			Password: <input type="password" name="password"></input><br />
			Re-Enter Password: <input type="password" name="password2"></input><br />
			<button type="submit">Register</button>
		</form>
	</body>
</html>
