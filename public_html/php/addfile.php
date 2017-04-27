<?php    
    require_once("../../resources/config.php");
    require_once(TEMPLATES_PATH . "header.php");
?>

<table border="0">
  <tbody>
    <tr>
      <td>
        <h2>Add a File</h2>
        <p>This page adds a new File within a DAGR. This DAGR can be created alone or within another existing DAGR.</p>
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
        <p>... form to add a File will be below ...</p>

      </td>
    </tr>
  </tbody>
</table>

<?php
    require_once(TEMPLATES_PATH . "footer.php");
?>
