<?php    
    require_once("../../resources/config.php");
    require_once(TEMPLATES_PATH . "header.php");
?>

<table border="0">
  <tbody>
    <tr>
      <td>
        <h2>Add a DAGR Category</h2>
        <p>This page adds a new DAGR, a standalone folder. This DAGR can be created alone or within another existing DAGR.</p>
        <p>To save a file in the database, select the option above to add a new file.</p>
        <!-- A user may create a DAGR with the components of the web page, or add these components to an open -->
        <!--
          <form action="#" method="post">
		      <select name=dropdown>
		        <option value="select">Select</option>
		        <option value="insert">Insert</option>
		        <option value="search">Search</option>
		        <option value="view">View All</option>
	        </select>
	        <input type="submit" name="submit" value="Submit" />
		      </form> -->
        <p>... form to add a DAGR will be below ...</p>

      </td>
    </tr>
  </tbody>
</table>
        
<?php
    require_once(TEMPLATES_PATH . "footer.php");
?>
