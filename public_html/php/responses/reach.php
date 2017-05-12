<?php		// TODO: Removing duplicates with 

include '../../connect.php';

function my_reach($r_name) {

    $db = db_connect();
    
    if ($r_name && !is_null($r_name)) {
	$name = $r_name;

	// echo '<p>'. $name .'</p?';
	
  	$stmt = $db->prepare('SELECT * FROM (SELECT d.* FROM `DAGR` d, ( SELECT `GUID`, `Parent_id` FROM `DAGR` WHERE `Name` LIKE ? ) tv
      WHERE d.`Parent_id` = tv.`GUID` or d.`GUID` = tv.`Parent_id` GROUP BY `GUID`) AS `d1`
      WHERE `d1`.`GUID` NOT IN ( SELECT `GUID` FROM `DAGR` WHERE `Name` LIKE ? ) ORDER BY `Name`');

	if ($stmt) {
		@$stmt->bind_param('ss', $name, $name)
		OR die('Error, could not reach any DAGRs at this time.<br>');
	} else {
		print '<p>Done!<p><br>';
		exit(0);
	}

	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	$reached = array();

	//fetch records
	while($stmt->fetch()) {
  	  print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';		// Additional Reachable DAGRs. . . 
	    print '<td style="text-align:center">'.$col2.'</td>';
	    $reached[] = $col2;						// <--- are stored here	    
	    print '<td style="text-align:center">'.$col3.'</td>';
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '<td style="text-align:center">'. (($col5) ? ($col5) : ('No Parent')).'</td>';
	    print '</tr>';
	    //my_reach($col2);
	}
	
	
    	foreach ($reached as $r) {
    		print '<p>'.$r.'</p><br>';
    		
    	}
    	
	//foreach ($reached as $r) {
    	//	my_reach($r);
    	//}
	
	$stmt->close();   
     } 
}


    $db = db_connect();
    
    if ($_GET['name']) {
	// $name = $_GET['name'];
	
	 $name = $_GET['name'];
    	//$name = (!is_null($r_name) ? $r_name : $_GET['name']);
    
	$st = $db->prepare('SELECT * FROM `DAGR` WHERE `Name` LIKE ? ORDER BY `Name`');
  	$stmt = $db->prepare('SELECT * FROM (SELECT d.* FROM `DAGR` d, ( SELECT `GUID`, `Parent_id` FROM `DAGR` WHERE `Name` LIKE ? ) tv
      WHERE d.`Parent_id` = tv.`GUID` or d.`GUID` = tv.`Parent_id` GROUP BY `GUID`) AS `d1`
      WHERE `d1`.`GUID` NOT IN ( SELECT `GUID` FROM `DAGR` WHERE `Name` LIKE ? ) ORDER BY `Name`');

	@$st->bind_param('s', $name)
	OR die('Error, could not find that DAGR at this time.<br>');
	
	@$stmt->bind_param('ss', $name, $name)
	OR die('Error, could not reach any DAGRs at this time.<br>');
	
	$st->execute();
	$st->bind_result($c1, $c2, $c3, $c4, $c5);
	
	print '<table class="table table-bordered table-hover"><thead>';
	print '<h4>Viewing all DAGRs reachable from the following: </h4>';
	print '<tr>';
	print '<td style="text-align:center"> GUID </td>';
	print '<td style="text-align:center"> Name </td>';
	print '<td style="text-align:center"> Creator </td>';
	print '<td style="text-align:center"> Date </td>';
  	print '<td style="text-align:center"> Parent ID </td>';
	print '</tr></thead>';
	
	// fetch records
	while($st->fetch()) {
  	  print '<tr>';
	    print '<td style="text-align:center">'.$c1.'</td>';
	    print '<td style="text-align:center">'.$c2.'</td>';
	    print '<td style="text-align:center">'.$c3.'</td>';
	    print '<td style="text-align:center">'.$c4.'</td>';
      print '<td style="text-align:center">'. (($c5) ? ($c5) : ('No Parent')).'</td>';
	    print '</tr>';
	}
	print '</table><br>';
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	print '<table class="table table-bordered table-hover"><thead>';
	print '<h4>Additional reachable DAGRs: </h4>';
	print '<tr>';
	print '<td style="text-align:center"> GUID </td>';
	print '<td style="text-align:center"> Name </td>';
	print '<td style="text-align:center"> Creator </td>';
	print '<td style="text-align:center"> Date </td>';
	print '<td style="text-align:center"> Parent ID </td>';
	print '</tr></thead>'; 

	$reached = array();

	//fetch records
	while($stmt->fetch()) {
  	  print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';		// Additional Reachable DAGRs. . . 
	    print '<td style="text-align:center">'.$col2.'</td>';
	    $reached[$col1] = $col2;							// <--- are stored here	    
	    print '<td style="text-align:center">'.$col3.'</td>';
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '<td style="text-align:center">'. (($col5) ? ($col5) : ('No Parent')).'</td>';
	    print '</tr>';
	    //my_reach($col2);
	}
	
	
	//my_reach($col2);
	
	foreach ($reached as $r) {
    		//my_reach($r);
    		print '<p>'.$r.'</p><br>';
    	}
    	
	foreach ($reached as $r) {
    		my_reach($r);

    	}
    	
    	
	print '</table><br>';
	$stmt->close();   
     
     } else {
    	echo '<script language="javascript">';
	echo 'alert("Please enter a name")';
	echo '</script>';
     }

?>

