<?php
	include '../../connect.php';
	$db = db_connect();
	
	/****************************************
	 ^				                            	*
	 *	          TIME RANGE REPORT	      	*
	 *					                            *
	 ****************************************/
	$start_date 	= '2017-' . $_GET['start_dropdown'] . '-' . $_GET['start_2_dropdown'] ;
	$start_time 	= $_GET['start_3_dropdown'];
	$end_date 	= '2017-' .$_GET['end_dropdown'] . '-' . $_GET['end_2_dropdown'] ;
	$end_time	= $_GET['end_3_dropdown'];
	
	$start 		= $start_date . ' ' . $start_time;
	$end 		= $end_date . ' ' . $end_time;
		
	$stmt = $db->prepare('SELECT * FROM `DAGR` WHERE `Time_created` BETWEEN ? AND ? ORDER BY `Name`');
	@$stmt->bind_param('ss', $start, $end)
	OR die('Error, could not reach any DAGRs at this time.<br>');
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

  print '<h4>DAGRs created between the times above:</h4>';
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
	print '</table>';
	
    	$stmt->close();

?>

