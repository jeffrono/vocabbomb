<table border="0" bgcolor="white" cellspacing ="10" align="middle" valign="top" width="100%">
<tr height=50>
	<td colspan=4 valign="middle" align="center" style="padding-top:0px; padding-right:55px; padding-bottom:0px; padding-left:55px;">
		<span class="objective redText">Your VocabBomb challenge for <br><?php echo date("l, F j"); ?>.</span><br><br><br>
	</td>
</tr>

<?php
//get challenge word
$query="select *
from word join challenge on challenge.word_id = word.id
where challenge.created_at = curdate();";
$result=mysqli_query($link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$word = $row["word"];
	$pos = $row["partofspeech"];
	$definition = $row["definition"];
}
?>

<tr height="125">
	<td align="center">
		<div id="tbox"></div>
		<script type="text/javascript">
			twttr.anywhere(function (T) {
				T("#tbox").tweetBox({
					height: 100,
					width: 400,
					defaultContent: " #vocabbomb",
					label: "Use the word <?php echo "'$word'"; ?> in a tweet:",
					
				});
			});
		</script>
		
	</td>
</tr>
<tr>
	<td align="center">
		<span class="small grayText">This challenge will self-destruct in <?php echo countdown::hours(); ?> hours, <?php echo countdown::minutes(); ?> minutes.</span>
	</td>
</tr>


<tr class="yellowTab" align="center">
	<td align="center">
		<span class="xbig"><?php echo $word; ?>: </span> 
		<span class="grayText small">(<?php echo $pos; ?>)</span>
		<span class="small"><?php echo $definition; ?></span>
	</td>
</tr>
<tr>
	<td class="instructionsmall">
		<br><br>
		Use the specified word in a tweet, like this:<br><br>
	</td>
</tr>
<tr>
	<td class="bombword">
		I showed up to class today a little <i>unkempt</i>.  Even my shoelaces weren't tied. #vocabbomb.
	</td>
</tr>
<tr>
	<td class="instructionsmall">
		Remember, your tweets will be rated, so make 'em interesting!  Use the challenge word as best as you can according to the definition provided.  Get your friends to retweet your post and you'll earn more points.  Don't forget to use the hashtag <b>#vocabbomb</b>.
		<br><br>
	</td>
</tr>


</table>
