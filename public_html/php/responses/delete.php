<?php
	include '../../connect.php';

	$db = db_connect();
  $object = $_POST['object'];

  if ($object === 'dagr') {
    $guid = $_POST['guid'];
	  $stmt = $db->prepare("DELETE FROM `DAGR` WHERE `GUID` = ?");
	
	  @$stmt->bind_param('s', $guid)
	  OR die('Could not connect. .. . .. .');
	
	  $stmt->execute();

    if (mysqli_stmt_affected_rows($stmt) > 0) {
      echo "Success";
    } else {
      echo "Error";
    }
	  
    $stmt->close();
  
  } else if ($object === 'file') {
    $guid = $_POST['guid'];
	  $stmt = $db->prepare("DELETE FROM `File` WHERE `GUID` = ?");
	
	  @$stmt->bind_param('s', $guid)
	  OR die('Could not connect. .. . .. .');
	
	  $stmt->execute();

    if (mysql_affected_rows() > 0) {
      echo "Success";
    } else {
      echo "Error";
    }

    $stmt->close();
  }

?>
