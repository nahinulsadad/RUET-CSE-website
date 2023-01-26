<?php
		session_start(); //starts the session
		if($_SESSION['user']){ //checks if user is logged in
		}
		else{
			header("location:index.html"); // redirects if user is not logged in
		}
		$user = $_SESSION['user']; //assigns user value
			
		$output='';
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{

			mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
			mysql_select_db("p_db") or die("Cannot connect to database"); //Connect to database

			$search=$_POST['searchVal'];
			$course_id=$_POST['course_id'];
			$teacher_id=$_POST['teacher_id'];
			$section=$_POST['section'];
			$course_type=$_POST['course_type'];
			$student_id=$_POST['student_id'];
			$p_id = $_POST['p_id'];


			if(empty($search))
			{
				$output .= '<table border="1px" width="100%">';
				$output .= '<tr>';
					$output .= '<th class="text-center">Student id</th>';
					$output .= '<th class="text-center">Student name</th>';
					$output .= '<th class="text-center">CT 1</th>';
					$output .= '<th class="text-center">CT 2</th>';
					$output .= '<th class="text-center">CT 3</th>';
					$output .= '<th class="text-center">CT 4</th>';
					$output .= '<th class="text-center">Average</th>';
					$output .= '<th class="text-center">Edit</th>';
					$output .= '<th class="text-center">Delete</th>';
				$output .= '</tr>';

				$query = mysql_query("SELECT s_id, ct1, ct2, ct3, ct4 FROM project as P 
										WHERE t_id = '$teacher_id' && c_id = '$course_id' && Section='$section' && p_id='$p_id' ORDER BY Series desc, s_id;");
			
				while($row = mysql_fetch_array($query))
				{
					if(!empty($student_id) && $student_id==$row['s_id'])
					{
						$output .= '<tr>';
						$output .= '<td align="center" class="invalid" id="'.$row['s_id'].'">'. $row['s_id'] . '</td>';
						
						$temp = $row['s_id'];
						$query2 = mysql_query("SELECT s_name FROM student WHERE s_id = '$temp'");
						$numResults = mysql_num_rows($query2);
						$row2 = mysql_fetch_array($query2);

						if ($numResults > 0) 
						{
							$output .= '<td class="invalid" align="center">'.$row2['s_name']. '</td>';
						} 
						else 
						{
							$output .= '<td class="invalid" align="center">'.'  '. '</td>';
						}


						$output .= '<td class="invalid" align="center">'. $row['ct1'] . '</td>';
						$output .= '<td class="invalid" align="center">'. $row['ct2'] . '</td>';
						$output .= '<td class="invalid" align="center">'. $row['ct3']. '</td>';
						$output .= '<td class="invalid" align="center">'. $row['ct4']. '</td>';

						$ctmarks = array((float)$row['ct1'], (float)$row['ct2'], (float)$row['ct3'], (float)$row['ct4']);
									
						$avg=0;
						rsort($ctmarks);

						$avg = round(($ctmarks[0]+$ctmarks[1]+$ctmarks[2])/3);
						$output .= '<td class="invalid" align="center">'. $avg. '</td>';

						$output .= '<td class="invalid" align="center" style="width: 152px; ">
									<a href="#my_modal" data-toggle="modal" data-book-id="'.$row['s_id'].'"
										data-ct1="'. $row['ct1'] . '" data-ct2="'. $row['ct2'] . '"
										data-ct3="'. $row['ct3'] . '" data-ct4="'. $row['ct4'] . '"
										data-type="'.$course_type.'"
										class="btn btn-primary" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Edit</a></td>';

						$output .= '<td class="invalid" align="center" style="width: 152px; ">
									<a href="#my_modal2" data-toggle="modal" data-delete="'.$row['s_id'].'" class="btn btn-danger" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Delete</a></td>';

						$output .= '</tr>';
					}
					else
					{
						$output .='<tr>';
						$output .= '<td align="center" id="'.$row['s_id'].'">'. $row['s_id'] . '</td>';
						
						$temp = $row['s_id'];
						$query2 = mysql_query("SELECT s_name FROM student WHERE s_id = '$temp'");
						$numResults = mysql_num_rows($query2);
						$row2 = mysql_fetch_array($query2);

						if ($numResults > 0) 
						{
							$output .= '<td align="center">'.$row2['s_name']. '</td>';
						} 
						else 
						{
							$output .= '<td align="center">'.'  '. '</td>';
						}


						$output .= '<td align="center">'. $row['ct1'] . '</td>';
						$output .= '<td align="center">'. $row['ct2'] . '</td>';
						$output .= '<td align="center">'. $row['ct3']. '</td>';
						$output .= '<td align="center">'. $row['ct4']. '</td>';

						$ctmarks = array((float)$row['ct1'], (float)$row['ct2'], (float)$row['ct3'], (float)$row['ct4']);
									
						$avg=0;
						rsort($ctmarks);

						$avg = round(($ctmarks[0]+$ctmarks[1]+$ctmarks[2])/3);
						$output .= '<td align="center">'. $avg. '</td>';

						$output .= '<td align="center" style="width: 152px; ">
									<a href="#my_modal" data-toggle="modal" data-book-id="'.$row['s_id'].'"
										data-ct1="'. $row['ct1'] . '" data-ct2="'. $row['ct2'] . '"
										data-ct3="'. $row['ct3'] . '" data-ct4="'. $row['ct4'] . '"
										data-type="'.$course_type.'"
										class="btn btn-primary" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Edit</a></td>';

						$output .= '<td align="center" style="width: 152px; ">
									<a href="#my_modal2" data-toggle="modal" data-delete="'.$row['s_id'].'" class="btn btn-danger" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Delete</a></td>';

						$output .= "</tr>";

					}

				}
				$output .= '</table>';
			}
			else
			{
				$output .= '<table border="1px" width="100%">';
				$output .= '<tr>';
					$output .= '<th class="text-center">Student id</th>';
					$output .= '<th class="text-center">Student name</th>';
					$output .= '<th class="text-center">CT 1</th>';
					$output .= '<th class="text-center">CT 2</th>';
					$output .= '<th class="text-center">CT 3</th>';
					$output .= '<th class="text-center">CT 4</th>';
					$output .= '<th class="text-center">Average</th>';
					$output .= '<th class="text-center">Edit</th>';
					$output .= '<th class="text-center">Delete</th>';
				$output .= '</tr>';

				$query = mysql_query("SELECT s_id, ct1, ct2, ct3, ct4 FROM project as P 
										WHERE t_id = '$teacher_id' && c_id = '$course_id' && Section='$section' && p_id='$p_id' && s_id LIKE '%$search%' ORDER BY Series desc, s_id;");
			
				while($row = mysql_fetch_array($query))
				{
					if(!empty($student_id) && $student_id==$row['s_id'])
					{
						$output .= '<tr>';
						$output .= '<td align="center" class="invalid" id="'.$row['s_id'].'">'. $row['s_id'] . '</td>';
						
						$temp = $row['s_id'];
						$query2 = mysql_query("SELECT s_name FROM student WHERE s_id = '$temp'");
						$numResults = mysql_num_rows($query2);
						$row2 = mysql_fetch_array($query2);

						if ($numResults > 0) 
						{
							$output .= '<td class="invalid" align="center">'.$row2['s_name']. '</td>';
						} 
						else 
						{
							$output .= '<td class="invalid" align="center">'.'  '. '</td>';
						}


						$output .= '<td class="invalid" align="center">'. $row['ct1'] . '</td>';
						$output .= '<td class="invalid" align="center">'. $row['ct2'] . '</td>';
						$output .= '<td class="invalid" align="center">'. $row['ct3']. '</td>';
						$output .= '<td class="invalid" align="center">'. $row['ct4']. '</td>';

						$ctmarks = array((float)$row['ct1'], (float)$row['ct2'], (float)$row['ct3'], (float)$row['ct4']);
									
						$avg=0;
						rsort($ctmarks);

						$avg = round(($ctmarks[0]+$ctmarks[1]+$ctmarks[2])/3);
						$output .= '<td class="invalid" align="center">'. $avg. '</td>';

						$output .= '<td class="invalid" align="center" style="width: 152px; ">
									<a href="#my_modal" data-toggle="modal" data-book-id="'.$row['s_id'].'"
										data-ct1="'. $row['ct1'] . '" data-ct2="'. $row['ct2'] . '"
										data-ct3="'. $row['ct3'] . '" data-ct4="'. $row['ct4'] . '"
										data-type="'.$course_type.'"
										class="btn btn-primary" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Edit</a></td>';

						$output .= '<td class="invalid" align="center" style="width: 152px; ">
									<a href="#my_modal2" data-toggle="modal" data-delete="'.$row['s_id'].'" class="btn btn-danger" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Delete</a></td>';

						$output .= '</tr>';
					}
					else
					{
						$output .='<tr>';
						$output .= '<td align="center" id="'.$row['s_id'].'">'. $row['s_id'] . '</td>';
						
						$temp = $row['s_id'];
						$query2 = mysql_query("SELECT s_name FROM student WHERE s_id = '$temp'");
						$numResults = mysql_num_rows($query2);
						$row2 = mysql_fetch_array($query2);

						if ($numResults > 0) 
						{
							$output .= '<td align="center">'.$row2['s_name']. '</td>';
						} 
						else 
						{
							$output .= '<td align="center">'.'  '. '</td>';
						}


						$output .= '<td align="center">'. $row['ct1'] . '</td>';
						$output .= '<td align="center">'. $row['ct2'] . '</td>';
						$output .= '<td align="center">'. $row['ct3']. '</td>';
						$output .= '<td align="center">'. $row['ct4']. '</td>';

						$ctmarks = array((float)$row['ct1'], (float)$row['ct2'], (float)$row['ct3'], (float)$row['ct4']);
									
						$avg=0;
						rsort($ctmarks);

						$avg = round(($ctmarks[0]+$ctmarks[1]+$ctmarks[2])/3);
						$output .= '<td align="center">'. $avg. '</td>';

						$output .= '<td align="center" style="width: 152px; ">
									<a href="#my_modal" data-toggle="modal" data-book-id="'.$row['s_id'].'"
										data-ct1="'. $row['ct1'] . '" data-ct2="'. $row['ct2'] . '"
										data-ct3="'. $row['ct3'] . '" data-ct4="'. $row['ct4'] . '"
										data-type="'.$course_type.'"
										class="btn btn-primary" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Edit</a></td>';

						$output .= '<td align="center" style="width: 152px; ">
									<a href="#my_modal2" data-toggle="modal" data-delete="'.$row['s_id'].'" class="btn btn-danger" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Delete</a></td>';

						$output .= "</tr>";

					}

				}
				$output .= '</table>';
			}


		
		}
		echo($output);
?>

