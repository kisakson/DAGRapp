<h2>Reach Report</h2>
<p>This tool lists all DAGRs connected to the input DAGR, either through parents or through children, recursively.</p>

<form method="get" action="<?php echo htmlspecialchars('php/responses/reach.php');?>" id="dagr-reach-form">
  <div class='form-row'>DAGR Name: <input type="text" name="name"></div><br>
  <div class='form-row'><input type="submit" name="submit" value="Reach" class='submit-button' id='dagr-reach-button'/></div><br>
</form>

<script src="/js/reach.js"></script>
<div id='results'></div>