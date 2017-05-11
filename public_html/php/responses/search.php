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

	  $output = 'Results:<br><table class="table table-bordered table-hover"><thead><tr><td>Guid</td><td>Name</td><td>Creator</td>'
			. '<td>Time_created</td><td>Parent_id</td><td>Modify</td><td>Delete</td></tr></thead>';
		$numrow = 1;
	  while($stmt->fetch()) {
		  $output = $output . '<tr><td>' . $col1 . '</td><td>' . htmlspecialchars($col2) . '</td><td>'
				. htmlspecialchars($col3) . '</td><td>' . $col4 . '</td><td>' . (($col5) ? ($col5) : ('No parent')) . '</td>'
				. '<td><button type="button" id=row-' . $numrow . '>Modify</button></td><td>'
				. '<button type="button" id=' . $col1 . ' onclick=dagrdelete("' . $col1 . '")>Delete</button></td>' . '</tr>';
				$numrow = $numrow + 1;
	  }
	  $output = $output . '</table>';
	  echo $output;
		echo '<script src="/js/modify.js"></script>';
		echo '<script src="/js/delete.js"></script>';
    $stmt->close();
  
  } else if ($object === 'file') {
    $name = '%' . $_GET['name'] . '%';
	  $creator = '%' . $_GET['creator'] . '%';
		$localonline = $_GET['localonline'];
		$url = '%' . $_GET['url'] . '%';
		$type = '%' . $_GET['type'] . '%';
		$stmt = null;
		if ($localonline !== "Local" && $localonline !== "Online") {
			$stmt = $db->prepare("SELECT * FROM `File` WHERE `Name` LIKE ? AND `Creator` LIKE ?
					 AND `URL` LIKE ? AND `File_type` LIKE ?");
			@$stmt->bind_param('ssss', $name, $creator, $url, $type)
	  	OR die('Could not connect. .. . .. .');
		} else {
			if ($localonline == "Local") {
				$localonline = 1;
			} else $localonline = 0;
			$stmt = $db->prepare("SELECT * FROM `File` WHERE `Name` LIKE ? AND `Creator` LIKE ? AND `Local_or_online` = ?
					 AND `URL` LIKE ? AND `File_type` LIKE ?");
			@$stmt->bind_param('ssiss', $name, $creator, $localonline, $url, $type)
	  	OR die('Could not connect. .. . .. .');
		}

    $stmt->execute();
	  $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
		

    $output = 'Results:<br><table class="table table-bordered table-hover"><thead><tr><td>Guid</td><td>Name</td><td>Creator</td><td>Time_created</td>'
      . '<td>Location</td><td>URL</td><td>File Size</td><td>File Extension</td><td>Parent_id</td>'
			. '<td>Modify</td><td>Delete</td></tr></thead>';

	  while($stmt->fetch()) {
      $output = $output . '<tr><td>' . $col1 . '</td><td>' . htmlspecialchars($col2) . '</td><td>' . htmlspecialchars($col3)
          . '</td><td>' . $col4 . '</td><td>' . (($col5) ? ('Local') : ('Online')) . '</td>';
			if ($col5 == 1) {
				$output = $output . '<td>' . $col6 . '</td>';
			} else {
				$output = $output . '<td><a href="' . htmlspecialchars($col6) . '">' . $col6 . '</td>';
			}
			$output = $output . '<td>' . ( ($col7 >= 1000000000) ? ($col7/1000000000 . ' GB') : (($col7 >= 1000000) ? ($col7/1000000 . ' MB') : (($col7 >= 1000) ? ($col7/1000 . ' KB') : ($col7 . ' B'))) )
          . '</td><td>' . $col8 . '</td><td>' . (($col9) ? ($col9) : ('No parent')) . '</td>'
					. '<td><button type="button" id=row-' . $numrow . '>Modify</button></td>'
					. '<td><button type="button" id=' . $col1 . ' onclick=filedelete("' . $col1 . '")>Delete</button></td></tr>';
	  }   
	  echo $output;
		echo '<script src="/js/modify.js"></script>';
		echo '<script src="/js/delete.js"></script>';
    $stmt->close();
  }
?>
