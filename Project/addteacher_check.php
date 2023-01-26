<?php
    session_start();
    if($_SESSION['user']){
    }
    else{
        header("location:index.php");
    }
    
    if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
    {
        $teacher_id = strtoupper(mysql_real_escape_string($_POST['teacher_id']));
        $teacher_name = (mysql_real_escape_string($_POST['teacher_name']));
        $teacher_desig = (mysql_real_escape_string($_POST['teacher_designation']));
        $teacher_website = (mysql_real_escape_string($_POST['teacher_website']));

	$options = [
    		'cost' => 12,
	  ];
	  $password = password_hash(mysql_real_escape_string($_POST['password']), PASSWORD_BCRYPT, $options);

        $NULL = 0;
        if(empty($teacher_website))
        {
          $NULL=1;
        }

        //echo $teacher_id;
        //print '</br>';
        //echo $teacher_name;
                //print '</br>';

        //echo $teacher_website;
        //print '</br>';


        $array = array("", "Professor", "Associate Professor", "Assistant Professor", "Lecturer");
        $teacher_designation = "";
        $teacher_designation = $array[$teacher_desig];
        //echo $teacher_designation;
        //print '</br>';

        //echo $NULL;
        //print '</br>';

        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("p_db") or die("Cannot connect to database");
        $query = mysql_query("Select t_id from teacher");

        $bool1 = 0;
        while ($row = mysql_fetch_array($query)) 
        {
            $table_t_id = $row['t_id'];

            if($teacher_id == $table_t_id)
            {
                $bool1=1;
                //Print '<script>alert("Teacher ID is already taken!");</script>'; //Prompts the user
                Print '<script>window.location.assign("addteacher.php?id=1");</script>'; // redirects to login.php

            }
        }

        if(!$bool1)
        {
            if(!$NULL)
            {
                mysql_query("INSERT INTO teacher(t_id, t_name, t_designation, t_website, t_rank) 
                                VALUES ('$teacher_id','$teacher_name','$teacher_designation','$teacher_website','$teacher_desig')");

                mysql_query("INSERT INTO user_teacher (username, password) VALUES ('$teacher_id', '$password')");

            } 
            else
            {
                mysql_query("INSERT INTO teacher(t_id, t_name, t_designation, t_website, t_rank) 
                                VALUES ('$teacher_id','$teacher_name','$teacher_designation',NULL,'$teacher_desig')");

                mysql_query("INSERT INTO user_teacher (username, password) VALUES ('$teacher_id', '$password')");
            }         

            //Print '<script>alert("Successfully Registered!");</script>';
            Print '<script>window.location.assign("addteacher.php?id=2");</script>';
        }
        
      }
        
?>