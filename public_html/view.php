<?php
	include 'connect.php';

	$db = db_connect();
	$name = $_GET['q'];
	$stmt = $db->prepare("SELECT * FROM `DAGR` WHERE `Name` LIKE ?");
	
	@$stmt->bind_param('s', $name)
	OR die('Could not connect. .. . .. .');
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	print '<table border="5">';
	print '<tr>';
	print '<td> GUID </td>';
	print '<td> Name </td>';
	print '<td> Creator </td>';
	print '<td> Time_created </td>';
	print '<td> Parent_id </td>';
	print '</tr>';

	//fetch records
	while($stmt->fetch()) {
  	    print '<tr>';
	    print '<td>'.$col1.'</td>';
	    print '<td>'.$col2.'</td>';
	    print '<td>'.$col3.'</td>';
	    print '<td>'.$col4.'</td>';
	    print '<td>'.$col5.'</td>';
	    print '</tr>';

	}   
	print '</table>';
	
	/* close statement */
    	$stmt->close();
?>