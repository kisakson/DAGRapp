<?php    
    require_once("../resources/config.php");
    require_once(TEMPLATES_PATH . "header.php");
?>
   
<table border="0">
   <tbody>
    <tr>
      <td>
      <!-- A user may create a DAGR with the components of the web page, or add these components to an open -->
        <form action="#" method="post">
		      <select name=dropdown>
		        <option value="select">Select</option>
		        <option value="insert">Insert</option>
		        <option value="search">Search</option>
		        <option value="view">View All</option>
		      </select>
		      <input type="submit" name="submit" value="Submit" />
		    </form>
			
		    <?php
		      if(isset($_POST['submit'])){
				      switch($_POST['dropdown']) {
				case 'insert':	
						
						break; 
				/*  				Include 'modify' in 'search'
				case 'modify':	
						
						break; */
				case 'search':	
						
						break; 
				case 'view':	
						echo '<script type="text/javascript">' .
						     'window.location = "http://bagelcron.com/view.php?q=Tester"' .
						     '</script>';
						break; 
				}
			}
		        ?>

      </td>
    </tr>
  </tbody>
</table>
        

<?php
    require_once(TEMPLATES_PATH . "footer.php");
?>
