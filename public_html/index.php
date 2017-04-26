<?php    
    // load up your config file
    require_once("../config.php"); // Might need to be config.ini
    require_once("header.php");
    
?>

<div id='main-container'>
  <div id='main-content'>
    
    <table border="0">
      <tbody>
        <tr>
          <td>
            <!--- A user may create a DAGR with the components of the web page, or add these components to an open --->
            		<form action="#" method="post">
		        <select name=dropdown>
		        <option value="">Select</option>
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
				/*  				Inlcude 'modify' in 'search'
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
        
  </div>
</div>

<?php
    require_once("footer.php");
?>