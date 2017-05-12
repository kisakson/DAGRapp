<?php
	include '../connect.php';

	$db = db_connect();
	$stmt = $db->prepare("SELECT * FROM `File` ORDER BY `Time_created` DESC");
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);

	print '<h2>View All Files</h2>';
	print '<table class="table table-bordered table-hover"><thead>';
	
	print '<tr>';
	print '<td style="text-align:center"> GUID </td>';	
	print '<td style="text-align:center"> Name </td>';
	print '<td style="text-align:center"> Creator </td>';
	print '<td style="text-align:center"> Date </td>';
	print '<td style="text-align:center"> Location </td>';
	print '<td style="text-align:center"> URL </td>';
	print '<td style="text-align:center"> File Size </td>';
	print '<td style="text-align:center"> File Extension </td>';
	print '<td style="text-align:center"> Parent GUID </td>';
	print '<td> Delete </td>';
	print '</tr></thead>';

	//fetch records
	while($stmt->fetch()) {
  	    print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';
	    print '<td style="text-align:center">'. htmlspecialchars($col2).'</td>'; // Escaping user provided fields
	    print '<td style="text-align:center">'. htmlspecialchars($col3).'</td>'; // to prevent XSS.
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '<td style="text-align:center">'.(($col5) ? ('Local') : ('Online')).'</td>';
			if ($col5 == 1) {
				print '<td style="text-align:center">' . $col6 . '</a></td>';
			} else {
				print '<td style="text-align:center"><a href="' . htmlspecialchars($col6) . '">' . $col6 . '</a></td>';
			}
	    print '<td style="text-align:center">' . 
	    	  ( ($col7 >= 1000000000) ? ($col7/1000000000 . ' GB') : (($col7 >= 1000000) ? ($col7/1000000 . ' MB') : (($col7 >= 1000) ? ($col7/1000 . ' KB') : ($col7 . ' B'))) ) .
	    	  '</td>';
	    print '<td style="text-align:center">'.$col8.'</td>';
	    print '<td style="text-align:center">'.(($col9) ? ($col9) : ('No parent')).'</td>';
			print '<td><button type="button" id=' . $col1 . ' onclick=filedelete("' . $col1 . '")>Delete</button></td>';
	    print '</tr>';

	}   
	print '</table><br>';
	print '<script src="/js/delete.js"></script>';
	
	/* close statement */
    	$stmt->close();
?>
