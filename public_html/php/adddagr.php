<table border="0">
  <tbody>
    <tr>
      <td>
        <h2>Add a DAGR</h2>
        <p>This page adds a new DAGR, a standalone folder. This DAGR can be created alone or within another existing DAGR.</p>
        <p>To save a file in the database, select the option above to add a new file.</p>
        
        <!-- A user may create a DAGR with the components of the web page, or add these components to an open -->
        <form method="post" action="#"> <!-- TODO check this action line -->
        <!-- or this: <form method="post" action="<php echo htmlspecialchars($_SERVER["PHP_SELF"]);>"> -->
	        DAGR Name: <input type="text" name="name"><br> <!-- TODO still in progress.. just creating the form structure -->
          Creator Name: <input type="text" name="creator"><br>
          DAGR Parent: <select name="parent"> <!-- TODO check these name values, see that the post function actually works -->
            <option value="null">None</option>
            <?php
              $db = db_connect();
	            $stmt = $db->prepare("SELECT * FROM `DAGR` ORDER BY 'Name'");
          	  $stmt->execute();
	            $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
              while($stmt->fetch()) {
                echo '<option value="', $col1, '">', $col2, ' - id: ', $col1, '</option>';
              }
            ?>
          </select>
		      <input type="submit" name="submit" value="Submit" />
        </form>

        <?php
		      if(isset($_POST['submit'])){
            // ADD TO THE DB!!
            $db = db_connect();
	          $name = $_POST['name']; // I'm just guessing for these lines
            $creator = $_POST['creator'];
            if ($_POST['parent'] != "null") { $parent = $_POST['parent']; } else { $parent = null; }

	          $stmt = $db->prepare("INSERT INTO 'DAGR' ('Name', 'Creator', 'Parent_id') VALUES ($name, $creator, $parent)");
            if ($stmt->execute()) {
              echo '<br>DAGR insertion was successful.';
            } else {
              echo '<br>DAGR insertion failed.';
            }
          }
        ?>

      </td>
    </tr>
  </tbody>
</table>
