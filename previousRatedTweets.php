<table cellspacing ="5" width="100%" align="center">

<?php

// possibly show a congrats row
$query = "select count(id) as count
from rating
where date(rating.created_at) = curdate()
and rating.ip = '$ip';";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$yournumvotes = $row["count"];
}
if($yournumvotes %25 == 0 && $yournumvotes > 0) {
?>
<tr>
	<td colspan=4 class="ratingbox">
	<span class="red">Congratulations!</span><br>
	<span class="xbig">You have rated <?php echo $yournumvotes; ?> tweets!</span><br><br>
	<span class="smallgray">You rock. Hard.<br></span>
	</td>	
</tr>

<?php
} # if
?>

	
	<tr>
		<td colspan=4>
			<table border="0" bgcolor="white" cellspacing ="0" align="center" width="100%">
		<tr height=50>
			<td valign="middle" align="center" class="site_nav">
				<span class="smallgray">"Have a heart that never hardens, and a temper that never tires, and a touch that never hurts." -Charles Dickens</span><br>
				<span class="objective redText">Previously rated tweets:</span>
			</td>
			<td valign="middle" align="center" class="site_nav">
				<img src="./images/Dickens.jpg" height=100>
			</td>
		</tr>

	</table>
		</td>
	</tr>


<?php 
// print out previously rated sentences for this ip
$query="select rating.rating, tweet.display_tweet, tweet.rating as total_rating, 
tweet.num_ratings, (tweet.rating / tweet.num_ratings) as average, tweet.handle_id, tweet.hashtag, tweet.retweets
from rating join tweet on rating.tweet_id = tweet.id
join user on tweet.handle_id = user.id
and rating.ip = '$ip'
order by rating.created_at desc
limit 20;";

$result=mysql_query($query);
$i=0;
while($row = mysql_fetch_array($result)) {
	$tweet = $row["display_tweet"];
	$your_rating = $row["rating"];
	$total_rating = $row["total_rating"];
	$num_ratings = $row["num_ratings"];
	$average = round($row["average"], 2);
	$handle_id = $row["handle_id"];
	$hashtag = $row["hashtag"];
	$retweets = $row["retweets"];
	$i++;
	
	#get average in percentage
	$average = round($average*100, 0);
	
	# get this user's num tweets, and num vocab words
	$query="select * from user where id = $handle_id";
	$resultb=mysql_query($query);

	while($rowb = mysql_fetch_array($resultb)) {
		$handle = $rowb["handle"];
		$profile_image_url = $rowb["profile_image_url"];

		# get the url for twitter
		$userurl = 'http://www.twitter.com/' . $handle;
		# get big profile image
		$profile_image_url = preg_replace("/_normal\./", '_bigger.', $profile_image_url);
	} # while got handle info
	
	# get the number of unique tweets for this user
	$query="select count(distinct id) as numtweets from tweet where tweet.handle_id = $handle_id";
	$resultb=mysql_query($query);
	while($rowb = mysql_fetch_array($resultb)) {
		$numtweets = $rowb["numtweets"];
	}

	# get the number of unique vocab words used by this user
	$query="select count(distinct challenge_id) as challenges from tweet where tweet.handle_id = $handle_id";
	$resultb=mysql_query($query);
	while($rowb = mysql_fetch_array($resultb)) {
		$numchallenges = $rowb["challenges"];
	}
	
	?>
	
	<tr>
		<td><img src ="<?php echo $profile_image_url; ?>" width="73" height="73"></td>
		<td id="fullheight">
			<table id="fullheight" border="0" cellspacing ="0" width="100%">
				<tr>
					<td>
						<span class="ratedtweet"><?php echo $tweet; ?></span>
					</td>
				</tr>
				<tr>
					<td style="text-align:right; vertical-align:bottom;">
						<span class="green">
						<?php 
							if($retweets > 0) {
								echo $retweets; 
						?>
						RTs
						<?php } ?>
						</span>
					</td>
				</tr>
			</table>
		</td>
		<td rowspan=2 class="ratingbox">
		<span class="red">Rating:</span><br>
		<span class="xbig">
		<?php 
			if($total_rating>0) { print '+'; }
			print $total_rating;
		?>
		</span><br><br>
		<span class="smallgray">
		Based on<br>
		<?php echo $num_ratings; ?> votes
		</span>
		</td>
		
		<td rowspan="2" class="ratingbox">
		<span class="red">
		Your vote:<br>
		</span>
		
		<span class="xbig">
		<?php 
			if($your_rating>0) { print '+'; }
			print $your_rating;
		?>
		</span>
		
		<br><br>
		<span class="smallgray">
		Avg: 
		<?php 
			if($average>0) { print '+'; }
			print $average;
		?>
		%
		<br>&nbsp;</span>
		</td>
  </tr>
  <tr class="yellowTab">
		<td colspan=2>
		
		<?php if($hashtag == 1) { ?><img src="./images/hashtag_mini.png"><?php } ?><span align="left"><b><a href="<?php echo $userurl; ?>" target="_blank"><?php echo $handle; ?></a></b><br>
		<span class="grayText tinyText">
		<?php echo $numtweets; ?> tweet(s), 
		<?php echo $numchallenges; ?> completed challenge(s)
		</span>
		</span>
		</td>
  </tr>

<?php			
	} // end while loop
?>

</table>