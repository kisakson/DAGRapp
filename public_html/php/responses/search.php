<?php
	include '../../connect.php';

	$db = db_connect();
  $object = $_GET['object'];

  if ($object === 'dagr') {

	  $name = '%' . $_GET['name'] . '%';
	  $creator = '%' . $_GET['creator'] . '%';
	  $cat = $_GET['category'];
	  $stmt = $db->prepare("SELECT * FROM `DAGR` WHERE `Name` LIKE ? AND `Creator` LIKE ?");
	
	  @$stmt->bind_param('ss', $name, $creator)
	  OR die('Could not connect. .. . .. .');
	
	  $stmt->execute();
	  $stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	  $output = '<table border="5"><tr><td>Guid</td><td>Name</td><td>Creator</td><td>Time_created</td><td>Parent_id</td>'
			. '<td>Modify</td><td>Delete</td></tr>';
	  while($stmt->fetch()) {
		  $output = $output . '<tr><td>' . $col1 . '</td><td>' . htmlspecialchars($col2) . '</td><td>' . htmlspecialchars($col3)
				. '</td><td>' . $col4 . '</td><td>' . (($col5) ? ($col5) : ('No parent')) . '</td>'
				. '<td><button type="button">Modify</button></td><td><button type="button">Delete</button></td>' . '</tr>';
	  }
	  $output = $output . '</table>';
	  echo $output;
    $stmt->close();
  
  } else if ($object === 'file') {
    $name = $_GET['name'];
	  $creator = $_GET['creator'];
	  //$cat = $_GET['cat'];
    // add more possible values above
	  $stmt = $db->prepare("SELECT * FROM `File` WHERE `Name` LIKE ? AND 'Creator' LIKE ?");
	
    $stmt->execute();
	  $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);

    $output = '<table border="5"><tr><td>Guid</td><td>Name</td><td>Creator</td><td>Time_created</td>'
      . '<td>Location</td><td>URL</td><td>File Size</td><td>File Extension</td><td>Parent_id</td></tr>';

	  while($stmt->fetch()) {
      $output = $output . '<tr><td>' . $col1 . '</td><td>' . htmlspecialchars($col2) . '</td><td>' . htmlspecialchars($col3)
          . '</td><td>' . $col4 . '</td><td>' . (($col5) ? ('Local') : ('Online')) . '</td><td><a href="'
          . htmlspecialchars($col6) . '">' . $col6 . '</td><td>'
          . ( ($col7 >= 1000000000) ? ($col7/1000000000 . ' GB') : (($col7 >= 1000000) ? ($col7/1000000 . ' MB') : (($col7 >= 1000) ? ($col7/1000 . ' KB') : ($col7 . ' B'))) )
          . '</td><td>' . $col8 . '</td><td>' . (($col9) ? ($col9) : ('No parent')) . '</td></tr>';
  	  /*print '<tr>';
	    print '<td style="text-align:center">'.$col1.'</td>';
	    print '<td style="text-align:center">'. htmlspecialchars($col2).'</td>'; // Escaping user provided fields
	    print '<td style="text-align:center">'. htmlspecialchars($col3).'</td>'; // to prevent XSS.
	    print '<td style="text-align:center">'.$col4.'</td>';
	    print '<td style="text-align:center">'.(($col5) ? ('Local') : ('Online')).'</td>';
	    print '<td style="text-align:center"><a href="' . htmlspecialchars($col6) . '">' . $col6 . '</a></td>';
	    print '<td style="text-align:center">' . 
	    	  ( ($col7 >= 1000000000) ? ($col7/1000000000 . ' GB') : (($col7 >= 1000000) ? ($col7/1000000 . ' MB') : (($col7 >= 1000) ? ($col7/1000 . ' KB') : ($col7 . ' B'))) ) .
	    	  '</td>';
	    print '<td style="text-align:center">'.$col8.'</td>';
	    print '<td style="text-align:center">'.(($col9) ? ($col9) : ('No parent')).'</td>';
	    print '</tr>';*/

	  }   
	  echo $output;
    $stmt->close();
  }

	/* close statement */
  //$stmt->close();
?>
