<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}

	$username = $_GET['id2'];

	mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
	mysql_select_db("p_db") or die("Cannot connect to database"); //Connect to database

	$query = mysql_query("SELECT * from admin WHERE username='$username'"); //Query the users table if there are matching rows equal to $username
	$exists = mysql_num_rows($query); //Checks if username exists
	$table_users = "";
	
	if($exists > 0) //IF there are no returning rows or no existing username
	{
			while($row = mysql_fetch_assoc($query)) //display all rows from query
			{
				$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
			}

			echo $table_users;

			if($username == $table_users) // checks if there are any matching fields
			{
				
				$_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
				echo 'ok';				
			}
			else
			{
				Print '<script>window.location.assign("adminlogin.php");</script>'; // redirects to login.php
			}
	}
	else
	{
		Print '<script>window.location.assign("adminlogin.php");</script>';
	}

	$s_id = $_GET['id1'];
	echo $s_id;
	
	$series = substr($s_id,0,2);
	echo $series;

	mysql_query("UPDATE user_student SET authorize = 1 WHERE username = '$s_id'");

	header('location: adminhome.php?id1='. $series.'');
	exit();

?>