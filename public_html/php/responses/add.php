<?php
	include '../../connect.php';

	$db = db_connect();
  $object = $_POST['object'];

  if ($object === 'dagr') {

	  $name = $_POST['name'];
	  $creator = $_POST['creator'];
    $parent = $_POST['parent'];
    if ($parent != "none") {
      $stmt = $db->prepare("INSERT INTO `DAGR` (`Name`, `Creator`, `Parent_id`) VALUES (?, ?, ?);");
      
      @$stmt->bind_param('sss', $name, $creator, $parent)
	    OR die('Could not connect. .. . .. .');
	
    } else {
      $stmt = $db->prepare("INSERT INTO `DAGR` (`Name`, `Creator`) VALUES (?, ?);");
      
      @$stmt->bind_param('ss', $name, $creator)
	    OR die('Could not connect. .. . .. .');
    }

    if ($stmt->execute()) {
      echo "<p>Insert successful!</p>";
    } else {
      echo "<p>Insert was not successful.</p>";
    }

    $stmt->close();
  
  } else if ($object === 'file') {
		$url = $_POST['url'];
		$pathvars = pathinfo($url);

		$stmtgetguid = $db->prepare("SELECT `GUID` FROM `File` WHERE `URL` = ?");
		@$stmtgetguid->bind_param('s', $url)
		OR die('Could not connect. .. . .. .');
		$stmtgetguid->execute();
		$stmtgetguid->bind_result($col1);
  	while($stmtgetguid->fetch()) {
  	  exit("File is already uploaded in the database.<br>");
  	}

		$stmtgetguid->close();

		$creator = $_POST['creator'];
		$parent = $_POST['parent'];

		if ($pathvars['extension'] == "html" || $pathvars['extension'] == "com" || $pathvars['extension'] == "net" || $pathvars['extension'] == "org") {
			if (empty($_POST['name'])) {
				$name = "";
			} else $name = $_POST['name'];

			$post = [
    		'name' => $name, 'creator' => $creator, 'url' => $url, 'parent' => $parent
			];

			$ch = curl_init('http://www.bagelcron.com/php/responses/parsehtml.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

			$response = curl_exec($ch);
			curl_close($ch);
			print_r($response);

			exit(0);
		}

		$name = "";
		if (empty($_POST['name'])) {
			$name = $pathvars['basename'];
		} else $name = $_POST['name'];
		$localoronline = -1;
		if ($$_POST['localonline'] == "Local") { $localoronline = 1; } else { $localoronline = 0; }
		$type = $pathvars['extension'];

		$dom = new DOMDocument();
  	libxml_use_internal_errors(true);
  	$dom->loadHTMLFile($url);
  	$size = strlen($dom->saveHTML());

		$stmt = $db->prepare("INSERT INTO `File` (`Name`, `Creator`, `Local_or_online`, `URL`, `Size`, `File_type`, `Parent_id`)
         VALUES (?, ?, ?, ?, ?, ?, ?);");
		@$stmt->bind_param('ssisiss', $name, $creator, $localoronline, $url, $size, $type, $parent)
	  	OR die('Could not connect. .. . .. .');

    $stmt->execute();

		echo "Insertion was successful!<br>";

    $stmt->close();
  }
?>
