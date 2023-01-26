<?php
	session_start();
	$username = strtoupper(mysql_real_escape_string($_POST['username']));
	$password = mysql_real_escape_string($_POST['password']);
    $login_as = (mysql_real_escape_string($_POST['section']));

	mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
	mysql_select_db("p_db") or die("Cannot connect to database"); //Connect to database

	if($login_as==1)
	{
		$query = mysql_query("SELECT * from user_student WHERE username='$username'"); //Query the users table if there are matching rows equal to $username
		$exists = mysql_num_rows($query); //Checks if username exists
		$table_users = "";
		$table_password = "";

		if($exists > 0) //IF there are no returning rows or no existing username
		{
			while($row = mysql_fetch_assoc($query)) //display all rows from query
			{
				$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
				$table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
			}
			if(($username == $table_users)) // checks if there are any matching fields
			{
					if(password_verify($password, $table_password))
					{
						$_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
						header("location: studenthome.php"); // redirects the user to the authenticated home page
					}
					
			}
			else
			{
				//Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
				Print '<script>window.location.assign("login.php?id=1");</script>'; // redirects to login.php
			}
		}
		else
		{
			//Print '<script>alert("Incorrect Username!");</script>';
			Print '<script>window.location.assign("login.php?id=2");</script>';
		}		
	}

	if($login_as==2)
	{
		//echo $username;

		$query = mysql_query("SELECT * from user_teacher WHERE username='$username'"); //Query the users table if there are matching rows equal to $username
		$exists = mysql_num_rows($query); //Checks if username exists
		$table_users = "";
		$table_password = "";

		if($exists > 0) //IF there are no returning rows or no existing username
		{
			while($row = mysql_fetch_assoc($query)) //display all rows from query
			{
				$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
				$table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
			}

			//echo $table_users;
			//echo $table_password;

			if(($username == $table_users)) // checks if there are any matching fields
			{
					if(password_verify($password, $table_password))
					{
						$_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
						header("location: teacherhome.php"); // redirects the user to the authenticated home page
					}
					
			}
			else
			{
				//echo 'inco P';
				//Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
				Print '<script>window.location.assign("teacherlogin.php?id=1");</script>'; // redirects to login.php
			}
		}
		else
		{
			//echo 'inco U';
			//Print '<script>alert("Incorrect Username!");</script>';
			Print '<script>window.location.assign("teacherlogin.php?id=2");</script>';
		}		
	}

	if((int)$_GET['id']==3)
	{
		//echo $username;

		$query = mysql_query("SELECT * from admin WHERE username='$username'"); //Query the users table if there are matching rows equal to $username
		$exists = mysql_num_rows($query); //Checks if username exists
		$table_users = "";
		$table_password = "";

		if($exists > 0) //IF there are no returning rows or no existing username
		{
			while($row = mysql_fetch_assoc($query)) //display all rows from query
			{
				$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
				$table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
			}

			//echo $table_users;
			//echo $table_password;

			if(($username == $table_users)) // checks if there are any matching fields
			{
					if(password_verify($password, $table_password))
					{
						$_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
						echo 'ok';
						header("location: adminhome.php"); // redirects the user to the authenticated home page
					}
					
			}
			else
			{
				//Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
				Print '<script>window.location.assign("adminlogin.php?id=1");</script>'; // redirects to login.php
			}
		}
		else
		{
			//Print '<script>alert("Incorrect Username!");</script>';
			Print '<script>window.location.assign("adminlogin.php?id=2");</script>';
		}		
	}

?>