<!DOCTYPE html>
<html> 
<head>
<link rel="stylesheet" href="registerstyle.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    </head>
<body style="background: linear-gradient(to right, darkslateblue 0%, darkturquoise 96%);">  
<br>
	<h5><object align="right" width="190"><a href ="studentlogin.php" class="text-dark" onclick="alert('You have logged out successfully!!;') <?php session_destroy(); ?>">Logout</a></object></h5>
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="subjectregistration.php">Subject Registration</a>
  <a href="studentstuedit.php">Edit Profile</a>
  <a href="#">About</a>
  <a href="#">Contact US</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
	<br>
	<br>

	<center><img src="logo.png" height="70" width="120"></img></center>
    <br>
    <br>
	&nbsp;
	&nbsp;
	&nbsp;
	&nbsp;
	<br>
     <center><h1>Student Information</h1></center> 
	 &nbsp;
     &nbsp;

<?php
    
	session_start();
	$u=$_SESSION['user'];
	$p=$_SESSION['pass'];
	global $backlog1;
	global $backlog2;
	global $backlog3;
	global $backlog4;
	global $unchecked1;
	global $unchecked2;
	global $unchecked3;
	global $unchecked4;
	global $elect1;
	global $elect2;
	global $i;
	$sem1 = array();
	$count=0;
	$con=mysqli_connect('localhost','root','') or die(mysql_error());  
    mysqli_select_db($con,'sophomore') or die("cannot select DB");
	
	$query=mysqli_query($con,"SELECT * FROM student_registration WHERE username='".$u."' AND password='".$p."'"); 
    $numrows=mysqli_num_rows($query);
	$query1=mysqli_query($con,"SELECT * FROM sbmp_subjects WHERE semester='1'");
	$numrows1=mysqli_num_rows($query1);
    $_SESSION['sessionrows']=$numrows;
	 
    while($row=mysqli_fetch_assoc($query))
    {  
	$stuname=$row['fname'];
	$stusurname=$row['lname'];
	$stusapid=$row['sap_id'];
	$studob=$row['dob'];
	$stuage=$row['age'];
	$stucourse=$row['course'];
	$stusemester=$row['semester'];
	$_SESSION['sapid']=$stusapid;
	}
	
	while($row1 = mysqli_fetch_array($query1))
    { 
      $sem1[]=$row1;
	}
	
	
	$query2=mysqli_query($con,"SELECT * FROM student_subjects WHERE SAPID='".$stusapid."'");
	$numrows2=mysqli_num_rows($query2);
	
	 while($row2=mysqli_fetch_assoc($query2))
    {  
	 $backlog1=$row2['backlog1'];
	 $backlog2=$row2['backlog2'];
	 $backlog3=$row2['backlog3'];
	 $backlog4=$row2['backlog4'];
	 $unchecked1=$row2['nr1'];
	 $unchecked2=$row2['nr2'];
	 $unchecked3=$row2['nr3'];
	 $unchecked4=$row2['nr4'];
	 $elect1=$row2['elective1'];
	 $elect2=$row2['elective2'];
	 
	}
?>
<h4><table align="center" width="10">

<tr>
  <td>Name&nbsp;</td>
  <td><?php echo $stuname; ?></td>
</tr>

<tr>
  <td>Surname&nbsp;</td>
  <td><?php echo $stusurname; ?></td>
</tr>

<tr>
  <td>SAP ID &nbsp;</td>
  <td><?php echo $stusapid; ?></td>
</tr>

<tr>
  <td>Date Of Birth&nbsp;</td>
  <td><?php echo $studob; ?></td>
</tr>

<tr>
  <td>Age&nbsp;</td>
  <td><?php echo $stuage; ?></td>
</tr>

<tr>
  <td>Course&nbsp;</td>
  <td><?php echo $stucourse; ?></td>
</tr>

<tr>
  <td>Semester&nbsp;</td>
  <td><?php echo $stusemester; ?></td>
</tr>
</table></h4>
<br>
<?php
$count=1;

echo '<center><h4><b>Subjects Cleared<b></h4></center>';
echo '<div align="center">';
echo '<a href="http://localhost:81/SOPHOMORE/studentprofilesem2.php">';
echo '<button type="submit" class="btn btn-success">Next</button>';
echo '</a>';
echo '</div>';
echo '<table class="a" align="center" border="1">';
echo '<tr>';
	echo '<td>';
	echo '<h4>';
    echo "Subject";
	echo '</h4>';
	echo '</td>';
	echo '<td>';
	echo '<h4>';
    echo "Subject Code";
	echo '</h4>';
	echo '</td>';
	echo '<td>';
	echo '<h4>';
    echo "Semester";
	echo '</h4>';
	echo '</td>';
	echo '<td>';
	echo '<h4>';
    echo "Credits";
	echo '</h4>';
	echo '</td>';
	echo '</tr>';
    echo "<br>";
   

if($stusemester>=1)
{
for($x=0; $x<6; $x++)
{
if (($sem1[$x]['subject']!=$backlog1) && ($sem1[$x]['subject']!=$backlog2) && ($sem1[$x]['subject']!=$backlog3) && ($sem1[$x]['subject']!=$backlog4) && ($sem1[$x]['subject']!=$unchecked1) && ($sem1[$x]['subject']!=$unchecked2) && ($sem1[$x]['subject']!=$unchecked3) && ($sem1[$x]['subject']!=$unchecked4))
{
    echo '<table class="a" align="center" border="1">';
	echo '<tr>';
	echo '<td>';
	echo '<h4>';
    echo $sem1[$x]['subject'];
	echo '</h4>';
	echo '</td>';
	echo '<td>';
	echo '<h4>';
    echo $sem1[$x]['subject_code'];
	echo '</h4>';
	echo '</td>';
	echo '<td>';
	echo '<h4>';
    echo $sem1[$x]['semester'];
	echo '</h4>';
	echo '</td>';
	echo '<td>';
	echo '<h4>';
    echo $sem1[$x]['credits'];
	echo '</h4>';
	echo '</td>';
	echo '</tr>';
    echo '</table>';
}
}
}
else
{
}
if($stusemester<1)
{
	echo "<script type='text/javascript'>alert('Please register for the course first!!!')</script>";
}
else
{
}

?>



</body>
</html>  