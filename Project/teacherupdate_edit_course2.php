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

		
		<br/>
		<?php
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{

				mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysql_select_db("p_db") or die("Cannot connect to database"); //Connect to database

				$course_id = mysql_real_escape_string($_POST['course_id']);
				$teacher_id = mysql_real_escape_string($_POST['teacher_id']);
				$student_id = mysql_real_escape_string($_POST['bookId']);
				$type = mysql_real_escape_string($_POST['type']);
				$p_id = mysql_real_escape_string($_POST['p_id']);
				$series = '';
				$section = '';

				if(isset($_POST['series']))
				{
					$series = mysql_real_escape_string($_POST['series']);
				}

				if(isset($_POST['section']))
				{
					$section = mysql_real_escape_string($_POST['section']);
				}

				echo $course_id;
				echo $teacher_id;
				echo $student_id;
				echo $type;
				echo $section;
				echo $series;

				$query=mysql_query("SELECT Series, Section FROM project WHERE s_id='$student_id' and p_id='$p_id'");
				
				while($row = mysql_fetch_array($query))
				{
					$series = $row['Series'];
					$section = $row['Section'];
				}

				if($type==1 && !empty($series))
				{
					
					//mysql_query("INSERT INTO project(t_id, s_id, c_id, ct1, ct2, ct3, ct4, lab1, lab2, lab3) 
               						//VALUES ('$teacher_id','$student_id','$course_id','0','0','0','0','-','-','-')");
					mysql_query("INSERT INTO project(p_id, t_id, s_id, c_id, Series, Section, ct1, ct2, ct3, ct4, lab1, lab2, lab3) 
                    		VALUES ('$p_id', '$teacher_id','$student_id','$course_id','$series','$section', '0','0','0','0','-','-','-')");
				}
				else if($type==2)
				{
					mysql_query("DELETE FROM project  WHERE t_id='$teacher_id' and c_id='$course_id' and s_id=$student_id and p_id='$p_id'") ;
				}
				





				if(empty($series))
				{
					$url = '?id1='.$course_id. '&id2='.$teacher_id.'&p_id='.$p_id.'&id3='.$student_id;
					echo $url;

					$url2 = '#'.$student_id;
					
					header('location: teacherupdate.php'.$url.$url2);
				}
				else
				{

					$url = '?id1='.$course_id. '&id2='.$teacher_id.'&p_id='.$p_id. '&id3='.$student_id.'&id7='.$section;
					echo $url;

					$url2 = '#'.$student_id;
					
					header('location: teacherupdate.php'.$url.$url2);


				}
				

			}
	?>
	</body>
</html>

