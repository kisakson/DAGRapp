<script src="/js/body.js"></script>
<h2>Time Range Report</h2>
<h4>View a time report for DAGRs created from </h4>
<h5>


<form method="get" action="<?php echo htmlspecialchars('php/responses/time.php');?>" id="dagr-time-form">
<br>
Month
<select name=start_dropdown><?php 	// START MONTH
for($month=1; $month<13; $month++)	// the interval for months is [1-12]
    echo '<option>'.str_pad($month,2,'0',STR_PAD_LEFT).'</option>';
?></select>

Day
<select name=start_2_dropdown><?php	// START DAY
  for($days=1; $days<32; $days++)    	// the interval for days is [1-31]
    echo '<option>'.str_pad($days,2,'0',STR_PAD_LEFT).'</option>';
?></select>

Time
<select name=start_3_dropdown><?php	// START TIME
    for($hours=0; $hours<24; $hours++) 	// the interval for hours is '1'
      for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
          echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                         .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
?></select>   


<br><br> to <br><br>
  
Month
<select name=end_dropdown><?php  	// END MONTH
for($month=1; $month<13; $month++)	// the interval for months is [1-12]
    echo '<option>'.str_pad($month,2,'0',STR_PAD_LEFT).'</option>';

?></select> 

Day
<select name=end_2_dropdown><?php  	// END DAY
  for($days=1; $days<32; $days++)    	// the interval for days is [1-31]
    echo '<option>'.str_pad($days,2,'0',STR_PAD_LEFT).'</option>';

?></select> 

Time
<select name=end_3_dropdown><?php	// END TIME
  for($hours=0; $hours<24; $hours++) 	// the interval for hours is '1'
    for($mins=0; $mins<60; $mins+=30) 	// the interval for mins is '30'
        echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
?></select>
</h5>

<input type="submit" name="submit" value="Get Time Range" class='submit-button' id='dagr-time-button'/>
</form>
<br>
<div id='results'></div>
