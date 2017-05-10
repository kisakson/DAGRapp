<?php
	include '../connect.php';

	$db = db_connect();
	$stmt = $db->prepare("SELECT `NEWTABLE`.`Parent_id`, `NEWTABLE`.`Name`, `f2`.`Name`, `NEWTABLE`.`Child_id` 
      FROM (SELECT `f1`.`Parent_id` AS `Parent_id`,`Name`,`Child_id` FROM `File` AS `f1` INNER JOIN `File_contains` ON `f1`.`GUID` = `File_contains`.`Parent_id`) 
      AS `NEWTABLE` INNER JOIN `File` AS `f2` ON `NEWTABLE`.`Child_id` = `f2`.`GUID` ORDER BY `NEWTABLE`.`Name`");
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4);

	print '<h2>View All File-Containing Relationships</h2>';
  print '<p>This page allows you to view all parent-child relationships between files.<br>Whenever an HTML file is imported into
   the database, its child image files are also imported automatically and a parent-child relationship is stored.</p>';
	print '<table class="table table-bordered table-hover"><thead>';
	
	print '<tr>';
	print '<td style="text-align:center"> Parent GUID </td>';	
	print '<td style="text-align:center"> Parent Name </td>';
	print '<td style="text-align:center"> Child Name </td>';
	print '<td style="text-align:center"> Child GUID </td>';
	print '</tr></thead>';

	while($stmt->fetch()) {
  	  print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';
	    print '<td style="text-align:center">'.$col2.'</td>';
	    print '<td style="text-align:center">'.$col3.'</td>';
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '</tr>';
	}   
	print '</table><br>';
	
    	$stmt->close();
?>
