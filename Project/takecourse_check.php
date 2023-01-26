<?php
    session_start();
    if($_SESSION['user']){
    }
    else{
        header("location:teacherlogin.php");
    }
    
    if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
    {
        $course_id = strtoupper(mysql_real_escape_string($_POST['course_id']));
        $series = (mysql_real_escape_string($_POST['series']));
        $sec = (mysql_real_escape_string($_POST['section']));

        $user = $_SESSION['user']; //assigns user value

        $string = str_replace(' ', '', $course_id);

        $p_id = $user.'_'.$string.'_'.$series;

        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("p_db") or die("Cannot connect to database");

        mysql_query("INSERT INTO project_series(p_id, series) VALUES ('$p_id','$series')");

        $start=0;
        $end=0; 
        $section = "";
        
        if($sec==1|$sec==3)
        {
            $start=1;
            $end=60;
            $section='A';

            $s_id=''.$series;
            //echo $s_id;
            //echo '</br>';

            for($i=$start; $i<=$end; $i++)
            {
                if($i>=100)
                {
                    $s_id=''.$series.'3';
                }
                else
                {
                    $s_id=''.$series.'30';   
                }


                if($i>=0 && $i<=9)
                {
                    $s_id=$s_id.'0'.$i;
                }
                else
                {
                    $s_id=$s_id.$i;   
                }

                mysql_query("INSERT INTO project(p_id, t_id, s_id, c_id,Series, Section, ct1, ct2, ct3, ct4, lab1, lab2, lab3) 
                    VALUES ('$p_id','$user','$s_id','$course_id','$series','$section', '0','0','0','0','-','-','-')");
            }

        }
        
        if($sec==2|$sec==3)
        {
            $start=61;
            $end=120;
            $section='B'; 

            $s_id=''.$series;
            //echo $s_id;
            //echo '</br>';

            for($i=$start; $i<=$end; $i++)
            {
                if($i>=100)
                {
                    $s_id=''.$series.'3';
                }
                else
                {
                    $s_id=''.$series.'30';   
                }


                if($i>=0 && $i<=9)
                {
                    $s_id=$s_id.'0'.$i;
                }
                else
                {
                    $s_id=$s_id.$i;   
                }


                
                mysql_query("INSERT INTO project(p_id, t_id, s_id, c_id,Series, Section, ct1, ct2, ct3, ct4, lab1, lab2, lab3) 
                    VALUES ('$p_id','$user','$s_id','$course_id','$series','$section', '0','0','0','0','-','-','-')");

            }           
        }



        Print '<script>window.location.assign("teacherhome.php");</script>';
        /*while ($row = mysql_fetch_array($query)) 
        {
            $table_s_id = $row['s_id'];

            mysql_query("INSERT INTO project(t_id, s_id, c_id, ct1, ct2, ct3, ct4, lab1, lab2, lab3) 
                VALUES ('$user','$table_s_id','$course_id','0','0','0','0','-','-','-')");
        }

        Print '<script>window.location.assign("teacherhome.php");</script>';*/

        /*if(!$bool1)
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
        }*/
        
      }
        
?>