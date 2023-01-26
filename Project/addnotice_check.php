<?php    
    if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
    {
        $notice = mysql_real_escape_string($_POST['notice']);
        $detail = mysql_real_escape_string($_POST['detail']);
        $link = "";
        $notice_type = (mysql_real_escape_string($_POST['notice_type']));

        $NULL = 0;
        if(empty($link))
        {
          $NULL=1;
        }

        //echo $notice;
        //print '</br>';
        
        //echo $detail;
        //print '</br>';

        //echo $link;
        //print '</br>';


        //echo $notice_type;
        //print '</br>';

        //echo $NULL;
        //print '</br>';


        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("p_db") or die("Cannot connect to database");
        //$query = mysql_query("Select c_id from course");

        date_default_timezone_set('Asia/Dhaka'); // CDT
        $info = getdate();
        $day = $info['mday'];
        $month = $info['mon'];
        $year = $info['year'];
                            
        $date = $year.'-'.$month.'-'.$day;

        if(isset($_FILES['file']))
        {
            echo "ok";
            $file = $_FILES['file'];

            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $file_name = str_replace($file_ext, "", $file_name);
            $file_name = substr($file_name, 0, -1);
            echo $file_name;

            if($file_error==0)
            {
                $file_name_new = $file_name.uniqid('', true).'.'.$file_ext;
                $file_destination = 'C:/xampp/htdocs/project5/'.$file_name_new;

                if(move_uploaded_file($file_tmp, $file_destination))
                {
                    echo $file_destination;
                }
            }

            $link = $file_destination;

            
        }



        if(!$NULL)
        {
            //echo 'ok';
            mysql_query("INSERT INTO notice(notices, details, link, notice_type, dates) 
                            VALUES ('$notice','$detail','$link','$notice_type','$date');");

        } 
        else
        {
            //echo 'oki2';
            mysql_query("INSERT INTO notice(notices, details, link, notice_type, dates) 
                            VALUES ('$notice','$detail',NULL,'$notice_type','$date');");
        }         

        Print '<script>window.location.assign("addnotice.php?id=2");</script>';    
        
    }
        
?>