<?php
    session_start();
    if($_SESSION['user']){
    }
    else{
        header("location:index.php");
    }
    
    if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
    {
        $course_id = strtoupper(mysql_real_escape_string($_POST['course_id']));
        $course_name = (mysql_real_escape_string($_POST['course_name']));
        $course_type = (mysql_real_escape_string($_POST['course_type']));

        $NULL = 0;
        if(empty($course_name))
        {
          $NULL=1;
        }

        //echo $course_id;
        //print '</br>';
        
        //echo $course_name;
        //print '</br>';

        //echo $course_type;
        //print '</br>';

        //echo $NULL;
        //print '</br>';

        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("p_db") or die("Cannot connect to database");
        $query = mysql_query("Select c_id from course");

        $bool1 = 0;
        while ($row = mysql_fetch_array($query)) 
        {
            $table_c_id = $row['c_id'];

            if($course_id == $table_c_id)
            {
                $bool1=1;
                //Print '<script>alert("Teacher ID is already taken!");</script>'; //Prompts the user
                Print '<script>window.location.assign("addcourse.php?id=1");</script>'; // redirects to login.php
            }
        }

        if(!$bool1)
        {
            if(!$NULL)
            {
                mysql_query("INSERT INTO course (c_id, c_name, c_type) VALUES ('$course_id', '$course_name', '$course_type')");

            } 
            else
            {
                mysql_query("INSERT INTO course (c_id, c_name, c_type) VALUES ('$course_id', NULL, '$course_type')");
            }         

            //Print '<script>alert("Successfully Registered!");</script>';
            Print '<script>window.location.assign("addcourse.php?id=2");</script>';
        }
        
      }
        
?>