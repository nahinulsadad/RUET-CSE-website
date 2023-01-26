<!DOCTYPE html>
<html>
<head>
	<!--Steve Job's personal website
		Author: Nahin Ul Sadad
		Date: 11/17/2015
	-->
	<title>Sadia Zaman Mishu</title>
	<meta name="viewpoint" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="reset.css">
	
	<link rel="stylesheet" type="text/css" href="teaching.css">
	<link rel="stylesheet" type="text/css" href="default.css"/>
	<link rel="stylesheet" type="text/css" href="home.css"/>
	<meta charset="UTF-8">
</head>

<?php
	mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
	mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database 
?>

<body class="teaching">
	<header>
		<hgroup>
			<h1><a href="index.htm">Sadia Zaman Mishu</a></h1>
			<h2>Lecturer, Dept. of CSE @ RUET</h2>
		</hgroup>

		<address>
			<p>Dept. of Computer Science &#38; Engineering<br/>
			   Rajshahi University of Engineering &#38; Technology</br></p>
			   Kazla, Rajshahi-6204</br>
		</address>

		<img src="ruet.png"/>
	</header>

	<label for="show-menu" class="show-menu">Show Menu</label>
	<input type="checkbox" id="show-menu" role="button">
	<ul id="menu">
		<li><a href="index.htm" class="home">About</a></li>
		<li><a href="academic.htm" class="academic">Academic</a></li>
		<li><a href="teaching.php" class="teaching">Teaching</a></li>
		<li><a href="others.htm" class="others">Other Stuff</a></li>
		<li><a href="contact.htm" class="contact">Contact</a></li>
	</ul>

	<nav class="navigation">
		<ul>
			<li><a href="contact.htm" class="contact">Contact</a></li>
			<li><a href="others.htm" class="others">Other Stuff</a></li>
			<li><a href="teaching.php" class="teaching">Teaching</a></li>
			<li><a href="academic.htm" class="academic">Academic</a></li>
			<li><a href="index.htm" class="home">About</a></li>
		</ul>
	</nav>

	<section >
		<article id="heading">
			<h2>My current courses</h2>
		</article>

		<?php
			$query = mysql_query("SELECT distinct C.c_id, C.c_name FROM teacher as T, project as P, course as C WHERE T.t_id='SZM' && T.t_id=P.t_id 
												&& C.c_id = P.c_id"); // SQL Query
				
			while($row = mysql_fetch_array($query))
			{
				Print "<article class=\"left_border\">
							<h2 class=\"course\">&nbsp; &nbsp; ".$row['c_id']." - ".$row['c_name']."</h2>
					</article>";
			}
		?>

		<article class="left_border">
			<p>If you are my student taking my current course, click here to <a href="http://localhost/project4/login.php">login</a>.</p>			
		</article>

	</section>

	<footer>
		<address>
			<p>2014-2015 &copy; Sadia Zaman Mishu</p>
		</address>
	</footer>

</body>
</html>