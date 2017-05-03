<form method="get" action="<?php echo htmlspecialchars('php/responses/search.php');?>" id="file-search-form">
	File Name: <input type="text" name="name"><br>
	Creator Name: <input type="text" name="creator"><br>
	Local or Online: <select type="text" name="localonline">
		<option value="Either">Either</option>
		<option value="Local">Local</option>
		<option value="Online">Online</option>
	</select><br>
	URL: <input type="text" name="url"><br>
	File Type: <input type="text" name="type"><br>
	<input type="hidden" name="object" value="file">
	<input type="submit" name="submit" value="Submit" id='file-search-button'/>
</form>

<script src="/js/search.js"></script>

<div id='results'></div>
