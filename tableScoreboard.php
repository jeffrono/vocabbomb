<?php

while($row = = $result->fetch_assoc()) {
	$handle= $row["handle"];
	$profile_image_url = $row["profile_image_url"];
	$active = date("F j, Y", strtotime($row["active"]));
	$total_points= $row["total_points"];
	$total_tweets= $row["total_tweets"];
	$total_challenges= $row["total_challenges"];
	$avg_tweet_score= $row["avg_tweet_score"];
	$total_retweets= $row["total_retweets"];
	
	# get the url for twitter
	$userurl = 'http://www.twitter.com/' . $handle;
	# get big profile image
	$profile_image_url = preg_replace("/_normal\./", '_bigger.', $profile_image_url);
?>

<tr>
	<td><img src ="<?php echo $profile_image_url; ?>" width="73" height="73"></td>
	<td class="topuser" style="text-align: center;"><a href="<?php echo $userurl; ?>" target="_blank"><?php echo $handle; ?></a>
	<br><span class="instructionsmall grayText">Since <?php echo $active; ?></span>
	</td>
	
	<td class="ratingbox" style="width: 75;">
	<span class="xbig"><?php echo $total_points; ?></span><br><br>
	<span class="smallgray">total<br>points</span>
	</td>
	
	<td class="ratingbox" style="width: 75;">
	<span class="xbig"><?php echo $total_tweets; ?></span><br><br>
	<span class="smallgray">completed challenges<br>of <?php echo $total_challenges; ?> possible</span>
	</td>
	
	<td class="ratingbox" style="width: 75;">
	<span class="xbig"><?php echo $avg_tweet_score; ?></span> <span class="big grayText">/100</span><br><br>
	<span class="smallgray">average rating<br>per tweet</span>
	</td>
	
	
</tr>


<?php
} //while
?>