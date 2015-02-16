<?php

// get a tweet to rate (from tweet word table)
// make sure it has not been rated by this user yet today
$query="select tweet.id, tweet.tweet, tweet.display_tweet, word.word, word.partofspeech, word.definition
	from tweet join (user, challenge) 
	on tweet.handle_id= user.id and challenge.id = tweet.challenge_id
	join word on challenge.word_id = word.id
	where tweet.num_ratings < 100
	and tweet.id not in
	(select tweet_id
	from rating
	where ip = '$ip')
	order by tweet.hashtag desc, tweet.retweets desc, challenge.id desc limit 1;";
$result = $link->query($query);
while($row = = $result->fetch_assoc()) {
	$tweet_id = $row["id"];
	$tweet = $row["tweet"];
	$display_tweet = $row["display_tweet"];
	$word = $row["word"];
	$pos = $row["partofspeech"];
	$definition = $row["definition"];
}

// get number of vote-able tweets remaining
/*
$query="select count(distinct tweet.id) as count 
	from tweet join (user, challenge) on tweet.handle_id= user.id and challenge.id = tweet.challenge_id
	where tweet.num_ratings < 100
	and tweet.id not in
	(select tweet_id
	from rating
	where ip = '$ip')";
$result = $link->query($query);
while($row = = $result->fetch_assoc()) {
	$remainingvotes = $row["count"] - 1;
}
*/

if(!isset($tweet_id)) {
	require_once('boxNoMoreTweets.php');
}
else {
?>

<table border="0" bgcolor="white" cellspacing ="5" align="middle" valign="top" width="100%" >
<tr>
	<td valign="middle" align="left" colspan=2>
		<div style="float: left; text-align: left;" class="instruction">How well does this tweet use the vocab word below? Vote on humor, originality, readability, etc.</div>
	</td>
</tr>

<tr>
	<td height="175" valign="middle" align="center" colspan=2>
		<span class="big"><?php echo $display_tweet; ?></span>
	</td>
</tr>

<tr>
	<td align="right" colspan=2>
		<a href="http://www.google.com/search?q=<?php echo $tweet; ?>" target="_blank"><span class="email">Sound unoriginal? Google this tweet.</span></a><br>
	</td>
</tr>
<tr>
	<td height="50" valign="top" align="center">
		<table border="0" bgcolor="white" cellspacing ="5">
			<tr>
				<td align="center">
					<form method="POST" id="like">
					<input type="hidden" name="tweet_id" value="<?php echo $tweet_id; ?>" />
					<input type="hidden" name="like" value="something" />
					<input type="submit" name="like" value="+1 Yah!" class="btn" />
					</form>
					<span class="smallgray">or press UP</span>
				</td>
				<td align="center">
					<form method="POST" id="skip">
					<input type="hidden" name="tweet_id" value="<?php echo $tweet_id; ?>" />
					<input type="hidden" name="skip" value="something" />
					<input type="submit" name="skip" value="Meh." class="btn" />
					</form>
					<span class="smallgray">or press RIGHT</span>
				</td>
				<td align="center">
					<form method="POST" id="dislike">
					<input type="hidden" name="tweet_id" value="<?php echo $tweet_id; ?>" />
					<input type="hidden" name="dislike" value="something" />
					<input type="submit" name="dislike" value="-1 Blech." class="btn" />
					</form>
					<span class="smallgray">or press DOWN</span>
				</td>
			</tr>
		</table>
	</td>
</tr>

<tr>
	<td>
		<span class="midbold"><?php echo $word; ?></span> <?php echo "($pos): $definition"; ?>
	</td>
	
	<td align="right">
	<?php /*<span class="midbold"><?php echo $remainingvotes; ?></span> tweets left to vote! */ ?>
	</td>
	
</tr>
</table>
<?php
	}
?>
<br>