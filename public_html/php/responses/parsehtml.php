<?php
  include '../../connect.php';

	$db = db_connect();
  $name = $_POST['name'];
  $creator = $_POST['creator'];
  $url = $_POST['url'];
  $parent = $_POST['parent'];

  // See if HTML file exists in DB. If so, don't insert and exit php execution
  $stmtgetguid = $db->prepare("SELECT `GUID` FROM `File` WHERE `URL` = ?");
	@$stmtgetguid->bind_param('s', $url)
	OR die('Could not connect. .. . .. .');
	$stmtgetguid->execute();
	$stmtgetguid->bind_result($col1);
  while($stmtgetguid->fetch()) {
    exit("HTML file is already uploaded in the database.");
  }

  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTMLFile($url);
  $regex = '%^(?:[a-z]+:)?//%';

  if ($name == "") {
    $name = $dom->getElementsByTagName('title')->item(0)->textContent; // Name is Title of doc
  }

  $file = $dom->saveHTML();
  $size = strlen($file);
  // TODO: file size is always slightly smaller than what http://smallseotools.com/website-page-size-checker/ says
  // look into this later..

  $stmtfile = $db->prepare("INSERT INTO `File` (`Name`, `Creator`, `Local_or_online`, `URL`, `Size`, `File_type`, `Parent_id`)
         VALUES (?, ?, 0, ?, ?, 'html', ?);");
      
  @$stmtfile->bind_param('sssis', $name, $creator, $url, $size, $parent)
	OR die('Could not connect. .. . .. .');
  // Insert base HTML file
  if ($stmtfile->execute()) {
    echo "HTML file insertion successful!<br>";
  } else {
    echo "HTML file insertion was not successful.<br>";
    exit(1);
  }

  $stmtfile->close();

  // Get GUID of new HTML file
	$stmtgetguid->execute();
	$stmtgetguid->bind_result($col1);
  while($stmtgetguid->fetch()) {
    $pguid = $col1;
  }

  // Insert images within HTML file

  $stmtimg = $db->prepare("INSERT INTO `File` (`Name`, `Creator`, `Local_or_online`, `URL`, `Size`, `File_type`, `Parent_id`)
         VALUES (?, ?, 0, ?, ?, 'img', ?);");
  $stmtf2f = $db->prepare("INSERT INTO `File_contains` (`Parent_id`, `Child_id`) VALUES (?, ?);");
      
  @$stmtgetguid->bind_param('s', $imgurl)
	OR die('Could not connect. .. . .. .');
  @$stmtimg->bind_param('sssis', $title, $creator, $imgurl, $size, $parent)
	OR die('Could not connect. .. . .. .');
  @$stmtf2f->bind_param('ss', $pguid, $cguid)
	OR die('Could not connect. .. . .. .');

  // For each img tag, insert the image (if necessary) and insert the file-to-file connection
  foreach ($dom->getElementsByTagName('img') as $img) {
    if ($img->hasAttribute('src')) {
      $imgurl = $img->getAttribute('src');
      $title = $imgurl;
      // If url is not absolute, add the website url to the beginning
      // Ex: if url is image.jpg, new url is the form of http://www.websitename.com/image.jpg
      if (preg_match($regex, $imgurl) == 0) {
        $imgurl = $url . $imgurl;
      }

      // See if img already exists in db
      $cguid = "";
      $stmtgetguid->execute();
      $stmtgetguid->bind_result($col1);
      while($stmtgetguid->fetch()) {
        $cguid = $col1;
      }
      if ($cguid != "") {
        // If here, image is already present in db
        // Since we didn't exit when trying to insert the html doc above (it didn't exist before),
        // we just need to insert the parent-child connection.
      } else { // $cguid == ""
        // Insert image
        $dims = getimagesize($imgurl);
        $size = $dims[0] * $dims[1] * 4;
        $stmtimg->execute(); // Insert image
        $stmtgetguid->execute(); // Get its GUID
	      $stmtgetguid->bind_result($col1);
        while($stmtgetguid->fetch()) {
          $cguid = $col1;
        }
        echo "Image " . $title . " also inserted.<br>";
      }

      // Insert parent-child connection
      $stmtf2f->execute();
    }
  }

  $stmtgetguid->close();
  $stmtimg->close();
  $stmtf2f->close();

?>
