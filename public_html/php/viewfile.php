<?php
	include '../connect.php';

	$db = db_connect();
	$stmt = $db->prepare("SELECT * FROM `File`");
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);

	print '<h2>View All Files</h2>';
	print '<style> td { padding: 5px; } </style>';	// CSS STYLE OPTIONS
	print '<table border="5">';			// HTML5 TABLE OPTIONS
	
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
	print '</tr>';


	//fetch records
	while($stmt->fetch()) {
  	    print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';
	    print '<td style="text-align:center">'. htmlspecialchars($col2).'</td>'; // Escaping user provided fields
	    print '<td style="text-align:center">'. htmlspecialchars($col3).'</td>'; // to prevent XSS.
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '<td style="text-align:center">'.(($col5) ? ('Local') : ('Online')).'</td>';
			if ($col5 == 1) {
				print print '<td style="text-align:center">' . $col6 . '</a></td>';
			} else {
				print '<td style="text-align:center"><a href="' . htmlspecialchars($col6) . '">' . $col6 . '</a></td>';
			}
	    print '<td style="text-align:center">' . 
	    	  ( ($col7 >= 1000000000) ? ($col7/1000000000 . ' GB') : (($col7 >= 1000000) ? ($col7/1000000 . ' MB') : (($col7 >= 1000) ? ($col7/1000 . ' KB') : ($col7 . ' B'))) ) .
	    	  '</td>';
	    print '<td style="text-align:center">'.$col8.'</td>';
	    print '<td style="text-align:center">'.(($col9) ? ($col9) : ('No parent')).'</td>';
	    print '</tr>';

	}   
	print '</table><br>';
	
	/* close statement */
    	$stmt->close();
?>
