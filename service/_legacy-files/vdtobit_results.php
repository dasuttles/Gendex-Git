<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Valdosta Daily Times Obituary/Death Notice Search Results</title>
</head>

<body>
<h1>Valdosta Daily Times Obituary/Death Notice Search Results</h1><p>
<h3><a href="vdtvitsearch.shtml">Return to the search page.</a></h3>
<?php
	$dbhost = 'codex.valdosta.edu';
	$dbuser = 'archives';
	$dbpassword = 'arch1';
	$dbname = 'extra_credit';

	mysql_connect($dbhost, $dbuser, $dbpassword) or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	

$searchterm=$_GET['searchterm'];

$query = "SELECT month, day, year, vol, issue, record_type, page_section, name_of_deceased, MATCH (name_of_deceased) AGAINST ('$searchterm') AS score FROM vital_records WHERE MATCH (name_of_deceased) AGAINST ('$searchterm')";

$result = mysql_query($query);
$numresults = mysql_num_rows($result); 

echo '<p> You searched for:<strong>'.$searchterm.'</strong></p>';
echo '<p> Number of Results:<strong>'.$numresults.'</strong></p>';

$counter =1;
//echo "$query";

echo "<table border='1' cellspacing = '0'>";
echo "<tr><td bgcolor='#c0c0c0' align='center'><strong>Result Number</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Name of Deceased</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Record Type</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Month</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Day</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Year</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Volume</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Issue</strong></td><td bgcolor='#c0c0c0' align='center'><strong>Page/Section</strong>";
while ($row = mysql_fetch_array($result)){

	echo "<tr>";
	echo "<td>".$counter.".</td>";
	echo "<td>$row[name_of_deceased]</td>";	
	echo "<td>$row[record_type]</td>";		
	echo "<td>$row[month]</td>";
	echo "<td>$row[day]</td>";
	echo "<td>$row[year]</td>";
	echo "<td>$row[vol]</td>";
	echo "<td>$row[issue]</td>";
	echo "<td>$row[page_section]</td>";
	echo "</tr>";

$counter++;
}



?>
</body>
</html>
