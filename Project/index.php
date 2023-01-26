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
	        p {
	            font-size: 18px;

	          }
	  </style> 
	</head>

  <body>

  		<?php
			mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
			mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database 
			
		?>

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
                        <li class="active"><a href="index.php">Home</a></li>
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
                        <li><a href="teacher.php">Faculties</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

	<div class="modal fade" id="my_modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Notice</h4>
	        </div>
	        <div class="modal-body">
	          <p id="CT4"></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
  	</div>
			       	 	
			     


	<script >
		$('#my_modal').on('show.bs.modal', function(e) 
		{
		    var bookId = $(e.relatedTarget).data('book-id');
		    $(e.currentTarget).find('input[name="bookId"]').val(bookId);
					
			var temp=String($(e.relatedTarget).data('link'));
				    
		    if(temp=="undefined" || temp=="")
		    {
		    	CT4="<p>"+$(e.relatedTarget).data('details')+"</p>";
		    }
		    else
		    {
		    	CT4="<p>"+$(e.relatedTarget).data('details')+"</p><a target=\"_blank\"  href=\""+$(e.relatedTarget).data('link')+"\">Click here</a>";
		    }

		    //window.alert(CT4);
		    document.getElementById("CT4").innerHTML = CT4;

			
		});
	</script>

	<div class="container">
        <div id="myCarousel" data-ride="carousel" class="carousel slide">
	        <!-- Indicators -->
	        <ol class="carousel-indicators">
	            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	            <li data-target="#myCarousel" data-slide-to="1"></li>
	            <li data-target="#myCarousel" data-slide-to="2"></li>
	        </ol>

	        <!-- Wrapper for Slides -->
	        <div class="carousel-inner">
	            <div class="item active">
	                <!-- Set the first background image using inline CSS below. -->
	               <img class="img-responsive center-block item" src="img/p01.png"/>

	            </div>
	            <div class="item">
	                <!-- Set the second background image using inline CSS below. -->
	                <img class="img-responsive center-block item" src="img/p02.png"/>
	            </div>
	            <div class="item">
	                <!-- Set the third background image using inline CSS below. -->
	                <img class="img-responsive center-block item" src="img/p03.png"/>
	            </div>
	        </div>

	        <!-- Controls -->
	        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	            <span class="icon-prev"></span>
	        </a>
	        <a class="right carousel-control" href="#myCarousel" data-slide="next">
	            <span class="icon-next"></span>
	        </a>
   		</div>  			 	


        <div class="media col-sm-6" style="max-height: 320px;">
         	<div class="panel panel-default" style="border-color:white; margin-bottom: 0px;">

		 		<ul class="nav nav-tabs nav-justified">
		    		<li class="active"><a data-toggle="tab" href="#UG" style="border-radius:0px;">
		    			<h3 style="margin-bottom: 12px; padding-left: 5%; padding-right: 5%; ">UG</h3></a>
			    	</li>
			    	<li><a data-toggle="tab" href="#PG" style="border-radius:0px;">
			    		<h3 style="margin-bottom: 12px; padding-left: 5%; padding-right: 5%;">PG</h3></a>
				    </li>
			    	<li><a data-toggle="tab" href="#Other" style="border-radius:0px;">
			    		<h3 style="margin-bottom: 12px; padding-left: 5%; padding-right: 5%;">Other</h3></a>
				    </li>
		 		</ul>
			                	
				<div class="tab-content" style="margin-bottom: 0px;">
					<div id="UG" class="tab-pane in active" style="max-height: 250px; overflow-y:scroll;">
              			   	
              			<table class="table table-bordered" style="margin: 0px;">
						    <tbody>
              				<?php  

              					$query = mysql_query("SELECT * FROM notice WHERE notice_type='UG' order by no desc;");

								while($row = mysql_fetch_array($query))
								{
	              					$timestamp = strtotime($row['dates']);
	              					$newDate = date('d F', $timestamp);

									print '
							     	<tr>
							        	<td class="col-md-3" style="background-color: rgb(23, 167, 139) !important; ">
							        		<h4 style="margin:3px; color:white; text-align:center;">'.$newDate.'</h4>
								        </td>
								        <td class="col-md-9"><a href="#my_modal" data-toggle="modal" 
								        	data-details="'.$row['details'].'" data-link="'.$row['link'].'"  data-book-id="sadad" 
	   										style="font-size:large;" >
											<h4 style="margin: 5px; color:black;">'.$row['notices'].'</h4>
											</a>
	              						 </td>
				  			        </tr>';
								}
              				?>
  
						    </tbody>
						</table>
                    	                       
              		</div>
			    
					<div id="PG" class="tab-pane fade" style="max-height: 250px; overflow-y:scroll;">
              			   	
              			<table class="table table-bordered" style="margin: 0px;">
						    <tbody>
	              				<?php  

	              					$query = mysql_query("SELECT * FROM notice WHERE notice_type='PG' order by no desc;");

									while($row = mysql_fetch_array($query))
									{
		              					$timestamp = strtotime($row['dates']);
		              					$newDate = date('d F', $timestamp);

										print '
								     	<tr>
								        	<td class="col-md-3" style="background-color: rgb(23, 167, 139) !important; ">
								        		<h4 style="margin:3px; color:white; text-align:center;">'.$newDate.'</h4>
									        </td>
									        <td class="col-md-9"><a href="#my_modal" data-toggle="modal" 
									        	data-details="'.$row['details'].'" data-link="'.$row['link'].'"  data-book-id="sadad" 
		   										style="font-size:large;" >
												<h4 style="margin: 5px; color:black;">'.$row['notices'].'</h4>
												</a>
		              						 </td>
					  			        </tr>';
									}
	              				?>  
						    </tbody>
						</table>
                    	                       
              		</div>
			    	
			    	<div id="Other" class="tab-pane fade" style="max-height: 250px; overflow-y:scroll;">
                    	<table class="table table-bordered" style="margin: 0px;">
						    <tbody>
	              				<?php  

	              					$query = mysql_query("SELECT * FROM notice WHERE notice_type='Other' order by no desc;");

									while($row = mysql_fetch_array($query))
									{
		              					$timestamp = strtotime($row['dates']);
		              					$newDate = date('d F', $timestamp);

										print '
								     	<tr>
								        	<td class="col-md-3" style="background-color: rgb(23, 167, 139) !important; ">
								        		<h4 style="margin:3px; color:white; text-align:center;">'.$newDate.'</h4>
									        </td>
									        <td class="col-md-9"><a href="#my_modal" data-toggle="modal" 
									        	data-details="'.$row['details'].'" data-link="'.$row['link'].'"  data-book-id="sadad" 
		   										style="font-size:large;" >
												<h4 style="margin: 5px; color:black;">'.$row['notices'].'</h4>
												</a>
		              						 </td>
					  			        </tr>';
									}
	              				?>  
						    </tbody>
					    </table>
			    	</div>

			  	</div>



            </div>
        </div>

        <div class="media col-sm-6" style="max-height: 320px;">
	        <div class="panel panel-default" style="border-radius:0px;">

	          	<div class="panel-heading">
	                <h2 style="margin-bottom: 12px;">Message</h2>                
	          	</div>

	            <div class="panel-body" style="max-height: 250px; overflow-y:scroll;">
	                  <img class="pull-left img-responsive" src="img/teacher.jpg" alt="about us" style="margin-right: 8px;"> 
	                  <div class="media-body" >
	                     <p style="padding-left: 8px; ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
	                        <a href="#" class="btn btn-info btn-md" role="button" style="border-radius:0px; background-color:#17A78B; border-color:#17A78B;">
	            				<h4 style="margin:2px;">Read more</h4>
	            			</a>
	                  </div>                
	            </div>

            </div>             

        </div>




    </div>

		<div class="services container">
			<div style="visibility:hidden">
				<h2 style="font-size:4px;">Services</h2>
			</div>
		  	<div class="row row-centered">
		       <section class="col-xs-4">
		        <div class="panel panel-default" style="padding:5px; border-radius:0px;">
		          <img class="icon" src="img/Campus_Life_Icon.png" alt="Icon">
		          <h3>Student Life</h3>
		          <p>The student life at CSERUET is full of opportunities and activities to complement the regular academic undertakings along with various services and facilities.</p>
		          <div class="panel-footer">
		            <a href="#" class="btn btn-info btn-md" role="button" style="border-radius:0px; background-color:#17A78B; border-color:#17A78B;">
		            	<h4 style="margin:2px;">Read more</h4>
		            </a>
		          </div>
		        </div>
		        
		    </section>

		    <section class="col-xs-4 ">
		      <div class="panel panel-default" style="padding:5px; border-radius:0px;">
		        <img class="icon" src="img/admission.png" alt="Icon">
		        <h3>Admission</h3>
		        <p>Whether you are new to CSERUET or are looking for more information on activities of CSERUET, you can find information about admission here.</p>
		          <div class="panel-footer">
		            <a href="#" class="btn btn-info btn-md" role="button" style="border-radius:0px; background-color:#17A78B; border-color:#17A78B;">
		            	<h4 style="margin:2px;">Read more</h4>
		            </a>
		          </div>
		      </div>
		    </section>

		    <section class="col-xs-4">
		     <div class="panel panel-default" style="padding:5px; border-radius:0px;">
		      <img class="icon" src="img/notice.png" alt="Icon">
		      <h3>Notice</h3>
		      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
		          <div class="panel-footer">
		            <a href="#" class="btn btn-info btn-md" role="button" style="border-radius:0px; background-color:#17A78B; border-color:#17A78B;">
		            	<h4 style="margin:2px;">Read more</h4>
		            </a>
		          </div>
		      </div>
		    </section>   
		  </div><!-- row -->   
		</div><!-- content container -->   
           
    <div class="container">
        <div class="row"  style="background-color: black; text-align: center;">
            <p style="font-size:1em;"><font color="white"> &nbsp; &copy; 2015 Department of Computer Science and Engineering, Rajshahi University of Engineering and Technology, Rajshahi, Bangladesh</font></p>  
        </div>
       </div>			
	</body>
</html>