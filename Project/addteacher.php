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
                        <li><a href="adminhome.php">Home</a></li>
                        <li class="active"><a href="addteacher.php">Add teacher</a></li>
                        <li><a href="addcourse.php">Add course</a></li>
                        <li><a href="addnotice.php">Add notice</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <?php
        if(isset($_GET['id']))
        {
            if($_GET['id']==1)
            {
                print '</br>
                       </br>
                        <div class="container">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Teacher ID is already taken!
                            </div>
                       </div>';

                print '<script type="text/javascript">
                            setTimeout(function () {
                                window.location.href= "addteacher.php"; // the redirect goes here
                            },4000); // 5 seconds
                    </script>';  
            }

            if($_GET['id']==2)
            {
                print '</br>
                       </br>
                        <div class="container">
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Successfully Registered!
                            </div>
                        </div>';

                print '<script type="text/javascript">
                            setTimeout(function () {
                                window.location.href= "addteacher.php"; // the redirect goes here
                            },4000); // 5 seconds
                    </script>';
            }
        }

    ?>


    <form class="form-horizontal" action="addteacher_check.php" method="post" role="form">

			<div class="form-group" form-group-lg>
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-4">
            <?php
                if(!isset($_GET['id']))
                {
                    print '</br>';
                }
            ?>
				<h3><strong>Add Teacher Page</strong></h3>
			</div>
		    
		  </div>
		  	
		  <div class="form-group" form-group-lg>
		    <label for="user" class="col-sm-2 control-label">Teacher ID</label>
		    <div class="col-sm-4">
		      <input type="text" name="teacher_id" required="required" class="form-control" placeholder="Teacher ID">
		    </div>
		  </div>
		  
		  <div class="form-group" form-group-sm>
		    <label for="inputPassword" class="col-sm-2 control-label">Teacher Name</label>
		    <div class="col-sm-4">
		      <input type="text" name="teacher_name" required="required" class="form-control" placeholder="Teacher Name">
		    </div>
		  </div>

          <div class="form-group" form-group-sm>
            <label for="inputPassword" class="col-sm-2 control-label">Teacher Designation</label>
            <div class="col-sm-4">
              <select class="form-control" name="teacher_designation">
                <option value="1">Professor</option>
                <option value="2">Associate Professor</option>
                <option value="3">Assistant Professor</option>
                <option value="4">Lecturer</option>
              </select>
            </div>
         </div>

         <div class="form-group" form-group-sm>
            <label for="inputPassword" class="col-sm-2 control-label">Teacher Website</label>
            <div class="col-sm-4">
              <input type="text" name="teacher_website" class="form-control" placeholder="Teacher Website - \teacher\*">
            </div>
          </div>

         <div class="form-group" form-group-sm>
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-4">
              <input type="password" name="password" required="required" class="form-control" placeholder="Password">
            </div>
          </div>
		 
		 <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-4">
		      <button type="submit" class="btn btn-primary" value="login"> Register </button>
		    </div>
		  </div>
	</form>
    <br>

    <?php
        if(!isset($_GET['id']))
        {
            print '</br>';
            print '</br>';   

        }

    ?>

  
    <div class="container">
        <div class="row"  style="background-color: black; text-align: center;">
            <p style="font-size:1em;"><font color="white"> &nbsp; &copy; 2015 Department of Computer Science and Engineering, Rajshahi University of Engineering and Technology, Rajshahi, Bangladesh</font></p>  
        </div>
       </div>	
		
	<!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
  </body>
</html>

