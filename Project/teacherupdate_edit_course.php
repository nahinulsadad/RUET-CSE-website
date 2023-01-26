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
				$p_id = mysql_real_escape_string($_POST['p_id']);



				$query = mysql_query("SELECT s_id,ct1,ct2,ct3,ct4, lab1, lab2, lab3, lab4 FROM project as P 
									WHERE t_id = '$teacher_id' && c_id = '$course_id' && s_id='$student_id' and p_id='$p_id';");

				while($row = mysql_fetch_array($query))
				{
						$CT1 = $row['ct1'];
						$CT2 = $row['ct2'];
						$CT3 = $row['ct3'];
						$CT4 = $row['ct4'];

						$LAB1 = $row['lab1'];
						$LAB2 = $row['lab2'];
						$LAB3 = $row['lab3'];
						$LAB4 = $row['lab4'];
				}

				$query = mysql_query("SELECT c_type FROM course WHERE c_id = '$course_id';");

				while($row = mysql_fetch_array($query))
				{
					$type = $row['c_type'];
				}

				echo $CT1;
				echo '<br/>';
				
				echo $CT2;
				echo '<br/>';

				echo $CT3;
				echo '<br/>';

				echo $CT4;
				echo '<br/>';

				if($type==1)
				{

					echo '-------';
					echo '<br/>';					

					if(!empty($_POST['CT1']|$_POST['CT1']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT1']);

						if($temp<=20 && $temp>=0)
						{
							$CT1 = $temp;
						} 
						echo $CT1;
						echo '<br/>';
					}
		
					if(!empty($_POST['CT2']|$_POST['CT2']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT2']);

						if($temp<=20 && $temp>=0)
						{
							$CT2 = $temp;
						} 
						echo $CT2;
						echo '<br/>';
					}

					if(!empty($_POST['CT3']|$_POST['CT3']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT3']);

						if($temp<=20 && $temp>=0)
						{
							$CT3 = $temp;
						}
						echo $CT3;
						echo '<br/>';						

					}
					
					if(!empty($_POST['CT4']|$_POST['CT4']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT4']);

						if($temp<=20 && $temp>=0)
						{
							$CT4 = $temp;
						}
						echo $CT4;
						echo '<br/>';						
					}

					mysql_query("UPDATE project SET ct1=$CT1, ct2=$CT2, ct3=$CT3, ct4=$CT4 
											WHERE t_id='$teacher_id' and c_id='$course_id' and s_id=$student_id and p_id='$p_id'") ;

				}
				else
				{
					echo 'nahin';
					echo '<br/>';

					if(!empty($_POST['CT1']|$_POST['CT1']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT1']);

						$LAB1 = $temp;

						echo $CT1;
						echo '<br/>';
					}
		
					if(!empty($_POST['CT2']|$_POST['CT2']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT2']);

						$LAB2 = $temp;
						echo $CT2;
						echo '<br/>';
					}

					if(!empty($_POST['CT3']|$_POST['CT3']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT3']);

						$LAB3 = $temp;
						echo $CT3;
						echo '<br/>';						

					}
					
					if(!empty($_POST['CT4']|$_POST['CT4']=='0'))
					{
						$temp = (float) mysql_real_escape_string($_POST['CT4']);

						$LAB4 = $temp;
						echo $CT4;
						echo '<br/>';						
					}
					

					mysql_query("UPDATE project SET lab1='$LAB1', lab2='$LAB2', lab3='$LAB3', lab4='$LAB4' 
											WHERE t_id='$teacher_id' and c_id='$course_id' and s_id=$student_id and p_id='$p_id'") ;
				} 

				
				$query = mysql_query("SELECT distinct Section FROM project WHERE c_id='$course_id' and t_id='$teacher_id' and s_id='$student_id' and p_id='$p_id'");

				$section='';
				while($row = mysql_fetch_array($query))
				{
					$section = $row['Section'];
				}

				$url = '?id1='.$course_id. '&id2='.$teacher_id. '&id3='.$student_id.'&p_id='.$p_id.'&id7='.$section;
				echo $url;

				$url2 = '#'.$student_id;
				
				header('location: teacherupdate.php'.$url.$url2);

				
				
			}
?>
	</body>
</html>

