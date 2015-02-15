<table border="0" bgcolor="white" cellspacing ="0" align="center" width="100%">
	<tr height=50>
		<td valign="middle" align="center" class="site_nav">
			<span class="smallgray">Ima let you finish writing your tweet... but these are the</span><br>
			<span class="objective redText">Top 25 point earners of <i>all time</i>:</span>
		</td>
		<td valign="middle" align="center" class="site_nav">
			<img src="./images/kanye-cutout.png" height=100>
		</td>
	</tr>

</table>

<table border="0" bgcolor="white" cellspacing ="5" align="center" width="100%">

<?php

// get top 25 users (based on points)
$query="select * from user 
where total_points >0 
order by (total_tweets*(total_points)*(total_challenges)*(total_retweets+1)) desc limit 25;";
$result=mysql_query($query);

require('tableScoreboard.php');
?>	
	
</table>
