<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<?php
		session_start(); //starts the session
		if($_SESSION['user']){ //checks if user is logged in
		}
		else{
			header("location:index.html"); // redirects if user is not logged in
		}
		$user = $_SESSION['user']; //assigns user value
	?>
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
		
		<br/>
		<?php
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysql_select_db("p_db") or die("Cannot connect to database"); //Connect to database

				$type = (int) mysql_real_escape_string($_POST['type']);
				$table = (int) mysql_real_escape_string($_POST['table']);				
				$p_id = mysql_real_escape_string($_POST['bookId']);

				echo $p_id;
				Print '</br>';

				echo $type;
				Print '</br>';

				$table_name='';
				if($table==1)
				{
					if($type==1)
					{
						$query = mysql_query("SELECT `p_id`, `t_id`, `s_id`, `c_id`, `Series`, `Section`, `ct1`, `ct2`, `ct3`, `ct4`, `lab1`, `lab2`, `lab3`, `lab4` 
							FROM `project` WHERE p_id='$p_id'");

						while($row = mysql_fetch_array($query))
						{
							$p_id = $row['p_id'];
							$t_id = $row['t_id'];
							$s_id = $row['s_id'];
							$c_id = $row['c_id'];
							$Series = $row['Series'];
							$Section = $row['Section'];
							$ct1 = $row['ct1'];
							$ct2 = $row['ct2'];
							$ct3 = $row['ct3'];
							$ct4 = $row['ct4'];
							$lab1 = $row['lab1'];
							$lab2 = $row['lab2'];
							$lab3 = $row['lab3'];
							$lab4 = $row['lab4'];


							mysql_query("INSERT INTO `archived_project`(`p_id`, `t_id`, `s_id`, `c_id`, `Series`, `Section`, `ct1`, `ct2`, `ct3`, `ct4`, `lab1`, `lab2`, `lab3`, `lab4`) 
								VALUES ('$p_id','$t_id','$s_id','$c_id','$Series','$Section','$ct1','$ct2', '$ct3','$ct4','$lab1','$lab2','$lab3','$lab4')");	



							echo "ok";
							print '</br>';
						}

						mysql_query("DELETE FROM project WHERE p_id='$p_id'");
					}					

				}

				if($table==2)
				{
					if($type==3)
					{
						$query = mysql_query("SELECT `p_id`, `t_id`, `s_id`, `c_id`, `Series`, `Section`, `ct1`, `ct2`, `ct3`, `ct4`, `lab1`, `lab2`, `lab3`, `lab4` 
							FROM `archived_project` WHERE p_id='$p_id'");

						while($row = mysql_fetch_array($query))
						{
							$p_id = $row['p_id'];
							$t_id = $row['t_id'];
							$s_id = $row['s_id'];
							$c_id = $row['c_id'];
							$Series = $row['Series'];
							$Section = $row['Section'];
							$ct1 = $row['ct1'];
							$ct2 = $row['ct2'];
							$ct3 = $row['ct3'];
							$ct4 = $row['ct4'];
							$lab1 = $row['lab1'];
							$lab2 = $row['lab2'];
							$lab3 = $row['lab3'];
							$lab4 = $row['lab4'];


							mysql_query("INSERT INTO `project`(`p_id`, `t_id`, `s_id`, `c_id`, `Series`, `Section`, `ct1`, `ct2`, `ct3`, `ct4`, `lab1`, `lab2`, `lab3`, `lab4`) 
								VALUES ('$p_id','$t_id','$s_id','$c_id','$Series','$Section','$ct1','$ct2', '$ct3','$ct4','$lab1','$lab2','$lab3','$lab4')");	



							echo "ok";
							print '</br>';
						}
					}

					mysql_query("DELETE FROM archived_project WHERE p_id='$p_id'");

				}





				

								
				header('location: teacherhome.php');		
			}
		?>


	</body>
</html>
