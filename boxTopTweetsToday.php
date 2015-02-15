<table border="0" bgcolor="white" cellspacing ="5" align="center" width="100%">

<tr height=50>
	<td colspan=4 class="ratingbox">
	<span class="xbig redText">Top 10 tweets today:</span><br><br>
	<span class="smallgray">These tweets have blown up.<br></span>
	</td>	
</tr>

<?php

// get top 10 voted tweets for the past week
$query="select tweet.display_tweet, tweet.handle_id, tweet.rating, tweet.num_ratings, tweet.retweets, tweet.hashtag
from tweet join challenge on tweet.challenge_id = challenge.id
where tweet.rating > 0 and tweet.num_ratings > 0
and date(challenge.created_at) = curdate()
order by ((tweet.rating)*(tweet.num_ratings)*(tweet.retweets + 1)) desc
limit 10;";

$query="select tweet.display_tweet, tweet.handle_id, tweet.rating, tweet.num_ratings, tweet.retweets, tweet.hashtag
from tweet join challenge on tweet.challenge_id = challenge.id
where tweet.rating > 0 and tweet.num_ratings > 0
order by ((tweet.rating)*(tweet.num_ratings)*(tweet.retweets + 1)) desc
limit 10;";

$result=mysqli_query($link,$query);
$i=0;
echo $result;
while($row = mysql_fetch_array($result)) {
	$display_tweet = $row["display_tweet"];
	$total_rating = $row["rating"];
	$num_ratings = $row["num_ratings"];
	$handle_id = $row["handle_id"];
	$retweets = $row["retweets"];
	$hashtag = $row["hashtag"];
	$i++;

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
	<td>
		<img src ="<?php echo $profile_image_url; ?>" width="73" height="73"></td>
	<td>
		<blockquote class="rounded" cellspacing="15">
		<p class="toptweet"><?php echo $display_tweet; ?></p>
		<div class="green" style="vertical-align: bottom;">
			<?php 
				if($retweets > 0) {
					echo $retweets; 
			?>
			RTs
			<?php } ?>
		</div>
		</blockquote>
	</td>
	<td rowspan=2 class="ratingbox">
		<span class="red">Rating:</span><br>
		<span class="xbig"><?php echo $total_rating; ?></span><br><br>
		<span class="smallgray">Based on<br>
		<?php echo $num_ratings; ?> votes
		</span>
	</td>
</tr>
<tr>
	<td colspan=2 class="yellowTab">
		<?php if($hashtag == 1) { ?><img src="./images/hashtag_mini.png"><?php } ?>
		<span align="left"><b><a href="<?php echo $userurl; ?>" target="_blank"><?php echo $handle; ?></a></b><br>
		<span class="grayText tinyText">
		<?php echo $numtweets; ?> tweet(s), 
		<?php echo $numchallenges; ?> completed challenge(s)
		</span>
		</span>
	</td>
</tr>

<?php			
	} // end while loop

// if no tweets rated yet today
if($i==0) {
?>

<tr height=50>
	<td colspan=4 style="text-align:center;">
		Sorry...  No tweets have been rated today!  Go and <a href="rate.php">rate some</a>.
	</td>	
</tr>

<?php
} //if no tweets rated today
?>

</table>
