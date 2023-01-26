<!DOCTYPE html>
<html lang="en">
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Department of Computer Science and Engineering</title>
    
    <!-- Google Fonts -->
    <link href='css/001.css' rel='stylesheet' type='text/css'>
    <link href='css/002.css' rel='stylesheet' type='text/css'>
    <link href='css/003.css' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="js/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="js/bootstrap.min.js"></script>

			<!-- Font Awesome -->
	    <link rel="stylesheet" href="css/font-awesome.min.css">
	    
	    <!-- Custom CSS -->
	    <link rel="stylesheet" href="css/owl.carousel.css">
	    <link rel="stylesheet" href="css/style.css">
	    <link rel="stylesheet" href="css/responsive.css">


	     <style type="text/css">
    	.vcenter {
 		   display: inline-block;
    		vertical-align: middle;
    		float: none;
		}

		th, td {
			font-size: 20px;
		}

		hr{
			border-top-width: 1px;
    		border-top-style: solid;
    		border-top-color: rgb(210, 208, 208);
		}
		.mainmenu-area {
		    background: none repeat scroll 0 0 rgba(236, 138, 27, 0.92);
		}

		.invalid-blink {
    		background-color: #A9BCF5;
		}

    </style>



	</head>

	<?php
		session_start(); //starts the session
		if($_SESSION['user'])
		{ //checks if user is logged in
		}
		else
		{
			header("location:index.html"); // redirects if user is not logged in
		}
		$user = $_SESSION['user']; //assigns user value
	?>

	<body>
	<div class="container" style="padding-top:2px;">
		<div class="row">
		
		<?php
			mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
			mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database 
			$query = mysql_query("SELECT t_name FROM teacher WHERE t_id = '$user'");
			$row = mysql_fetch_array($query);

			if(empty($row['t_name']))
			{
				header("location:teacherlogin.php");
			}
		?>


		<div class="col-sm-11" style="padding:0px; margin:0px;">
				<h3 class="btn btn-default pull-right" style="border-width:0px; font-size: 1.2em !important; color:#1abc9c;">
								<strong>Welcome <?php Print $row['t_name']?>!</strong></h3>
			</div>
			<div class="col-sm-1" style="padding:0px; margin:0px; padding-right:5px;">
				<a class="btn btn-default btn-info" role="button" href="logout.php"><strong>Logout</strong></a>
			</div>
		</div>
	</div>

	<div class="site-branding-area " class="jumbotron vertical-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    <img class="img-responsive" class="pull-right" src="img/ruet.png"/>
                </div>
                <div class="col-sm-10">
                    <h1>Department of Computer Science and Engineering</h1>
                    
                </div>
                
            </div>
        </div>
    </div> <!-- End site branding area -->

		<?php

			
			$teacher_id = $_GET['id2'];
			$course_id = $_GET['id1'];

			if($teacher_id!=$user)
			{
				header("location:teacherlogin.php");	
			}

			$student_id ='';

			if(isset($_GET["id3"]))
			{
				$student_id = $_GET['id3'];
			}

			$p_id ='';

			if(isset($_GET["p_id"]))
			{
				$p_id = $_GET['p_id'];
			}

			$query = mysql_query("SELECT * FROM teacher as T, archived_project as P, course as C WHERE T.t_id=P.t_id
									 &&  C.c_id = P.c_id && T.t_id = '$teacher_id' && C.c_id = '$course_id';");

			$course_type = 0;
				while($row = mysql_fetch_array($query))
				{		
					$course_type = $row['c_type'];
				}
			?>

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li ><a href="teacherhome.php">Home</a></li>
                        <?php
	                        Print '<li class="active"><a href="archived_teacherupdate.php?id1='.$course_id.'&id2='.$teacher_id.'&p_id='.$p_id.'">Course Home</a></li>';
                        	Print '<li><a href="archived_teacherupdate_status.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Status</a></li>';  
                        	Print '<li><a href="archived_teacherupdate_courseplan.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Course Plan</a></li>';  
                        ?>                    
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->


	<div class="container">
		<h2 style="padding-top:8px !important; margin-bottom: 0px;">Course Update</h2>
		<hr class="page-title-hr" style="margin-top: 5px;" />
		<p style="font-size:18px;">Teacher id: <?php Print $teacher_id?></p>
		<p style="font-size:18px;">Course id: <?php Print $course_id?></p>	
		<br>

	</div>


	<div class="container">
	<?php

		if ($course_type==1) 
		{
			Print '<h2 align="center" style="padding-top:5px;">Archived CT marks</h2>';


			Print '<ul class="nav nav-tabs">';

			$query = mysql_query("SELECT distinct `Section` FROM `archived_project` WHERE p_id='$p_id' order by section");
			
			$flag=1;
			$Section="";


			if(isset($_GET['id7'])) 
			{
   				while($row = mysql_fetch_array($query))
				{
					if($row['Section']==$_GET['id7'])
					{
						print '<li class="active"><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$Section = $row['Section'];
					}
					else
					{
						print '<li><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}
			else
			{
				while($row = mysql_fetch_array($query))
				{

					if($flag==1)
					{
						print '<li class="active"><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$flag=0;
						$Section = $row['Section'];

					}
					else
					{
						print '<li><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}

			Print '</ul>';

			Print '</br>';


			Print '<table border="1px" width="100%">';

			Print "<tr>";
				Print '<th class="text-center">Student id</th>';
				Print '<th class="text-center">Student name</th>';
				Print '<th class="text-center">CT 1</th>';
				Print '<th class="text-center">CT 2</th>';
				Print '<th class="text-center">CT 3</th>';
				Print '<th class="text-center">CT 4</th>';
				Print '<th class="text-center">Average</th>';
			Print "</tr>";

			$query = mysql_query("SELECT s_id, ct1, ct2, ct3, ct4 FROM archived_project as P 
									WHERE p_id = '$p_id' and Section='$Section' ORDER BY Series desc, s_id;");
		
			while($row = mysql_fetch_array($query))
			{
					Print "<tr>";
					Print '<td align="center" id="'.$row['s_id'].'">'. $row['s_id'] . '</td>';
					
					$temp = $row['s_id'];
					$query2 = mysql_query("SELECT s_name FROM student WHERE s_id = '$temp'");
					$numResults = mysql_num_rows($query2);
					$row2 = mysql_fetch_array($query2);

					if ($numResults > 0) 
					{
						Print '<td align="center">'.$row2['s_name']. '</td>';
					} 
					else 
					{
						Print '<td align="center">'.'  '. '</td>';
					}


					Print '<td align="center">'. $row['ct1'] . '</td>';
					Print '<td align="center">'. $row['ct2'] . '</td>';
					Print '<td align="center">'. $row['ct3']. '</td>';
					Print '<td align="center">'. $row['ct4']. '</td>';

					$ctmarks = array((float)$row['ct1'], (float)$row['ct2'], (float)$row['ct3'], (float)$row['ct4']);
								
					$avg=0;
					rsort($ctmarks);

					$avg = round(($ctmarks[0]+$ctmarks[1]+$ctmarks[2])/3);
					Print '<td align="center">'. $avg. '</td>';

					Print "</tr>";

				}

			}			

	?>

	</table>
	</div>
	
	<div class="container">
	<?php

		if($course_type==2)
		{
			Print '<h2 align="center" style="padding-top:5px;">Archived Lab performance</h2>';


			Print '<ul class="nav nav-tabs">';

			$query = mysql_query("SELECT distinct `Section` FROM `archived_project` WHERE p_id='$p_id' order by section");
			
			$flag=1;
			$Section="";

			if(isset($_GET['id7'])) 
			{
   				while($row = mysql_fetch_array($query))
				{
					if($row['Section']==$_GET['id7'])
					{
						print '<li class="active"><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$Section = $row['Section'];
					}
					else
					{
						print '<li><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}
			else
			{
				while($row = mysql_fetch_array($query))
				{

					if($flag==1)
					{
						print '<li class="active"><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$flag=0;
						$Section = $row['Section'];

					}
					else
					{
						print '<li><a href="archived_teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}


			Print '</ul>';

			Print '</br>';
			Print '</br>';

			Print '<table border="1px" width="100%">';

			Print "<tr>";
				Print '<th class="text-center">Student id</th>';
				Print '<th class="text-center">Student name</th>';					
				Print '<th class="text-center">Attendence</th>';
				Print '<th class="text-center">Quiz</th>';
				Print '<th class="text-center">Performance</th>';
				Print '<th class="text-center">Viva</th>';
			Print "</tr>";

			$query = mysql_query("SELECT s_id, lab1, lab2, lab3, lab4 FROM archived_project WHERE p_id='$p_id'and Section='$Section' ORDER BY Series desc, s_id;");

			while($row = mysql_fetch_array($query))
			{
				Print "<tr>";
					Print '<td align="center" id="'.$row['s_id'].'">'. $row['s_id'] . '</td>';

					$temp = $row['s_id'];
					$query2 = mysql_query("SELECT s_name FROM student WHERE s_id = '$temp'");
					$numResults = mysql_num_rows($query2);
					$row2 = mysql_fetch_array($query2);

					if ($numResults > 0) 
					{
						Print '<td align="center">'.$row2['s_name']. '</td>';
					} 
					else 
					{
						Print '<td align="center">'.'  '. '</td>';
					}

					Print '<td align="center">'. $row['lab1'] . '</td>';
					Print '<td align="center">'. $row['lab2'] . '</td>';
					Print '<td align="center">'. $row['lab3']. '</td>';
					Print '<td align="center">'. $row['lab4']. '</td>';
					
					
				Print "</tr>";
			
			}
		}
	?>
	</table>
	</div>

	
	<br>
    <br>
	
	<div class="container">
	<?php
		if($course_type==1)
		{
			$url = '?id1='.$course_id. '&id2='.$teacher_id.'&p_id='.$p_id.'&id3='.$Section.'&archive=1';

			Print '<a href="ex.php'.$url.'" class="btn btn-danger" role="button" target="_blank" style="
				 margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
					 padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Make PDF</a>';				
		}
		else
		{
			$url = '?id1='.$course_id. '&id2='.$teacher_id.'&p_id='.$p_id.'&id3='.$Section.'&archive=1';

			Print '<a href="ex2.php'.$url.'" class="btn btn-danger" role="button" target="_blank" style="
				 margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
					 padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Make PDF</a>';
		}


	?>

	</div>   


    <br>
    <br>
    <br>
    <br>
    <br>
     <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row"  style="background-color: black; text-align: center;">
            <p style="font-size:1em;"><font color="white"> &nbsp; &copy; 2015 Department of Computer Science and Engineering, Rajshahi University of Engineering and Technology, Rajshahi, Bangladesh</font></p>  
        </div>
       </div>		


	</body>
</html>