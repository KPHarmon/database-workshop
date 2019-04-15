<html>
	<head>
		<title>Register</title>
	</head>
	<body>
		<?php
			$regusr = $_POST['username'];
			$regpwd = $_POST['password'];
			$regpwd2 = $_POST['password2'];
			if($regpwd != $regpwd2){
				echo "Passwords did not match!";
				exit;
			}
			$connection = pg_pconnect('host=localhost dbname=<dbname> user=<dbuser> password=<dbpwd> connect_timeout=10');
			$result = pg_query($connection, "INSERT INTO users(username, password) VALUES('$regusr', '$regpwd');");
			if($result) {
				echo "New user created!";
			}
		?>
	</body>
</html>

