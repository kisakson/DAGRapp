<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="dagr-search-form"> <!-- TODO check this action line -->
	DAGR Name: <input type="text" name="name"><br> <!-- TODO still in progress.. just creating the form structure -->
  Creator Name: <input type="text" name="creator"><br>
  Contains Category: <input type="text" name="category"></br>
	<input type="submit" name="submit" value="Submit" id='dagr-search-button'/>
</form>

<script src="/js/body.js"></script>

<div id='results'>
</div>

<?php
	include '../connect.php';

	$db = db_connect();
	$name = $_GET['name'];
	$creator = $_GET['creator'];
	$cat = $_GET['cat'];
	$stmt = $db->prepare("SELECT * FROM `DAGR` WHERE `Name` LIKE ? AND 'Creator' LIKE ?");
	
	@$stmt->bind_param('ss', $name, $creator)
	OR die('Could not connect. .. . .. .');
	
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);

	$output = '<table border="5"><tr><td>Guid</td><td>Name</td><td>Creator</td><td>Time_created</td><td>Parent_id</td></tr>';
	while($stmt->fetch()) {
		$output = $output . '<tr><td>'.$col1.'</td><td>'.$col2.'</td><td>'.$col3.'</td><td>'.$col4.'</td><td>'.$col5.'</td></tr>';
	}
	$output = $output . '</table>';
	console.log($output);

	/*print '<table border="5">';
	print '<tr>';
	print '<td> GUID </td>';
	print '<td> Name </td>';
	print '<td> Creator </td>';
	print '<td> Time_created </td>';
	print '<td> Parent_id </td>';
	print '</tr>';

	//fetch records
	while($stmt->fetch()) {
  	  print '<tr>';
	    print '<td>'.$col1.'</td>';
	    print '<td>'.$col2.'</td>';
	    print '<td>'.$col3.'</td>';
	    print '<td>'.$col4.'</td>';
	    print '<td>'.$col5.'</td>';
	    print '</tr>';

	}   
	print '</table>';*/
	
	/* close statement */
  $stmt->close();
?>
