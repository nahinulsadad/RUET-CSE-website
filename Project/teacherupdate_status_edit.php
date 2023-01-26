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

				$status = '';

				if(isset($_POST["status"]))
				{
					$status = mysql_real_escape_string($_POST['status']);
				}

				$course_id = mysql_real_escape_string($_POST['course_id']);
				$teacher_id = mysql_real_escape_string($_POST['teacher_id']);
				$student_id = (int)mysql_real_escape_string($_POST['bookId']);
				$type = mysql_real_escape_string($_POST['type']);
				$p_id = mysql_real_escape_string($_POST['p_id']);

				echo $type;
				echo $status;
				echo $course_id;
				echo $teacher_id;
				echo $student_id;

				if($type==1)
				{
					if(!empty($_POST['status']))
					{

							$info = getdate();
							$day = $info['mday'];
							$month = $info['mon'];
							$year = $info['year'];
							
							$date = $year.'-'.$month.'-'.$day;
							
						if(empty($_POST['bookId']))
						{
							date_default_timezone_set('Asia/Dhaka'); // CDT


							mysql_query("INSERT INTO update_status(t_id, c_id, status, dates, p_id) VALUES
															('$teacher_id', '$course_id', '$status', '$date', '$p_id')");

						}
						else
						{						
							mysql_query("UPDATE update_status SET status='$status', dates='$date' WHERE t_id='$teacher_id' 
														and c_id='$course_id' and p_id='$p_id' and no=$student_id");				
						}
					}
				}
				else
				{
					mysql_query("DELETE FROM update_status WHERE p_id='$p_id' and no=$student_id");
				}



				$url = '?id1='.$teacher_id. '&id2='.$course_id. '&p_id='.$p_id;
				echo $url;
				
				header('location: teacherupdate_status.php'.$url);
			}
?>
	</body>
</html>

