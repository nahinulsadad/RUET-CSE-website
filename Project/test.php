<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<form class="form-horizontal" action="teacherupdate_edit_course.php" method="POST">

  <div class="form-group" form-group-lg>
    <label for="user" class="col-sm-2 control-label">CT1: </label>
        <div class="col-sm-8" style="height: 32px;">
        <p id="new_coder"></p>    
        </div>
  </div>

  
  <input type="hidden" name="course_id" value="'.$course_id.'" /> 
  <input type="hidden" name="teacher_id" value="'.$teacher_id.'" />
  <input type="hidden" name="bookId" id="bookId" />

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">        
            <input type="submit" class="btn btn-default" value="Update"/>
    </div>
  </div>
</form>

<?php  
  $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

  $revurl = strrev ($url);

  $revstring = '';
  for($i=0; $i<=5; $i++)
  {
    $revstring .= $revurl[$i];
  }

  $result = strrev($revstring);
  echo $result;

?>

<script type="text/javascript">
      string2="<input type=\"text\" class=\"form-control\" placeholder=\"CT1\" name=\"CT1\"/><br/>";
      //window.alert(string2);
     document.getElementById("new_coder").innerHTML = string2;
</script>

<body>
</body>
</html>