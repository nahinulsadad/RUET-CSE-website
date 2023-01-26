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

			$query = mysql_query("SELECT * FROM teacher as T, project as P, course as C WHERE T.t_id=P.t_id
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
	                        Print '<li class="active"><a href="teacherupdate.php?id1='.$course_id.'&id2='.$teacher_id.'&p_id='.$p_id.'">Course Home</a></li>';
                        	Print '<li><a href="teacherupdate_status.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Status</a></li>';  
                        	Print '<li><a href="teacherupdate_courseplan.php?id1='.$teacher_id.'&id2='.$course_id.'&p_id='.$p_id.'">Course Plan</a></li>';  
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
	          <h4 class="modal-title" id="output">Update</h4>
	      	</div>
	         <div class="modal-body">


			    <?php
				if ($course_type==1) 
				{
					Print '<form class="form-horizontal" action="teacherupdate_edit_course.php" method="POST">

						<div class="form-group" form-group-lg>
						      	<label for="user" class="col-sm-2 control-label">CT1: </label>
							<div class="col-sm-8" style="height: 32px;">
       							 <p id="CT1"></p>  
							</div>
						</div>

						<div class="form-group" form-group-lg>
						       	<label for="user" class="col-sm-2 control-label">CT2: </label>
						    <div class="col-sm-8" style="height: 32px;">
       							 <p id="CT2"></p>  
							</div>
						</div>

						<div class="form-group" form-group-lg>
						       	<label for="user" class="col-sm-2 control-label">CT3: </label>
						    <div class="col-sm-8" style="height: 32px;">
       							 <p id="CT3"></p>  
							</div>
						</div>

						<div class="form-group" form-group-lg>
						       	<label for="user" class="col-sm-2 control-label">CT4: </label>
						    <div class="col-sm-8" style="height: 32px;">
       							 <p id="CT4"></p>  
							</div>
						</div>
	
						<input type="hidden" name="course_id" value="'.$course_id.'" /> 
						<input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
						<input type="hidden" name="p_id" value="'.$p_id.'" />
						<input type="hidden" name="bookId" id="bookId" />

					    <div class="form-group">
		    				<div class="col-sm-offset-2 col-sm-4"> 				
					    		<input type="submit" class="btn btn-default" value="Update"/>
				    	    </div>
					    </div>
					</form>';		

				}
							
				if($course_type==2)
				{
					Print '<form class="form-horizontal" action="teacherupdate_edit_course.php" method="POST">

						<div class="form-group" form-group-lg>
						      	<label for="user" class="col-sm-2 control-label">Attendence: </label>
							<div class="col-sm-8" style="height: 32px;">
       							 <p id="CT1"></p>  
							</div>
						</div>

						<div class="form-group" form-group-lg>
						       	<label for="user" class="col-sm-2 control-label">Quiz: </label>
						    <div class="col-sm-8" style="height: 32px;">
       							 <p id="CT2"></p>  
							</div>
						</div>

						<div class="form-group" form-group-lg>
						       	<label for="user" class="col-sm-2 control-label">Performance: </label>
						    <div class="col-sm-8" style="height: 32px;">
       							 <p id="CT3"></p>  
							</div>
						</div>

						<div class="form-group" form-group-lg>
						       	<label for="user" class="col-sm-2 control-label">Viva: </label>
						    <div class="col-sm-8" style="height: 32px;">
       							 <p id="CT4"></p>  
							</div>
						</div>
	
						<input type="hidden" name="course_id" value="'.$course_id.'" /> 
						<input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
						<input type="hidden" name="p_id" value="'.$p_id.'" />
						<input type="hidden" name="bookId" id="bookId" />

					    <div class="form-group">
		    				<div class="col-sm-offset-2 col-sm-4"> 				
					    		<input type="submit" class="btn btn-default" value="Update"/>
				    	    </div>
					    </div>
					</form>';
				}
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

				Print '<form class="form-horizontal" action="teacherupdate_edit_course2.php" method="POST">

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

	<div class="modal" id="my_modal3">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	          <h4 class="modal-title">Add Student</h4>
	      	</div>
	         <div class="modal-body">

			<?php

					Print '<form class="form-horizontal" action="teacherupdate_edit_course2.php" method="POST">

						<div class="form-group" form-group-lg>
						      	<label for="user" class="col-sm-2 control-label">Series: </label>
				            <div class="col-sm-2">
       							 <input type="text" class="form-control" name="series"/>
							</div>
						</div>

				        <div class="form-group" form-group-sm>
				            	<label for="inputPassword" class="col-sm-2 control-label">Section</label>
				            <div class="col-sm-2">
				              <select class="form-control" name="section">
				                <option value="A">A</option>
				                <option value="B">B</option>
				              </select>
				            </div>
				         </div>					

						<div class="form-group" form-group-lg>
						      	<label for="user" class="col-sm-2 control-label">Student ID: </label>
							<div class="col-sm-8" style="height: 32px;">
       							 <input type="text" class="form-control" name="bookId"/><br/>
							</div>
						</div>
	
						<input type="hidden" name="course_id" value="'.$course_id.'" /> 
						<input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
						<input type="hidden" name="p_id" value="'.$p_id.'" />
						<input type="hidden" name="type" value="1" />						

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

	<script >
		$('#my_modal').on('show.bs.modal', function(e) 
		{
		    //var bookId = $(e.relatedTarget).data('book-id');
		    //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
		    
		    var output_value = 'Update '+ $(e.relatedTarget).data('book-id');
		    document.getElementById("output").innerHTML=output_value;
		    
		    /*window.alert(output_value+"\n"+
		    			 $(e.relatedTarget).data('ct1')+"\n"+
		    			 $(e.relatedTarget).data('ct2')+"\n"+
		    			 $(e.relatedTarget).data('ct3')+"\n"+
		    			 $(e.relatedTarget).data('ct4')
		    			 );*/
		    document.getElementById("bookId").value = $(e.relatedTarget).data('book-id');

		    if($(e.relatedTarget).data('type')==1)
		    {
			    CT1="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct1')+"\" name=\"CT1\"/><br/>";
			    //window.alert(string2);
			    document.getElementById("CT1").innerHTML = CT1;

			    CT2="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct2')+"\" name=\"CT2\"/><br/>";
			    document.getElementById("CT2").innerHTML = CT2;

			    CT3="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct3')+"\" name=\"CT3\"/><br/>";
			    document.getElementById("CT3").innerHTML = CT3;

			    CT4="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct4')+"\" name=\"CT4\"/><br/>";
			    document.getElementById("CT4").innerHTML = CT4;		    	
		    }
		    else
		    {
			    CT1="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct1')+"\" name=\"CT1\"/><br/>";
			    //window.alert(string2);
			    document.getElementById("CT1").innerHTML = CT1;

			    CT2="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct2')+"\" name=\"CT2\"/><br/>";
			    document.getElementById("CT2").innerHTML = CT2;

			    CT3="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct3')+"\" name=\"CT3\"/><br/>";
			    document.getElementById("CT3").innerHTML = CT3;

			    CT4="<input type=\"text\" class=\"form-control\" placeholder=\""
			    			+$(e.relatedTarget).data('ct4')+"\" name=\"CT4\"/><br/>";
			    document.getElementById("CT4").innerHTML = CT4;	
		    }
		});

		$('#my_modal2').on('show.bs.modal', function(e) 
		{
		    //var bookId = $(e.relatedTarget).data('book-id');
		    message = "<h4>Are you want to delete "+$(e.relatedTarget).data('delete')+"?</h4>";
		    //window.alert($(e.relatedTarget).data('delete'));

		    document.getElementById("s_id").innerHTML = message;

		    document.getElementById("bId").value = $(e.relatedTarget).data('delete');
		});




	</script>

	<script type="text/javascript">
		var on = false;
        var nahin = true;
             
        myVar = window.setInterval(
        function() 
      	{
      		$('.invalid').addClass('invalid-blink')

      		setTimeout(myFunction, 3000)
  
        }, 5);

        function myFunction() 
        {
    		$('.invalid-blink').removeClass('invalid-blink')
    		clearInterval(myVar);
		}


	</script>

	<div class="container">
		<h2 style="padding-top:8px !important; margin-bottom: 0px;">Course Update</h2>
		<hr class="page-title-hr" style="margin-top: 5px;" />
		<p style="font-size:18px;">Teacher id: <?php Print $teacher_id?></p>
		<p style="font-size:18px;">Course id: <?php Print $course_id?></p>	
		<br>

		<a href="#my_modal3" data-toggle="modal" data-book-id="" class="btn btn-info" role="button" 
   	 		style="margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
			padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Add a student</a>	
	</div>

	<script type="text/javascript">
		function searchq()
		{
			var searchTxt = $("input[name='search'").val();
			var course = $("input[name='course_id'").val();
			var teacher = $("input[name='teacher_id'").val();
			var sec = $("input[name='section'").val();
			var c_type = $("input[name='course_type'").val();
			var student = $("input[name='student_id'").val();
			var project_id = $("input[name='p_id'").val();

			$.post("search_ct.php", {searchVal:searchTxt, course_id:course, teacher_id:teacher, section:sec, course_type:c_type, student_id:student, p_id:project_id}, 
				function(output){
					//window.alert(output);
					document.getElementById("ckk").innerHTML = output;
					//$("#output").html(output);
			});
		}

		function searchr()
		{
			var searchTxt = $("input[name='search'").val();
			var course = $("input[name='course_id'").val();
			var teacher = $("input[name='teacher_id'").val();
			var sec = $("input[name='section'").val();
			var c_type = $("input[name='course_type'").val();
			var student = $("input[name='student_id'").val();
			var project_id = $("input[name='p_id'").val();

			$.post("search_lab.php", {searchVal:searchTxt, course_id:course, teacher_id:teacher, section:sec, course_type:c_type, student_id:student, p_id:project_id}, 
				function(output){
					//window.alert(output);
					document.getElementById("ckk").innerHTML = output;
					//$("#output").html(output);
			});
		}
	</script>


	</script>

	<div class="container">
	<?php

		if ($course_type==1) 
		{
			Print '<h2 align="center" style="padding-top:5px;">CT marks</h2>';


			Print '<ul class="nav nav-tabs">';

			$query = mysql_query("SELECT distinct `Section` FROM `project` WHERE `c_id`='$course_id' and `t_id`='$teacher_id' order by section");
			
			$flag=1;
			$Section="";


			if(isset($_GET['id7'])) 
			{
   				while($row = mysql_fetch_array($query))
				{
					if($row['Section']==$_GET['id7'])
					{
						print '<li class="active"><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$Section = $row['Section'];
					}
					else
					{
						print '<li><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}
			else
			{
				while($row = mysql_fetch_array($query))
				{

					if($flag==1)
					{
						print '<li class="active"><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$flag=0;
						$Section = $row['Section'];

					}
					else
					{
						print '<li><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}



			Print '</ul>';

			$url = 'teacherupdate.php?id1='.$course_id.'&id2='.$teacher_id.'&id7='.$Section;

			Print '
				<form onkeypress="return event.keyCode != 13" method="post">
					<div class="col-md-offset-9 col-md-3">
			            <div class="input-group">
			                <input type="text" class="form-control" placeholder="Search for roll" onkeydown="searchq();"  
			                			name="search" id="search"	style="margin-top: 8px; margin-bottom: 8px;"/>
			                <input type="hidden" name="course_id" id="course_id" value="'.$course_id.'" /> 
							<input type="hidden" name="teacher_id" id="teacher_id" value="'.$teacher_id.'" />
							<input type="hidden" name="section" id="section" value="'.$Section.'" />
							<input type="hidden" name="course_type" id="course_type" value="'.$course_type.'" />
							<input type="hidden" name="student_id" id="student_id" value="'.$student_id.'"/>
							<input type="hidden" name="p_id" id="p_id" value="'.$p_id.'"/>

			                	<div class="input-group-btn">
			                        <button type="button" class="btn btn-primary" style="padding-right: 12px; padding-top: 6px; padding-left: 12px; padding-bottom: 6px; background:#428BCA;">
			                        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			                        </button>
			                    </div>
			            </div>
			        </div>
			          
				</form>
			';





			Print '<div id="ckk"></div>';
			Print '<script>
						function isEmpty( el )
						{
						    return !$.trim(el.html())
						}
						
						if (isEmpty($(\'#ckk\'))) 
						{
						    var searchTxt = document.getElementById("search").value;
							var course = document.getElementById("course_id").value;
							var teacher = document.getElementById("teacher_id").value;
							var sec = document.getElementById("section").value;
							var c_type = document.getElementById("course_type").value;
							var student = document.getElementById("student_id").value;
							var project_id = document.getElementById("p_id").value;

							$.post("search_ct.php", {searchVal:searchTxt, course_id:course, teacher_id:teacher, section:sec, course_type:c_type, student_id:student, p_id:project_id}, 
								function(output){
									//window.alert(output);
									document.getElementById("ckk").innerHTML = output;
									//$("#output").html(output);
							});
						}
				   </script>';


		}

		if($course_type==2)
		{
			Print '<h2 align="center" style="padding-top:5px;">Lab performance</h2>';


			Print '<ul class="nav nav-tabs">';

			$query = mysql_query("SELECT distinct `Section` FROM `project` WHERE `c_id`='$course_id' and `t_id`='$teacher_id' order by section");
			
			$flag=1;
			$Section="";

			if(isset($_GET['id7'])) 
			{
   				while($row = mysql_fetch_array($query))
				{
					if($row['Section']==$_GET['id7'])
					{
						print '<li class="active"><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$Section = $row['Section'];
					}
					else
					{
						print '<li><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}
			else
			{
				while($row = mysql_fetch_array($query))
				{

					if($flag==1)
					{
						print '<li class="active"><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
						$flag=0;
						$Section = $row['Section'];

					}
					else
					{
						print '<li><a href="teacherupdate.php?id1='. $course_id .'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$row['Section'].'"><strong><h4 style="margin-bottom: 10px;">'.$row['Section'].' Section</h4></strong></a></li>';
					}

				}
			}



			Print '</ul>';

			$url = 'teacherupdate.php?id1='.$course_id.'&id2='.$teacher_id.'&p_id='.$p_id.'&id7='.$Section;

			Print '
				<form onkeypress="return event.keyCode != 13" method="post">
					<div class="col-md-offset-9 col-md-3">
			            <div class="input-group">
			                <input type="text" class="form-control" placeholder="Search for roll" onkeydown="searchr();"  
			                			name="search" id="search"	style="margin-top: 8px; margin-bottom: 8px;"/>
			                <input type="hidden" name="course_id" id="course_id" value="'.$course_id.'" /> 
							<input type="hidden" name="teacher_id" id="teacher_id" value="'.$teacher_id.'" />
							<input type="hidden" name="section" id="section" value="'.$Section.'" />
							<input type="hidden" name="course_type" id="course_type" value="'.$course_type.'" />
							<input type="hidden" name="student_id" id="student_id" value="'.$student_id.'"/>
							<input type="hidden" name="p_id" id="p_id" value="'.$p_id.'"/>

			                	<div class="input-group-btn">
			                        <button type="button" class="btn btn-primary" style="padding-right: 12px; padding-top: 6px; padding-left: 12px; padding-bottom: 6px; background:#428BCA;">
			                        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			                        </button>
			                    </div>
			            </div>
			        </div>
			          
				</form>
			';





			Print '<div id="ckk"></div>';
			Print '<script>
						function isEmpty( el )
						{
						    return !$.trim(el.html())
						}
						
						if (isEmpty($(\'#ckk\'))) 
						{
						    var searchTxt = document.getElementById("search").value;
							var course = document.getElementById("course_id").value;
							var teacher = document.getElementById("teacher_id").value;
							var sec = document.getElementById("section").value;
							var c_type = document.getElementById("course_type").value;
							var student = document.getElementById("student_id").value;
							var project_id = document.getElementById("p_id").value;

							$.post("search_lab.php", {searchVal:searchTxt, course_id:course, teacher_id:teacher, section:sec, course_type:c_type, student_id:student, p_id:project_id}, 
								function(output){
									//window.alert(output);
									document.getElementById("ckk").innerHTML = output;
									//$("#output").html(output);
							});
						}
				   </script>';
		}
	?>

	
	<br>
    <br>
	
	<?php
		if($course_type==1)
		{
			$url = '?id1='.$course_id. '&id2='.$teacher_id.'&p_id='.$p_id.'&id3='.$Section;

			Print '<a href="ex.php'.$url.'" class="btn btn-danger" role="button" target="_blank" style="
				 margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
					 padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Make PDF</a>';				
		}
		else
		{
			$url = '?id1='.$course_id. '&id2='.$teacher_id.'&p_id='.$p_id.'&id3='.$Section;

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