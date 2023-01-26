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
	                        Print '<li><a href="teacherupdate.php?id1='.$course_id.'&id2='.$teacher_id.'&p_id='.$p_id.'">Course Home</a></li>';
                        	Print '<li><a href="teacherupdate_status.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Status</a></li>';  
                        	Print '<li class="active"><a href="teacherupdate_courseplan.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Course Plan</a></li>';  
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
			          <h4 class="modal-title">Course Plan Update</h4>
			      	</div>
			         <div class="modal-body">
			         	<?php
			         		Print '<form class="form-horizontal" action="teacherupdate_courseplan_edit.php" method="POST">

						     	    <div class="form-group" form-group-lg>
						     	    	<label for="user" class="col-sm-2 control-label">Day: </label>
									    <div class="col-sm-8" style="height: 32px;">
											<p id="CT1"></p> 
										</div>
									</div>

									<div class="form-group" form-group-lg>
						     	    	<label for="user" class="col-sm-2 control-label">Topics: </label>
									    <div class="col-sm-8" style="height: 32px;">
											<p id="CT2"></p> 
										</div>
									</div>

									<div class="form-group" form-group-lg>
						     	    	<label for="user" class="col-sm-2 control-label">Files: </label>
									    <div class="col-sm-8" style="height: 32px;">
											<p id="CT3"></p> 
										</div>
									</div>
	
									<input type="hidden" name="course_id" value="'.$course_id.'" /> 
									<input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
									<input type="hidden" name="p_id" value="'.$p_id.'" />
									<input type="hidden" name="bookId" id="bookId" />
									<input type="hidden" name="type" value="1"/>

								    <div class="form-group">
		    							<div class="col-sm-offset-2 col-sm-4"> 				
								    		<input type="submit" class="btn btn-default" value="Update"/>
				    				    </div>
								    </div>
								</form>';		
						?>
			       	 	
			     	 </div>	     	
			    </div>
			  </div>
			</div>

			<div class="modal" id="my_modal2">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			          <h4 class="modal-title">Delete</h4>
			      	</div>
			         <div class="modal-body">

					<?php

						Print '<form class="form-horizontal" action="teacherupdate_courseplan_edit.php" method="POST">

							<p id="s_id"></p>
				
							<input type="hidden" name="course_id" value="'.$course_id.'" /> 
							<input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
							<input type="hidden" name="p_id" value="'.$p_id.'" />
							<input type="hidden" name="bookId" id="bId" />
							<input type="hidden" name="type" value="2"/>

							<div class="form-group ">
								<div class="container-fluid">
									  <div class="row">
									  		<div class="col-md-6">
									           <input type="submit" class="btn btn-default" value="Delete"/>
											   <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Close</button>
									        </div>

									  </div>
								</div>
							</div>
						</form>';

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

				    var temp1=String($(e.relatedTarget).data('day'));
				    
				    if(temp1=="undefined")
				    {
				    	CT1="<input type=\"text\" class=\"form-control\" name=\"CT1\"/><br/>";
				    }
				    else
				    {
				    	CT1="<input type=\"text\" class=\"form-control\" value=\""
			    			+$(e.relatedTarget).data('day')+"\" name=\"CT1\"/><br/>";
				    }
			    	document.getElementById("CT1").innerHTML = CT1;

			    	var temp2=String($(e.relatedTarget).data('topics'));
				    
				    if(temp2=="undefined")
				    {
				    	CT2="<input type=\"text\" class=\"form-control\" name=\"CT2\"/><br/>";
				    }
				    else
				    {
				    	CT2="<input type=\"text\" class=\"form-control\" value=\""
			    			+$(e.relatedTarget).data('topics')+"\" name=\"CT2\"/><br/>";
				    }
			    	document.getElementById("CT2").innerHTML = CT2;

			    	var temp3=String($(e.relatedTarget).data('files'));
			    	
			    	if(temp3=="undefined")
				    {
				    	CT3="<input type=\"text\" class=\"form-control\" name=\"CT3\"/><br/>";
				    }
				    else
				    {
				    	CT3="<input type=\"text\" class=\"form-control\" value=\""
			    			+$(e.relatedTarget).data('files')+"\" name=\"CT3\"/><br/>";
				    }
			    	document.getElementById("CT3").innerHTML = CT3;

			    	
				});

				$('#my_modal2').on('show.bs.modal', function(e) 
				{
				    //var bookId = $(e.relatedTarget).data('book-id');
				    message = "<h4>Are you want to delete this status?</h4>";
				    //window.alert($(e.relatedTarget).data('delete'));

				    document.getElementById("s_id").innerHTML = message;

				    document.getElementById("bId").value = $(e.relatedTarget).data('delete');
				});
			</script>

		<div class="container">
			<h2 style="padding-top:8px !important;margin-bottom: 0px;">Course Plan Update</h2>
				<hr class="page-title-hr" style="margin-top: 5px;" />
				<p style="font-size:18px;">Teacher id: <?php Print $teacher_id?></p>
				<p style="font-size:18px;">Course id: <?php Print $course_id?></p>	
				<br>

				<!--<a href="#my_modal" data-toggle="modal" data-book-id="">Edit</a>-->
   			 	<a href="#my_modal" data-toggle="modal" data-book-id="" class="btn btn-info" role="button" 
   			 	style="margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
					padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Add a new course plan</a>		
		</div>
		
			
			<?php
				Print '<div class="container">';

				Print '<h2 align="center">Course Plan</h2>';
				Print	'<table border="1px" width="100%">';
				Print "<tr>";
					Print '<th class="text-center">Day</th>';
					Print '<th class="text-center">Topics</th>';
					Print '<th class="text-center">Files</th>';
					Print '<th class="text-center">Edit</th>';
					Print '<th class="text-center">Delete</th>';
				Print "</tr>";

				$query = mysql_query("SELECT * FROM course_plan WHERE t_id='$teacher_id' and c_id = '$course_id' and p_id='$p_id' order by no desc;");

				while($row = mysql_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center">'. $row['day'] . '</td>';
						Print '<div class="row">
								  <div class="col-sm-6"><td align="center">'.$row['topics'].'</td></div>
								  <div class="col-sm-6"></div>
								</div>';

						//Print '<td align="center"><a href="#my_modal" data-toggle="modal" data-book-id="'.$row['no'].'">Edit</a> </td>';

						Print '<td align="center">';
						
						Print '<form action="upload.php" method="post" enctype="multipart/form-data" style="display:inline !important; float:left;">
							<div class="row">
								  <input type="hidden" name="no" value="'.$row['no'].'" /> 
								  <div class="col-sm-6"><input type="file" name="file"></div>
								  <div class="col-sm-6"><input type="submit" value="upload" style="padding-top: 3px;    padding-left: 3px;    padding-right: 3px;    padding-bottom: 3px;"></div>
							</div>
							
							</form>';			
						
							
						Print	'</td>';

						Print '<td align="center" style="width: 152px; ">
									<a href="#my_modal" data-toggle="modal" data-book-id="'.$row['no'].'" 
										data-day="'.$row['day'].'" data-topics="'.$row['topics'].'"
										data-files="'.$row['files'].'"
										class="btn btn-primary" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Edit</a> 
							
								</td>';
					//<a href="#my_modal" data-toggle="modal" data-book-id="nahin">Open Modal</a>
						Print '<td align="center" style="width: 152px; ">
									<a href="#my_modal2" data-toggle="modal" data-delete="'.$row['no'].'" class="btn btn-danger" role="button" style="
									    margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
									    padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Delete</a> 
							
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