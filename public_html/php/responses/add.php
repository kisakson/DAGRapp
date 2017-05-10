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
		$localoronline = -1;
		if ($_POST['localoronline'] == "local") { $localoronline = 1; } else { $localoronline = 0; }
		$creator = $_POST['creator'];
		$parent = $_POST['parent'];

		if ($localoronline == 0) { // online file
			$url = $_POST['url'];
			$pathvars = pathinfo($url);

			// check if already uploaded
			$stmtgetguid = $db->prepare("SELECT `GUID` FROM `File` WHERE `URL` = ?");
			@$stmtgetguid->bind_param('s', $url)
			OR die('Could not connect. .. . .. .');
			$stmtgetguid->execute();
			$stmtgetguid->bind_result($col1);
			while($stmtgetguid->fetch()) {
				exit("File is already uploaded in the database.<br>");
			}
			$stmtgetguid->close();

			// if html file, go through html parsing
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
		} else { // local file
			$numfile = 1;
			$filestoolarge = 0;
			$stmt = $db->prepare("INSERT INTO `File` (`Name`, `Creator`, `Local_or_online`, `URL`, `Size`, `File_type`, `Parent_id`)
					VALUES (?, ?, ?, ?, ?, ?, ?);");
			@$stmt->bind_param('ssisiss', $name, $creator, $localoronline, $url, $size, $type, $parent)
				OR die('Could not connect. .. . .. .');

			while ($numfile <= sizeof($_FILES["upload"]["name"])) {
				$name = "";
				if (empty($_POST['name'])) {
					$name = $_FILES["upload"]["name"][$numfile - 1];
				} else if (sizeof($_FILES["upload"]["name"]) == 1) {
					$name = $_POST['name'];
				} else $name = $_POST['name'] . " (" . $numfile . ")";

				$url = $_FILES["upload"]["name"][$numfile - 1];
				$pathvars = pathinfo($url);
				$type = $pathvars['extension'];
				$size = $_FILES["upload"]["size"][$numfile - 1];

				if ($size == 0) {
					$filestoolarge = $filestoolarge + 1;
					echo $url . " was not successfully uploaded.<br>";
				} else {
					$uploadOk = 1;
					if(isset($_POST["submit"])) {
						// idk
					}
					$stmt->execute();
					echo $url . " successfully uploaded as " . $name . ".<br>";
				}

				$numfile = $numfile + 1;
			}

			$successes = $numfile - $filestoolarge - 1;
			if ($successes == 1) {
				echo "<br>1 file was successfully uploaded.<br>";
			} else {
				echo "<br>" . $successes . " files were successfully uploaded.<br>";
			}
			if ($filestoolarge != 0) {
				if ($filestoolarge == 1) {
					echo "1 file upload was unsuccessful (fize size too large).<br>";
				} else {
					echo $filestoolarge . " file uploads were unsuccessful (fize size too large).<br>";
				}
			}

			$stmt->close();

		}

  }
?>
