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
 		   background: none repeat 0 0 #428bca !important;
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
			$query = mysql_query("SELECT s_name FROM student WHERE student.s_id = $user");
			$row = mysql_fetch_array($query);

			$student_id = (int)$_SESSION['user'];
			$course_id = $_GET['id1'];
			$teacher_id = $_GET['id2'];

			if(empty($row['s_name']))
			{
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
	                        Print '<li><a href="studentupdate.php?id1='.$course_id.'&id2='.$teacher_id.'">Course Home</a></li>';
                        	Print '<li class="active"><a href="studentupdate_status.php?id1='.$course_id.'&id2='.$teacher_id.'">Status</a></li>';  
                        	Print '<li><a href="studentupdate_plan.php?id1='.$course_id.'&id2='.$teacher_id.'">Course Plan</a></li>';  
                        ?>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

			<div class="modal" id="my_modal">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			          <h4 class="modal-title">Status update</h4>
			      	</div>
			         <div class="modal-body">
			         	<?php
			         		Print '<form class="form-horizontal" action="edit1.php" method="POST">
							     	    <div class="form-group" form-group-lg style="padding:8px;">
							     	    		<textarea type="text" class="form-control col-xs-12" name="status" rows="8"></textarea><br/>
										</div>
									<input type="hidden" name="course_id" value="'.$course_id.'" /> 
									<input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
									<input type="hidden" name="bookId" id="bookId" />										
										<div class="form-group">
			    							<div class="col-sm-offset-9 col-sm-3"> 				
									    		<input type="submit" class="btn btn-default" value="Update"/>
					    				    </div>
								    	</div>
									</form>';

							//<textarea class="form-control" id="message" name="message" 
							//placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="10"></textarea>

								/*Print '<form action="edit1.php" method="POST">
									status: <input type="text" name="status"/><br/> 
									<input type="hidden" name="course_id" value="'.$course_id.'" /> 
									<input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
									<input type="hidden" name="bookId" id="bookId" /> 					
								    <input type="submit" class="btn btn-default" value="Update List"/>
								</form>';*/			
						?>
			       	 	
			     	 </div>
			     	
			    </div>
			  </div>
			</div>

			<script >
				$('#my_modal').on('show.bs.modal', function(e) 
				{
				    var bookId = $(e.relatedTarget).data('book-id');
				    $(e.currentTarget).find('input[name="bookId"]').val(bookId);
				    //document.getElementById("bookId").value = $(e.relatedTarget).data('book-id');
				});
			</script>

		<div class="container">
			<h2 style="padding-top:8px !important;margin-bottom: 0px;">Status Update</h2>
				<hr class="page-title-hr" style="margin-top: 5px;" />
				<p style="font-size:18px;">Teacher id: <?php Print $teacher_id?></p>
				<p style="font-size:18px;">Course id: <?php Print $course_id?></p>	
				<br>

		</div>
		
			
			<?php
				Print '<div class="container">';

				$query = mysql_query("SELECT * FROM update_status WHERE t_id='$teacher_id' and c_id = '$course_id' order by no desc;");

				while($row = mysql_fetch_array($query))
				{
					
					$timestamp = strtotime($row['dates']);
					$newDate = date('d-F-Y', $timestamp); 
					
					Print '<h2 style="margin-bottom: 0px;">'.$newDate.'</h2>';

					Print '<hr class="page-title-hr" style="margin: 7px;" />';

						Print '<p style="font-size: 1.5em;">'.$row['status'].'</p>';


					Print "</br>";
				}
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