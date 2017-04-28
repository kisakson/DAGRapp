<?php
	include 'connect.php';

	$db = db_connect();
	$stmt = $db->prepare("SELECT * FROM `FILE`");
	
	//@$stmt->bind_param('s', $name)
	//OR die('Could not connect. .. . .. .');
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8);
  // TODO add rest of columns lol

	print '<table border="5">';
	print '<tr>';
	print '<td> GUID </td>';
	print '<td> Name </td>';
	print '<td> Creator </td>';
	print '<td> Time_created </td>';
	print '<td> Parent_id </td>';
	print '</tr>';
  // TODO update this table

	//fetch records
	while($stmt->fetch()) {
  	    print '<tr>';
	    print '<td>'.$col1.'</td>';
	    print '<td>'.$col2.'</td>';
	    print '<td>'.$col3.'</td>';
	    print '<td>'.$col4.'</td>';
	    print '<td>'.$col5.'</td>';
	    print '</tr>';
      // TODO update this printout

	}   
	print '</table>';
	
	/* close statement */
    	$stmt->close();
?>
