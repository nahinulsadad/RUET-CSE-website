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
    <link rel="stylesheet" href="css/tableexport.min.css">
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
            background: none repeat scroll 0 0 #FE2E2E;
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
			
			$query = mysql_query("SELECT username FROM admin WHERE username = '$user'");
			$exists = mysql_num_rows($query); //Checks if username exists


			if(!($exists > 0)) //IF there are no returning rows or no existing username
			{
				Print '<script>window.location.assign("adminlogin.php");</script>';
			}
		?>

		<div class="col-sm-11" style="padding:0px; margin:0px;">
				<h3 class="btn btn-default pull-right" style="border-width:0px; font-size: 1.2em !important; color:#1abc9c;">
								<strong>Welcome <?php Print $user?>!</strong></h3>
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
                        <li class="active"><a href="adminhome.php">Home</a></li>
                        <li><a href="addteacher.php">Add teacher</a></li>
                        <li><a href="addcourse.php">Add course</a></li>
                        <li><a href="addnotice.php">Add notice</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <div class="container">
    	<br>
    	<br>
    	<br>
		<h2 align="center" style="padding-top:5px;">Student</h2>
		
		<ul class="nav nav-tabs">
		<?php
			$query = mysql_query("SELECT distinct Series FROM student");
			
			$flag=1;
			$Series="";

			if(isset($_GET['id1'])) 
			{
   				while($row = mysql_fetch_array($query))
				{
					if($row['Series']==$_GET['id1'])
					{
						print '<li class="active"><a href="adminhome.php?id1='. $row['Series'] .'&id2='.$user.'"><strong><h4 style="margin-bottom: 10px;">'.$row['Series'].' Series</h4></strong></a></li>';
						$Series = $row['Series'];
					}
					else
					{
						print '<li><a href="adminhome.php?id1='. $row['Series'] .'&id2='.$user.'"><strong><h4 style="margin-bottom: 10px;">'.$row['Series'].' Series</h4></strong></a></li>';
					}

				}
			}
			else
			{
				while($row = mysql_fetch_array($query))
				{
					if($flag==1)
					{
						print '<li class="active"><a href="adminhome.php?id1='. $row['Series'] .'&id2='.$user.'"><strong><h4 style="margin-bottom: 10px;">'.$row['Series'].' Series</h4></strong></a></li>';
						$flag=0;
						$Series = $row['Series'];
					}
					else
					{
						print '<li><a href="adminhome.php?id1='. $row['Series'] .'&id2='.$user.'"><strong><h4 style="margin-bottom: 10px;">'.$row['Series'].' Series</h4></strong></a></li>';
					}

				}
			}

		?>

	    </ul>

	    </br>

		<table id="table" border="1px" width="100%">
			<tr>
				<th class="text-center">Series</th>
				<th class="text-center">Section</th>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Authorize</th>
                
			</tr>
			<?php
				$query = mysql_query("SELECT Series, Section, student.s_id, s_name,authorize FROM student, user_student 
                                                                    WHERE student.s_id = user_student.username and Series='$Series'
                                                                    	order by authorize desc, Series, Section, s_id"); // SQL Query
				
			while($row = mysql_fetch_array($query))
			{
				Print "<tr>";
				Print '<td align="center">'.$row['Series'].'</td>';
				Print '<td align="center">'. $row['Section'].'</td>';
				Print '<td align="center">'. $row['s_id'].'</td>';
				Print '<td align="center">'. $row['s_name'].'</td>';
				
				if($row['authorize']==1)
				{
					Print '<td align="center" style="width: 152px; ">
					<a href="adminhome_check.php?id1='. $row['s_id'] .'&id2='.$user.'" data-book-id="'.$row['authorize'].'" 
					class="btn btn-primary" role="button" style="
				    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
				    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Approved</a></td>';
				}
				else
				{
					Print '<td align="center" style="width: 152px; ">
					<a href="adminhome_check.php?id1='. $row['s_id'] .'&id2='.$user.'" data-book-id="'.$row['authorize'].'" 
					class="btn btn-danger" role="button" style="
				    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
				    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Approve</a></td>';
				}

				Print "</tr>";
			}
			?>
    	</table>
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
    <br>
    <div class="container">
        <div class="row"  style="background-color: black; text-align: center;">
            <p style="font-size:1em;"><font color="white"> &nbsp; &copy; 2015 Department of Computer Science and Engineering, Rajshahi University of Engineering and Technology, Rajshahi, Bangladesh</font></p>  
        </div>
       </div>

     <script src="js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/FileSaver.min.js"></script>
     <script src="js/tableexport.min.js"></script>
     
     <script>
    	 $('table').tableExport({
    	 	ignoreCols: [4,5]
    	 });
     </script>
	</body>
</html>