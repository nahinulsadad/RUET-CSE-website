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

				$course_id = mysql_real_escape_string($_POST['course_id']);
				$teacher_id = mysql_real_escape_string($_POST['teacher_id']);
				$topics_id = (int)mysql_real_escape_string($_POST['bookId']);
				$type = mysql_real_escape_string($_POST['type']);
				$p_id = mysql_real_escape_string($_POST['p_id']);
				
				echo $course_id;
								Print '</br>';
				echo $teacher_id;
								Print '</br>';
				echo $topics_id;
								Print '</br>';
				echo $type;
								Print '</br>';

				if(isset($_POST["CT1"]))
				{
					$day = $_POST['CT1'];
				}

				if(isset($_POST["CT2"]))
				{
					$topics = $_POST['CT2'];
				}

				if(isset($_POST["CT3"]))
				{
					$files = $_POST['CT3'];
				}


				//echo $day;
				//echo $topics;
				//echo $files;

				Print '</br>';

				if($type==1)
				{
					if ($topics_id!=0)
					{
						$query = mysql_query("SELECT * FROM course_plan WHERE t_id='$teacher_id' and c_id = '$course_id' and p_id='$p_id' and no='$topics_id';");

						while($row = mysql_fetch_array($query))
						{
							$Day = $row['day'];
							$Topics = $row['topics'];
							$Files = $row['files'];
						}
						echo $day;
						echo $topics;
						echo $files;

						if(!empty($_POST['CT1']))
						{
							$Day = $day;
							//echo 'no day';
						}


						if(!empty($_POST['CT2']))
						{
							$Topics = $topics;
							//echo "no topic";
						}

						
						if(!empty($_POST['CT3']))
						{
							$Files = $files;
							//echo "no file";
						}

						

						mysql_query("UPDATE course_plan SET day='$Day', topics='$Topics', files='$Files' 
												WHERE t_id='$teacher_id' and c_id='$course_id' and p_id='$p_id' and no='$topics_id';") ;
					}
					else
					{				

						if(!empty($_POST['CT1']) && !empty($_POST['CT2']))
						{
							$Day = $day;
							$Topics = $topics;
							$Files = $files;

							echo $teacher_id;
							Print '</br>';
							echo $course_id;
							Print '</br>';
							echo $day;
							Print '</br>';
							echo $topics;
							Print '</br>';
							echo $files;
							Print '</br>';
							echo $p_id;
							Print '</br>';

							Print '</br>';

							mysql_query("INSERT INTO `course_plan`(`t_id`, `c_id`, `day`, `topics`, `files`, p_id) 
									VALUES ('$teacher_id','$course_id','$Day','$Topics', '$Files', '$p_id');");
						}
					}	
				}
				else
				{
					mysql_query("DELETE FROM course_plan WHERE p_id='$p_id' and no=$topics_id");
				}



						
				$url = '?id1='.$teacher_id. '&id2='.$course_id. '&p_id='.$p_id;
				echo $url;
				
				header('location: teacherupdate_courseplan.php'.$url);		
			}
		?>


	</body>
</html>

