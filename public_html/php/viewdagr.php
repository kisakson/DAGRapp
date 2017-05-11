<?php
	include '../connect.php';

	$db = db_connect();
	$stmt = $db->prepare("SELECT * FROM `DAGR` ORDER BY `Time_created` DESC");

	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	print '<h2>View All DAGRs</h2>';
	print '<table class="table table-bordered table-hover"><thead>';
	print '<tr>';
	print '<td> GUID </td>';
	print '<td> Name </td>';
	print '<td> Creator </td>';
	print '<td> Time_created </td>';
	print '<td> Parent_id </td>';
	print '</tr></thead>';

	//fetch records
	while($stmt->fetch()) {
  	    print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';
	    print '<td style="text-align:center">'. htmlspecialchars($col2).'</td>'; // Escaping user provided fields
	    print '<td style="text-align:center">'. htmlspecialchars($col3).'</td>'; // to prevent potential XSS attacks.
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '<td style="text-align:center">'.(($col5) ? ($col5) : ('No Parent')).'</td>';
	    print '</tr>';
	}  
	print '</table>';
	
	/* close statement */
    	$stmt->close();
?>
