<table border="0" bgcolor="white" cellspacing ="5" align="middle" valign="top" width="100%">
<?php
//get previous challenges
$query="select created_at, word, partofspeech, definition, count(tweet.id) as tweetcount, sum(tweet.rating) as points
from challenge join (word, tweet) on challenge.word_id = word.id and tweet.challenge_id = challenge.id
group by challenge.id
order by challenge.id desc
limit 1,50;";
$result=mysqli_query($link, $query);

while($row = mysqli_fetch_array($result)) {
	$challenge_date = date("F j, Y", strtotime($row["created_at"]));
	$word= $row["word"];
	$partofspeech = $row["partofspeech"];
	$definition = $row["definition"];
	$tweetcount= $row["tweetcount"];
	$points= $row["points"];
	
?>

<tr>
	<td>
		<img src ="./images/Bomb.png" height="40">
	</td>
	<td width="125">
		<span class="small"><?php echo $challenge_date; ?></span>
	</td>
	<td class="topuser" style="text-align: center;">
		<?php echo $word; ?><br>
		<span class="instructionsmall grayText">(<?php echo $partofspeech; ?>)</span> <span class="instructionsmall"><?php echo $definition; ?></span>
	</td>
	<td class="ratingbox" style="width: 75;">
		<span class="xbig"><?php echo $tweetcount; ?></span><br><br>
		<span class="smallgray">total<br>tweets</span>
	</td>
	
	<td class="ratingbox" style="width: 75;">
	<span class="xbig"><?php echo $points; ?></span><br><br>
	<span class="smallgray">points from<br>all votes</span>
	</td>
	
</tr>


<?php
} //while
?>
</table>