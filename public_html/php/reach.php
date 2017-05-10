<h2>Reach Report</h2>

<form method="get" action="<?php echo htmlspecialchars('php/responses/reach.php');?>" id="dagr-reach-form">
  DAGR Name: <input type="text" name="name"><br>
  <input type="submit" name="submit" value="Reach" class='submit-button' id='dagr-reach-button'/>
  <br>
</form>

<script src="/js/body.js"></script>
<br>
<div id='results'></div>