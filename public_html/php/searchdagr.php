<form method="get" action="<?php echo htmlspecialchars('php/responses/search.php');?>" id="dagr-search-form">
	DAGR Name: <input type="text" name="name"><br>
  Creator Name: <input type="text" name="creator"><br>
  Contains Category: <input type="text" name="category"></br>
	<input type="hidden" name="object" value="dagr">
	<input type="submit" name="submit" value="Submit" class='submit-button' id='dagr-search-button'/>
</form>

<script src="/js/search.js"></script>

<div id='results'></div>
