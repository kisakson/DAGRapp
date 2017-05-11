<?php
	include '../connect.php';
	$db = db_connect();
	
	/****************************************
	 *																			*
	 *	   			  ORPHAN REPORT							*
	 *																			*
	 ****************************************/
	 
 	echo '<h2>Orphan Report</h2>';
	echo '<p>This report lists all DAGRs with no parent DAGRs.</p>';
 	
	$stmt = $db->prepare("SELECT * FROM `DAGR` WHERE `Parent_id` IS NULL ORDER BY `Name`");
	($stmt) ? ($stmt->execute()) : ('Error, could not create orphan report at this time.<br>');
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);
	
	print '<style> td { padding: 5px; } </style>';	// CSS STYLE OPTIONS
	print '<table class="table table-bordered table-hover"><thead>';			// HTML5 TABLE OPTIONS
	
	print '<tr>';
	print '<td style="text-align:center"> GUID </td>';
	print '<td style="text-align:center"> Name </td>';
	print '<td style="text-align:center"> Creator </td>';
	print '<td style="text-align:center"> Date </td>';
	print '<td style="text-align:center"> Parent ID </td>';
	print '</tr></thead>';
	
	//fetch records
	while($stmt->fetch()) {
  	  print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';
	    print '<td style="text-align:center">'.$col2.'</td>';
	    print '<td style="text-align:center">'.$col3.'</td>';
	    print '<td style="text-align:center">'.$col4.'</td>';
			print '<td style="text-align:center">'. (($col5) ? ($col5) : ('No Parent')).'</td>';
	    print '</tr>';
	}   
	print '</table><br>';
	
	/****************************************
	 ^																			*
	 *	    		 STERILE REPORT							*
	 *																			*
	 ****************************************/
	 
	echo '<h2>Sterile Report</h2>'; 
	echo '<p>This report lists all DAGRs with no child DAGRs.</p>';
	 
	$stmt = $db->prepare('SELECT * FROM `DAGR` WHERE `GUID` NOT IN (SELECT `Parent_id` FROM `DAGR` WHERE `Parent_id` IS NOT NULL GROUP BY `Parent_id`) ORDER BY `Name`');
	($stmt) ? ($stmt->execute()) : ('Error, could not create sterile report at this time.<br>');
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	print '<table class="table table-bordered table-hover"><thead>';
	print '<tr>';
	print '<td style="text-align:center"> GUID </td>';
	print '<td style="text-align:center"> Name </td>';
	print '<td style="text-align:center"> Creator </td>';
	print '<td style="text-align:center"> Date </td>';
	print '<td style="text-align:center"> Parent ID </td>';
	print '</tr></thead>';
	//fetch records
	while($stmt->fetch()) {
  print '<tr>';
	print '<td style="text-align:center">'.$col1.'</td>';
	print '<td style="text-align:center">'.$col2.'</td>';
	print '<td style="text-align:center">'.$col3.'</td>';
	print '<td style="text-align:center">'.$col4.'</td>';
	print '<td style="text-align:center">'. (($col5) ? ($col5) : ('No Parent')).'</td>';
	print '</tr>';
	}   
	print '</table><br>';
	
  $stmt->close();


	/****************************************
	 ^																			*
	 *	    		  		BOTH									*
	 *																			*
	 ****************************************/
	 
	echo '<h2>Orphan and Sterile Report</h2>'; 
	echo '<p>This report lists all DAGRs with no parent DAGR and no child DAGRs.</p>';
	 
	$stmt = $db->prepare('SELECT * FROM (SELECT `t1`.`GUID`, `t1`.`Name`, `t1`.`Creator`, `t1`.`Time_created`, `t1`.`Parent_id` FROM
			(SELECT * FROM `DAGR` WHERE `GUID` NOT IN (SELECT `Parent_id` FROM `DAGR` WHERE `Parent_id` IS NOT NULL GROUP BY `Parent_id`)) AS `t1`
			INNER JOIN (SELECT * FROM `DAGR` WHERE `GUID` NOT IN (SELECT `Parent_id` FROM `DAGR` WHERE `Parent_id` IS NOT NULL GROUP BY `Parent_id`)) AS `t2`
			ON `t1`.`GUID` = `t2`.`GUID`) AS `t3` WHERE `Parent_id` IS NULL ORDER BY `Name`');
	($stmt) ? ($stmt->execute()) : ('Error, could not create report at this time.<br>');
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	print '<table class="table table-bordered table-hover"><thead>';
	print '<tr>';
	print '<td style="text-align:center"> GUID </td>';
	print '<td style="text-align:center"> Name </td>';
	print '<td style="text-align:center"> Creator </td>';
	print '<td style="text-align:center"> Date </td>';
	print '<td style="text-align:center"> Parent ID </td>';
	print '</tr></thead>';
	//fetch records
	while($stmt->fetch()) {
  print '<tr>';
	print '<td style="text-align:center">'.$col1.'</td>';
	print '<td style="text-align:center">'.$col2.'</td>';
	print '<td style="text-align:center">'.$col3.'</td>';
	print '<td style="text-align:center">'.$col4.'</td>';
	print '<td style="text-align:center">'. (($col5) ? ($col5) : ('No Parent')).'</td>';
	print '</tr>';
	}   
	print '</table><br>';
	
    	$stmt->close();
?>
