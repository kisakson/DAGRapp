<?php    
    // load up your config file
    require_once("/../../resources/config.php");
     
    require_once(TEMPLATES_PATH . "/header.php");
?>
<div id='main-container'>
  <div id='main-content'>
    
    <table border="0">
      <tbody>
        <tr>
          <td>
            <!--- A user may create a DAGR with the components of the web page, or add these components to an open --->
		        <select name=dropdown>
		        <option value="">Select</option>
		        <option value="insert">Insert</option>
		        <option value="modify">Modify</option>
		        <option value="search">Search</option>
		        <option value="view">View</option>
		        </select>
		
		        <?php
		
		          include 'connect.php';
		
		          // An insertion query. $result will be `true` if successful
		          $result = db_query("SELECT * FROM `DAGR`");
		          if(!$result) {
		            echo "ERROR; Unable to connect. <br>";
		          } else {
		            echo "We successfully inserted a row into the database <br>";
		          db_echoresults($result, 1);
		          }
		
	 	          if($_POST['submit'] && $_POST['submit'] != 0) {
  			        $c = $_POST['dropdown'];
		          }
		        ?>

          </td>
        </tr>
      </tbody>
    </table>
        
  </div>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>