<?php		// TODO: Removing duplicates ($reached[] --> global?)

include '../../connect.php';

$hasreached = array();

function my_reach($r_guid, $hasreached) {

  $db = db_connect();
    
  if ($r_guid && !is_null($r_guid)) {
	  $guid = $r_guid;

    array_push($hasreached, $guid);

	// echo '<p>'. $name .'</p?';
	
  	//$stmt = $db->prepare('SELECT * FROM (SELECT d.* FROM `DAGR` d, ( SELECT `GUID`, `Parent_id` FROM `DAGR` WHERE `GUID` = ? ) tv
    //  WHERE d.`Parent_id` = tv.`GUID` or d.`GUID` = tv.`Parent_id` GROUP BY `GUID`) AS `d1`
    //  WHERE `d1`.`GUID` NOT IN ( SELECT `GUID` FROM `DAGR` WHERE `GUID` = ? ) ORDER BY `Name`');
    $stmt = $db->prepare('SELECT * FROM `DAGR` WHERE `Parent_id` = ?');

	  if ($stmt) {
		  //@$stmt->bind_param('ss', $guid, $guid)
      @$stmt->bind_param('s', $guid)
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
      if (!in_array($col1, $hasreached)) {
  	    print '<tr>';
	      print '<td style="text-align:center">'.$col1.'</td>';		// Additional Reachable DAGRs. . . 
        $reached[] = $col1;						// <--- are stored here	    
	      print '<td style="text-align:center">'.$col2.'</td>';
	      print '<td style="text-align:center">'.$col3.'</td>';
	      print '<td style="text-align:center">'.$col4.'</td>';
	      print '<td style="text-align:center">'. (($col5) ? ($col5) : ('No Parent')).'</td>';
	      print '</tr>';
	    //my_reach($col2);
      }
  	}
	
    foreach ($reached as $r) {
    	print '<p>'.$r.'</p><br>';
    }
    	
	//foreach ($reached as $r) {
    	//	my_reach($r);
    	//}
	
	  $stmt->close();  
	//unset($reached); 
  } 
}

function getparent($r_guid) {
  $db = db_connect();
    
  if ($r_guid && !is_null($r_guid)) {
	  $guid = $r_guid;

    $stmt = $db->prepare('SELECT * FROM `DAGR` WHERE `GUID` = ?');
	  if ($stmt) {
		  @$stmt->bind_param('s', $guid)
		  OR die('Error, could not reach any DAGRs at this time.<br>');
	  } else {
		  print '<p>Done!<p><br>';
		  exit(0);
	  }
    $repeat = 1;

    while($repeat == 1) {
	    $stmt->execute();
	    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    
      while($stmt->fetch()) {
        if ($col5) {
          $guid = $col5;
        } else {
          $repeat = 0;
        }
      }
    }

	  $stmt->close();

    echo "True king is " . $guid . "<br><br>";

    return $guid;

  }
}


$db = db_connect();
    
if ($_GET['guid']) {
	// $name = $_GET['name'];
	$guid = $_GET['guid'];
  $startguid = $guid;
    	//$name = (!is_null($r_name) ? $r_name : $_GET['name']);

  array_push($hasreached, $guid);
    
	$st = $db->prepare('SELECT * FROM `DAGR` WHERE `GUID` = ?');
  //$stmt = $db->prepare('SELECT * FROM (SELECT d.* FROM `DAGR` d, ( SELECT `GUID`, `Parent_id` FROM `DAGR` WHERE `GUID` = ? ) tv
  //    WHERE d.`Parent_id` = tv.`GUID` or d.`GUID` = tv.`Parent_id` GROUP BY `GUID`) AS `d1`
  //    WHERE `d1`.`GUID` NOT IN ( SELECT `GUID` FROM `DAGR` WHERE `GUID` = ? ) ORDER BY `Name`');
  $stmt = $db->prepare('SELECT * FROM `DAGR` WHERE `Parent_id` = ?');

	@$st->bind_param('s', $guid)
	OR die('Error, could not find that DAGR at this time.<br>');
	
	//@$stmt->bind_param('ss', $guid, $guid)
  @$stmt->bind_param('s', $guid)
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

  $guid = getparent($guid);
	
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
    if ($col1 != $startguid) {
  	  print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';		// Additional Reachable DAGRs. . . 	    
	    print '<td style="text-align:center">'.$col2.'</td>';
	    print '<td style="text-align:center">'.$col3.'</td>';
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '<td style="text-align:center">'. (($col5) ? ($col5) : ('No Parent')).'</td>';
	    print '</tr>';
	    //my_reach($col2);
    }
    $reached[] = $col1;							// <--- are stored here
	}
	
	
	//my_reach($col2);
	
	foreach ($reached as $r) {
    //my_reach($r);
    //print '<p>'.$r.'</p><br>';
  }
    	
	foreach ($reached as $r) {
    if (!in_array($r, $hasreached)) {
    	my_reach($r, $hasreached);
      print '<p>'.$r.'</p><br>';
    }
  }
    	
    	
	print '</table><br>';
	$stmt->close();   
     
} else {
  echo '<script language="javascript">';
	echo 'alert("Please select a DAGR")';
	echo '</script>';
}

?>

