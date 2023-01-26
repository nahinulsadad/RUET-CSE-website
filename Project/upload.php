<?php
	if(isset($_FILES['file']))
	{
		$no = mysql_real_escape_string($_POST['no']);
		//$course_id = mysql_real_escape_string($_POST['course_id']);
		//$day = mysql_real_escape_string($_POST['day']);
		//$topics = mysql_real_escape_string($_POST['topics']);
		//echo $teacher_id;
		//echo $course_id;
		//echo $day;
		//echo $topics;
		

		$file = $_FILES['file'];

		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];

		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		$file_name = str_replace($file_ext, "", $file_name);
		$file_name = substr($file_name, 0, -1);
		echo $file_name;
		echo $file_error;

		if($file_error==0)
		{
			$file_name_new = $file_name.uniqid('', true).'.'.$file_ext;
			$file_destination = 'C:/xampp/htdocs/project5/'.$file_name_new;

				echo $file_destination;

			if(move_uploaded_file($file_tmp, $file_destination))
			{
				echo $file_destination;
			}
		}

		mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
		mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database 
		mysql_query("UPDATE course_plan 
			SET files='$file_destination' WHERE no='$no'");
		
		$query = mysql_query("SELECT t_id, c_id, p_id FROM course_plan WHERE no='$no'");

		while($row = mysql_fetch_array($query))
		{
			$teacher_id = $row['t_id'];
			$course_id = $row['c_id'];
			$p_id = $row['p_id'];
		}
		echo $teacher_id;
		echo $course_id;
		echo $p_id;
		$link = "teacherupdate_courseplan.php?id1=".$teacher_id."&id2=".$course_id."&p_id=".$p_id;
		echo $link;
		header("Location: ".$link);  
	}
?>
