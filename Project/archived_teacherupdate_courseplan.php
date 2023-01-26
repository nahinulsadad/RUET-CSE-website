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
				header("location:index.html");
			}

			$teacher_id = $_GET['id1'];
			$course_id = $_GET['id2'];

			$p_id ='';

			if(isset($_GET["p_id"]))
			{
				$p_id = $_GET['p_id'];
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
	                        Print '<li><a href="archived_teacherupdate.php?id1='.$course_id.'&id2='.$teacher_id.'&p_id='.$p_id.'">Course Home</a></li>';
                        	Print '<li><a href="archived_teacherupdate_status.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Status</a></li>';  
                        	Print '<li class="active"><a href="archived_teacherupdate_courseplan.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Course Plan</a></li>';  
                        ?>                    
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->


		<div class="container">
			<h2 style="padding-top:8px !important;margin-bottom: 0px;">Course Plan</h2>
				<hr class="page-title-hr" style="margin-top: 5px;" />
				<p style="font-size:18px;">Teacher id: <?php Print $teacher_id?></p>
				<p style="font-size:18px;">Course id: <?php Print $course_id?></p>	
				<br>

		</div>
		
			
			<?php
				Print '<div class="container">';

				Print '<h2 align="center">Archived Course Plan</h2>';
				Print	'<table border="1px" width="100%">';
				Print "<tr>";
					Print '<th class="text-center">Day</th>';
					Print '<th class="text-center">Topics</th>';
					Print '<th class="text-center">Files</th>';
				Print "</tr>";

				$query = mysql_query("SELECT * FROM course_plan WHERE t_id='$teacher_id' and c_id = '$course_id' and p_id='$p_id' order by no desc;");

				while($row = mysql_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center">'. $row['day'] . '</td>';
						Print '<td align="center">'.$row['topics'].'</td>';

						//Print '<td align="center"><a href="#my_modal" data-toggle="modal" data-book-id="'.$row['no'].'">Edit</a> </td>';

						Print '<td align="center">
									<a href="'. $row['files'] .'">Link</a> 
							
								</td>';

					Print "</tr>";
				}

				Print '</table>';
				Print '</div>';

			?>

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
    <br>
    <div class="container">
        <div class="row"  style="background-color: black; text-align: center;">
            <p style="font-size:1em;"><font color="white"> &nbsp; &copy; 2015 Department of Computer Science and Engineering, Rajshahi University of Engineering and Technology, Rajshahi, Bangladesh</font></p>  
        </div>
       </div>			
	</body>
</html>