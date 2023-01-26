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
  </head>
  <body>

       <div class="container" style="padding-top:7px;">
        <div class="row" >
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
                        <li><a href="index.html">Home</a></li>
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
                                Username is not valid! Roll number must be within 0 to 121
                            </div>
                       </div>';
            }

            if($_GET['id']==2)
            {
                print '</br>
                       </br>
                        <div class="container">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Username is not valid! Must have 6 characters
                            </div>
                        </div>';
            }

            if($_GET['id']==3)
            {
                print '</br>
                       </br>
                        <div class="container">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Username has been taken!
                            </div>
                        </div>';
            }

            if($_GET['id']==4)
            {
                print '</br>
                       </br>
                        <div class="container">
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Successfully Registered!
                            </div>
                        </div>';
            }

            print '<script type="text/javascript">
              setTimeout(function () {
                  window.location.href= "register.php"; // the redirect goes here
              },4000); // 5 seconds
            </script>';  
        }

    ?>
    
    <div class="container">

    <form class="form-horizontal" action="register.php" method="post" role="form">
      <div class="form-group" form-group-lg>
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
        <br>
        <h3><strong>Registration Page</strong></h3>
      </div>
        
      </div>

      <div class="form-group" form-group-lg>
        <label for="user" class="col-sm-2 control-label">Enter Name</label>
        <div class="col-sm-4">
          <input type="text" name="name" required="required" class="form-control" placeholder="Enter name">
        </div>
      </div>
        
      <div class="form-group" form-group-lg>
        <label for="user" class="col-sm-2 control-label">Enter Username</label>
        <div class="col-sm-4">
          <input type="text" name="username" required="required" class="form-control" placeholder="Enter username">
        </div>
      </div>
      
      <div class="form-group" form-group-sm>
        <label for="inputPassword" class="col-sm-2 control-label">Enter Password</label>
        <div class="col-sm-4">
          <input type="password" name="password" required="required" class="form-control" placeholder="Enter password">
        </div>
      </div>
     
     <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
          <button class="btn btn-primary" type="submit" value="Register"> Register </button>
        </div>
      </div>
    </form>
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

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $name = mysql_real_escape_string($_POST['name']);
  $username = mysql_real_escape_string($_POST['username']);

  $options = [
    'cost' => 12,
  ];
  $password = password_hash(mysql_real_escape_string($_POST['password']), PASSWORD_BCRYPT, $options);

  $bool = true;
  $authorize = 2;

  mysql_connect("localhost", "root", "") or die(mysql_error());
  mysql_select_db("p_db") or die("Cannot connect to database");
  $query = mysql_query("Select * from user_student");


  if(strlen($username)==6)
  {
    $series = substr($username,0,2);
    print $series;
    print '</br>';
    $sec = (int)(substr($username,3,3));
    print $sec;
    print '</br>';

    if($sec>=1 && $sec<=121)
    {
      if($sec>=1 && $sec<=60)
      {
        $section = 'A';
      }
      else
      {
        $section = 'B';
      }
    }
    else
    {
      $bool = false;
      //Print '<script>alert("Username is not valid! Roll number must be within 0 to 121");</script>';
      Print '<script>window.location.assign("register.php?id=1");</script>';
    }

    Print $section;
  }
  else
  {
    $bool = false;   
    //Print '<script>alert("Username is not valid! Must have 6 characters");</script>';
    Print '<script>window.location.assign("register.php?id=2");</script>';

  }

  while ($row = mysql_fetch_array($query)) 
  {
     $table_users = $row['username'];

     if($username == $table_users)
     {
        $bool = false;
        //Print '<script>alert("Username has been taken!");</script>';
        Print '<script>window.location.assign("register.php?id=3");</script>';
     }
  }



  if ($bool) 
  {
    mysql_query("INSERT INTO student (Series, Section, s_id, s_name) VALUES ('$series', '$section', $username, '$name')");
    mysql_query("INSERT INTO user_student (username, password, authorize) VALUES ('$username', '$password', '$authorize')");

    //Print '<script>alert("Successfully Registered!");</script>';
    Print '<script>window.location.assign("register.php?id=4");</script>';
  }

}
?>
