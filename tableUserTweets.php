<table border="0" bgcolor="white" cellspacing ="5" align="center" width="100%">

<tr height=50>
	<td colspan=4 class="ratingbox">
	<span class="xbig redText">Your last 5 tweets:</span><br>
	</td>
</tr>

<?php

while($row = mysqli_fetch_array($result)) {
	$display_tweet = $row["display_tweet"];
	$total_rating = $row["rating"];
	$num_ratings = $row["num_ratings"];
	$handle_id = $row["handle_id"];
	$retweets = $row["retweets"];
	$published = strtotime($row["published"]);
?>
	
<tr>
	<td height="75px">
		<span class="toptweet mid"><?php echo $display_tweet; ?></span></td>
	<td rowspan=2 class="ratingbox">
		<span class="red">Rating:</span><br>
		<span class="xbig"><?php echo $total_rating; ?></span><br><br>
		<span class="smallgray">Based on<br>
		<?php echo $num_ratings; ?> votes, 
		<?php echo $retweets; ?> RTs
		</span>
	</td>
</tr>
<tr>
	<td class="yellowTab" height="5px">
		<span>Tweeted on: <?php echo date("l, F j", $published); ?></span>
	</td>
</tr>

<?php			
} // while
?>

</table>
<br><br>