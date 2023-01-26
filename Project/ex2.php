<?php
require('mysql_table.php');

$teacher_id = $_GET['id2'];
$course_id = $_GET['id1'];
$section = $_GET['id3'];
$p_id = $_GET['p_id'];

$archive_flag=0;
$archive ='';

if(isset($_GET["archive"]))
{
	$archive = $_GET['archive'];
	$archive_flag=1;
}

//Connect to database
mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
mysql_select_db("p_db") or die("Cannot connect to database"); //connect to database

//$section='';

class PDF extends PDF_MySQL_Table
{
	public function header()
	{
		global $section;
	    global $course_id;

		$this->SetFont('Arial','',12);
		$this->Cell(0,6,'Department of Computer Science & Engineering, RUET',0,1,'C');
		$this->Cell(0,6,'Lab marks',0,1,'C');	

		

		$this->Cell(0,6,'Course ID: '.$course_id,0,1,'C');
		$this->Ln(1.5);		

		parent::Header();
	}
}

/*$query = mysql_query("SELECT distinct Section FROM project as P 
									WHERE t_id = '$teacher_id' && c_id = '$course_id'");

$stack = array();
while($row = mysql_fetch_array($query))
{
	$section = $row['Section'];
	array_push($stack, $section);
}*/

//print_r($stack);
//echo $stack[0];
//echo $stack[1];

$pdf=new PDF();
	
/*for($i=0; $i<sizeof($stack); $i++)
{*/
	//echo $stack[$i];
	$pdf->AddPage();
	//$section=$stack[$i];

	$pdf->Cell(0,6,'Section: '.$section,0,1,'C');
	$pdf->Ln(4);

	$pdf->AddCol('s_id',40,'Student ID','C');
	$pdf->AddCol('lab1',30,'Attendence', 'C');
	$pdf->AddCol('lab2',30,'Quiz', 'C');
	$pdf->AddCol('lab3',30,'Performance', 'C');
	$pdf->AddCol('lab4',30,'Viva', 'C');

	if($archive_flag==0)
	{
		$pdf->Table("SELECT s_id, lab1, lab2, lab3, lab4 FROM project as P 
			WHERE t_id = '$teacher_id' && c_id = '$course_id' and Section='$section' and p_id='$p_id' ORDER BY series desc, s_id;");
	}

	if($archive_flag==1)
	{
		$pdf->Table("SELECT s_id, lab1, lab2, lab3, lab4 FROM archived_project as P 
			WHERE t_id = '$teacher_id' && c_id = '$course_id' and Section='$section' and p_id='$p_id' ORDER BY series desc, s_id;");
	}

	$pdf->Ln(20);

	$query = mysql_query("SELECT distinct t_name, t_designation FROM teacher as P 
									WHERE t_id = '$teacher_id'");
	while($row = mysql_fetch_array($query))
	{
		$t_name = $row['t_name'];
		$t_designation = $row['t_designation'];
	}
	
	$pdf->Cell(12);
	$pdf->Cell(0,6,$t_name,0,1,'L');
	$pdf->Cell(12);
	$pdf->Cell(0,6,$t_designation,0,1,'L');
/*}*/

$pdf->Output();



/*	


*/
?>
