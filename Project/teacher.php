<!DOCTYPE html>
<html lang="en">
 <head>
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

        li,td{
            font-size: 16px;
        }
    </style> 
  </head>
  <body>
  <div class="container" style="padding-top:7px;">
        <div class="row">
            <div class="col-sm-11" style="padding:0px; margin:0px; padding-right:5px;">
                <a class="btn btn-default btn-success pull-right" role="button" href="login.php"><strong>Login</strong></a>
            </div>
            <div class="col-sm-1" style="padding:0px; margin:0px; padding-right:5px;">
                <a class="btn btn-default btn-info" role="button" href="register.php"><strong>Register</strong></a>
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
                        <li><a href="index.php">Home</a></li>
                        <li class="dropdown">
                           <a href="#" data-toggle="dropdown" class="dropdown-toggle"> About <b class="caret"></b></a>
                           <ul class="dropdown-menu">
                             <li><a href="welcometocse.html"> Welcome to CSERUET </a></li>
                             <li><a href="whycseruet.html"> Why CSERUET </a></li>
                           </ul>
                        </li>

                        <li class="dropdown">
                           <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Academic <b class="caret"></b></a>
                           <ul class="dropdown-menu">
                             <li><a href="admission.html"> Admission</a></li>
                             <li><a href="undergraduate.html"> Undergraduate Program </a></li>
                             <li><a href="graduate.html"> Graduate Program </a></li>
                           </ul>
                        </li>
                        <li class="active"><a href="teacher.php">Faculties</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    	<div class="container">
		<h2 align="center"></br>Faculty Member</h2>
		<table class="table table-bordered table-striped" border="1px" width="100%">
			<tr>
				<th class="text-center">Name</th>
				<th class="text-center">Designation</th>
			</tr>
			<?php
				mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database
				$query = mysql_query("Select t_name, t_designation, t_website from teacher_list order by t_rank, t_series"); // SQL Query
				while($row = mysql_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center"><a href="'. $row['t_website'] .'">'. $row['t_name'] . "</a></td>";
						Print '<td align="center">'. $row['t_designation'] .'</td>';
					Print "</tr>";
				}
			?>
		</table>
    	
        </br>
        </br>
        </br>
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
    	</div>
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