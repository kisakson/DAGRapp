<h2>Search Files</h2>
<p>Use the form below to query the DAGR Saver database on different File values. All query values are optional.</p>
<p>After searching, you can also delete Files. Click twice to confirm the deletion and search again to view the updated table.</p>
<form method="get" action="<?php echo htmlspecialchars('php/responses/search.php');?>" id="file-search-form">
	<div class='form-row'>File Name: <input type="text" name="name"></div><br>
	<div class='form-row'>Creator Name: <input type="text" name="creator"></div><br>
	<div class='form-row'>Local or Online: <select type="text" name="localonline">
		<option value="Either">Either</option>
		<option value="Local">Local</option>
		<option value="Online">Online</option>
	</select></div><br>
	<div class='form-row'>URL: <input type="text" name="url"></div><br>
	<div class='form-row'>File Type: <input type="text" name="type"></div><br>
	<input type="hidden" name="object" value="file">
	<div class='form-row'><input type="submit" name="submit" value="Submit" class='submit-button' id='file-search-button'/></div>
</form>

<script src="/js/search.js"></script>

<div id='results'></div>
