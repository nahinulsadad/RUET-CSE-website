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
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	?>

	<body>
	<div class="container" style="padding-top:2px;">
		<div class="row">

			<?php
				mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database 
				
				$query = mysql_query("SELECT s_name FROM student WHERE s_id = '$user'");
				$row = mysql_fetch_array($query);


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
                        <li class="active"><a href="studenthome.php">Home</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <?php
			if(!empty($_GET['id']))
			{
				if((int)$_GET['id']==1)
				{
					Print '<br><br>
							<div class="container">
								<div class="alert alert-success">
									<p>Course Registration Successful!</p>
								</div>
							</div>';
					/*Print '<script>alert("Course Registration Successful!");</script>';
			        Print '<script>window.location.assign("userhome.php");</script>';	*/

				}

				if((int)$_GET['id']==2)
				{
					Print '<br><br>
    						<div class="container">
								<div class="alert alert-danger">
									<p>Course is already registered or wrong course id or tacher id!</p>
								</div>
							</div>';
					/*Print '<script>alert("Course is already registered or wrong course id or tacher id");</script>';
			        Print '<script>window.location.assign("userhome.php");</script>';*/	
				}

				$page = $_SERVER['PHP_SELF'];
				$sec = "3";
				header("Refresh: $sec; url=$page");
			}
		?>

    <div class="container">
    	<br>
    	<br>
    	<br>

		<?php
			$query = mysql_query("SELECT authorize FROM user_student WHERE username='$user';");


			$authorize=0;
			while($row = mysql_fetch_array($query))
			{
				$authorize=$row['authorize'];
			}

			if($authorize==1)
			{
				Print '<h2 align="center" style="padding-top:5px;">My Courses</h2>
						<table class="table table-bordered table-striped" border="1px" width="100%">
						<tr>
							<th class="text-center">Course Id</th>
							<th class="text-center">Course title</th>
							<th class="text-center">Course teacher</th>
						</tr>';
					
				$student_id = (int)$user;
				$query = mysql_query("SELECT * FROM teacher as T, project as P, student as S, course as C WHERE S.s_id='$student_id' 
										&& T.t_id=P.t_id && S.s_id = P.s_id && C.c_id = P.c_id && C.c_type='1' ;"); // SQL Query
				
				while($row = mysql_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center"><a href="studentupdate.php?id1='. $row['c_id'] .'&id2='.$row['t_id'].'">'. $row['c_id'] . '</a> </td>';;
						Print '<td align="center">'. $row['c_name'] . "</td>";
						Print '<td align="center">'. $row['t_name']. "</td>";
					Print "</tr>";
				}
				Print '</table>';				
			}

			if($authorize==2)
			{
				Print '<h4 style="text-align:center;">Your account is not activated. Contact Admin for activation.</h4>';
				Print '	<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>';
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