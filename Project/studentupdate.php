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
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
 		   background: none repeat 0 0 #428bca !important;
 		}
    </style> 
  </head>
	<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		//Print '<script>window.alert('.$_SESSION['user'].');</script>';
		header("location:index.html"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	?>

	<body>
		<body>
	<div class="container" style="padding-top:2px;">
		<div class="row">

			<?php
				mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database 
				$query = mysql_query("SELECT s_name FROM student WHERE s_id = '$user'");
				$row = mysql_fetch_array($query);

				$student_id = (int)$_SESSION['user'];
				$course_id = $_GET['id1'];
				$teacher_id = $_GET['id2'];

				if(empty($row['s_name']))
				{
					//Print '<script>window.alert('.$_SESSION['user'].');</script>';
					//Print '<script>window.alert('.$row['s_name'].');</script>';
					header("location:index.html");
				}
			?>

			<div class="col-sm-11" style="padding:0px; margin:0px;">
				<h3 class="btn btn-default pull-right" style="border-width:0px; font-size: 1.2em !important; color:#1abc9c;">
								<strong>Hello <?php Print $row['s_name']?>!</strong></h3>
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
                        <li ><a href="studenthome.php">Home</a></li>
                        <?php
	                        Print '<li class="active"><a href="studentupdate.php?id1='.$course_id.'&id2='.$teacher_id.'">Course Home</a></li>';
                        	Print '<li><a href="studentupdate_status.php?id1='.$course_id.'&id2='.$teacher_id.'">Status</a></li>';  
                        	Print '<li><a href="studentupdate_plan.php?id1='.$course_id.'&id2='.$teacher_id.'">Course Plan</a></li>';  
                        ?>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
	
	<div class="container">
		<?php
			mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
			mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database 
			$query = mysql_query("SELECT * FROM teacher as T, project as P, student as S, course as C WHERE S.s_id=$student_id 
								&& T.t_id=P.t_id && S.s_id = P.s_id && C.c_id = P.c_id && T.t_id = '$teacher_id' && C.c_id = '$course_id';");
		?>

		<h2 style="padding-top:8px !important; margin-bottom: 0px;">Course Update</h2>
		<hr class="page-title-hr" style="margin-top: 5px;" />
		<p style="font-size:18px;">Student id: <?php Print $student_id?></p>
		<p style="font-size:18px;">Course id: <?php Print $course_id?></p>
		<p style="font-size:18px;">Teacher id: <?php Print $teacher_id?></p>

			<?php
				$course_type = 0;
				while($row = mysql_fetch_array($query))
				{		
					$course_type = $row['c_type'];
				}

				if ($course_type==1) 
				{
					Print '<h2 align="center" >CT marks</h2>';
					Print	'<table border="1px" width="100%">';

					Print "<tr>";
						Print '<th class="text-center">CT 1</th>';
						Print '<th class="text-center">CT 2</th>';
						Print '<th class="text-center">CT 3</th>';
						Print '<th class="text-center">CT 4</th>';
						Print '<th class="text-center">Average</th>';

					Print "</tr>";

					$query = mysql_query("SELECT * FROM teacher as T, project as P, student as S, course as C WHERE S.s_id=$student_id 
								&& T.t_id=P.t_id && S.s_id = P.s_id && C.c_id = P.c_id && T.t_id = '$teacher_id' && C.c_id = '$course_id';");

					while($row = mysql_fetch_array($query))
					{
						Print "<tr>";
							Print '<td align="center">'. $row['ct1'] . '</td>';
							Print '<td align="center">'. $row['ct2'] . '</td>';
							Print '<td align="center">'. $row['ct3']. '</td>';
							Print '<td align="center">'. $row['ct4']. '</td>';

							$ctmarks = array($row['ct1'], $row['ct2'], $row['ct3'], $row['ct4']);
						
							/*$cnt=0;
							for($i=0; $i<4; $i++)
							{
								if($ctmarks[$i]>0)
									$cnt++;
							}*/

							$avg=0;
							rsort($ctmarks);
							
							//if($cnt>=3)
							//{}

							$avg = round(($ctmarks[0]+$ctmarks[1]+$ctmarks[2])/3);
							Print '<td align="center">'. $avg. '</td>';

							Print "</tr>";

					}
				}

				if($course_type==2)
				{
					Print '<h2 align="center">Lab performance</h2>';
					Print	'<table border="1px" width="100%">';

					Print "<tr>";
						Print '<th class="text-center">Lab 1</th>';
						Print '<th class="text-center">Lab 2</th>';
						Print '<th class="text-center">Lab 3</th>';
					Print "</tr>";
					
					$query = mysql_query("SELECT * FROM teacher as T, project as P, student as S, course as C WHERE S.s_id=$student_id 
								&& T.t_id=P.t_id && S.s_id = P.s_id && C.c_id = P.c_id && T.t_id = '$teacher_id' && C.c_id = '$course_id';");

					while($row = mysql_fetch_array($query))
					{
						Print "<tr>";
							Print '<td align="center">'. $row['lab1'] . '</td>';
							Print '<td align="center">'. $row['lab2'] . '</td>';
							Print '<td align="center">'. $row['lab3']. '</td>';
						Print "</tr>";

					}

				}

				Print "</table>";

				
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
	<br>
	
	<div class="container">
        <div class="row"  style="background-color: black; text-align: center;">
            <p style="font-size:1em;"><font color="white"> &nbsp; &copy; 2015 Department of Computer Science and Engineering, Rajshahi University of Engineering and Technology, Rajshahi, Bangladesh</font></p>  
        </div>
       </div>
		
	<script src="js/jquery.min.js"></script>
        
        <!-- Bootstrap JS form CDN -->
        <script src="js/bootstrap.min.js"></script>
        
        <!-- jQuery sticky menu -->
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        
        <!-- jQuery easing -->
        <script src="js/jquery.easing.1.3.min.js"></script>
        
        <!-- Main Script -->
        <script src="js/main.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
  </body>
</html>