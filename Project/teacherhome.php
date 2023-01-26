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
                        <li class="active"><a href="teacherhome.php">Home</a></li>
                        <li><a href="takecourse.php">Take a course</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

 

            <div class="modal" id="my_modal2">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title">Delete</h4>
                    </div>
                     <div class="modal-body">

                    <?php

                        Print '<form class="form-horizontal" action="takecourse_edit.php" method="POST">

                            <p id="s_id"></p>
                
                            <input type="hidden" name="type"  id="type"/>
                            <input type="hidden" name="table"  id="table"/>
                            <input type="hidden" name="bookId" id="bId" />

                            <div class="form-group ">
                                <div class="container-fluid">
                                      <div class="row">
                                            <div class="col-md-6">
                                               <input type="submit" class="btn btn-default" value="Confirm"/>
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

                $('#my_modal2').on('show.bs.modal', function(e) 
                {
                    message = "";
                    
                    if($(e.relatedTarget).data('type')=="1")
                    {
                        message = "<h4>Are you want to archive "+$(e.relatedTarget).data('course')+" taken by "+$(e.relatedTarget).data('series')+" series?</h4>";
   
                    }

                    if($(e.relatedTarget).data('type')=="2")
                    {
                        message = "<h4>Are you want to delete "+$(e.relatedTarget).data('course')+" taken by "+$(e.relatedTarget).data('series')+" series?</h4>";
   
                    }
                    //var bookId = $(e.relatedTarget).data('book-id');
                    //window.alert($(e.relatedTarget).data('delete'));

                    if($(e.relatedTarget).data('type')=="3")
                    {
                        message = "<h4>Are you want to Restore "+$(e.relatedTarget).data('course')+" taken by "+$(e.relatedTarget).data('series')+" series?</h4>";
   
                    }

                    document.getElementById("s_id").innerHTML = message;

                    document.getElementById("bId").value = $(e.relatedTarget).data('delete');
                    document.getElementById("type").value = $(e.relatedTarget).data('type');
                    document.getElementById("table").value = $(e.relatedTarget).data('table');
                });
            </script>

          <div class="container">
                <br>
                <br>
                <br>
                <h2 align="center" style="padding-top:5px;">My Courses</h2>
                <table border="1px" width="100%">
                    <tr>
                        <th class="text-center">Series</th>
                        <th class="text-center">Course Id</th>
                        <th class="text-center">Course title</th>
                        <th class="text-center">Archive</th>
                        <th class="text-center">Delete</th>
            </tr>


            <?php
                $teacher_id = $user;
                $query = mysql_query("SELECT distinct P.p_id, PS.series, C.c_id, C.c_name, T.t_id FROM teacher as T, project as P, course as C, project_series as PS
                             WHERE T.t_id='$user' && T.t_id=P.t_id && C.c_id = P.c_id && P.p_id=PS.p_id"); // SQL Query
                
                while($row = mysql_fetch_array($query))
                {
                    Print "<tr>";
                    Print '<td align="center">'.$row['series']."</td>";
                    Print '<td align="center"><a href="teacherupdate.php?id1='. $row['c_id'] .'&id2='.$user.'&p_id='.$row['p_id'].'">'. $row['c_id']. '</a> </td>';
                    Print '<td align="center">'. $row['c_name'] . "</td>";

                        Print '<td align="center" style="width: 152px; ">
                                    <a href="#my_modal2" data-toggle="modal" data-delete="'.$row['p_id'].'" 
                                        data-teacher="'.$row['t_id'].'"  data-course="'.$row['c_id'].'" data-type="1" data-series="'.$row['series'].'"
                                        data-table="1"   
                                        class="btn btn-primary" role="button" style="
                                        margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
                                        padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Archive</a> 
                            
                                </td>';
                    //<a href="#my_modal" data-toggle="modal" data-book-id="nahin">Open Modal</a>
                        Print '<td align="center" style="width: 152px; ">
                                    <a href="#my_modal2" data-toggle="modal" data-delete="'.$row['p_id'].'" 
                                        data-teacher="'.$row['t_id'].'"  data-course="'.$row['c_id'].'" data-type="2"  data-series="'.$row['series'].'" 
                                        data-table="1" 
                                        class="btn btn-danger" role="button" style="
                                        margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
                                        padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Delete</a> 
                            
                                </td>';
                    Print "</tr>";
                }

                Print '</table>';
                Print '</div>';

            ?>

          <div class="container">
                <br>
                <br>
                <br>
                <h2 align="center" style="padding-top:5px;">My Archived Courses</h2>
                <table border="1px" width="100%">
                    <tr>
                        <th class="text-center">Series</th>
                        <th class="text-center">Course Id</th>
                        <th class="text-center">Course title</th>
                        <th class="text-center">Restore</th>
                        <th class="text-center">Delete</th>
            </tr>


            <?php
                $teacher_id = $user;
                $query = mysql_query("SELECT distinct P.p_id, PS.series, C.c_id, C.c_name, T.t_id FROM teacher as T, archived_project as P, course as C, project_series as PS
                             WHERE T.t_id='$user' && T.t_id=P.t_id && C.c_id = P.c_id && P.p_id=PS.p_id"); // SQL Query
                
                while($row = mysql_fetch_array($query))
                {
                    Print "<tr>";
                    Print '<td align="center">'.$row['series']."</td>";
                    Print '<td align="center"><a href="archived_teacherupdate.php?id1='. $row['c_id'] .'&id2='.$user.'&p_id='.$row['p_id'].'">'. $row['c_id']. '</a> </td>';
                    Print '<td align="center">'. $row['c_name'] . "</td>";

                     Print '<td align="center" style="width: 152px; ">
                                    <a href="#my_modal2" data-toggle="modal" data-delete="'.$row['p_id'].'" 
                                        data-teacher="'.$row['t_id'].'"  data-course="'.$row['c_id'].'" data-type="3" data-series="'.$row['series'].'"
                                        data-table="2"   
                                        class="btn btn-primary" role="button" style="
                                        margin-top: 2px;  margin-bottom: 2px; padding-right: 30px; padding-top: 3px;
                                        padding-bottom: 3px; padding-left: 30px;  margin-right: 0px; font-size:large;">Restore</a> 
                            
                                </td>';
                    //<a href="#my_modal" data-toggle="modal" data-book-id="nahin">Open Modal</a>
                        Print '<td align="center" style="width: 152px; ">
                                    <a href="#my_modal2" data-toggle="modal" data-delete="'.$row['p_id'].'" 
                                        data-teacher="'.$row['t_id'].'"  data-course="'.$row['c_id'].'" data-type="2"  data-series="'.$row['series'].'"  
                                        data-table="2"
                                        class="btn btn-danger" role="button" style="
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