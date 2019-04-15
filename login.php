<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<?php
			$usr = $_POST['username'];
			$pwd = $_POST['password'];
			$connection = pg_pconnect('host=localhost dbname=<dbname> user=<dbuser> password=<dbpwd> connect_timeout=10');
			$result = pg_query($connection, "SELECT * FROM users WHERE username='$usr' AND password='$pwd';");
			if(!$result) {
				echo "An error occurred.\n";
			}
			while($row = pg_fetch_row($result)) {
				echo nl2br("You are logged in!");
				exit;
			}
			echo("Username or Password is Incorrect.");
		?>
	</body>
</html>

