<?php
require_once('dbFunctions.php');
vb_connect();

//$ip=@$REMOTE_ADDR;
$ip=$_SERVER['REMOTE_ADDR']; //global something, may need to switch back

$previousvote = 0;

# see what post params we're working with
if (isset($_POST)) {
	if (isset($_POST["like"])) {
		$vote = 1;
	}
	elseif (isset($_POST["skip"])) {
		$vote = 0;
	}
	elseif (isset($_POST["dislike"])) {
		$vote = -1;
	}
	
	# did this ip already vote on this tweet?  if not, previousvote will stay 0
	if (isset($_POST["tweet_id"])) {
		$query="select 1 from rating where ip='$ip' and tweet_id = " . $_POST["tweet_id"];
		$result=mysql_query($query);
		$previousvote = mysql_num_rows($result);
	} # if there is a tweet id
} # if post

# only if there is a vote registered AND this IP did not vote on this tweet_id, then the vote gets counted
if(isset($vote) && $previousvote <1) {
	// update tweet rating
	$query="update tweet set rating = rating+$vote, num_ratings = num_ratings+1 where id = " . $_POST["tweet_id"];
	$result=mysql_query($query);

	// insert rating record for ip/tweet
	$query="insert into rating (ip, tweet_id, rating) values ('$ip', " . $_POST["tweet_id"] . ", $vote)";
	$result=mysql_query($query);
} # if vote was registered

?>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<script src="shortcut.js" type="text/javascript"></script>
	<script type="text/javascript">
			shortcut.add("Up",function() {
				document.forms["like"].submit();
			});
			shortcut.add("Right",function() {
				document.forms["skip"].submit();
			});
			shortcut.add("Down",function() {
				document.forms["dislike"].submit();
			});
	</script>
</head>


<title>VocabBomb.com - where your tweets blow up</title>
<link rel="stylesheet" href="tweet.css" type="text/css" media="all" />
<body>
<div style="float: left; text-align: left;"><a href="http://www.vocabbomb.com"><img src="./images/vocabbomb_logo.jpg" height="50"></a><span class="topnav"> where your tweets blow up</span></div>
<div style="float: right; text-align: left;"><a href="http://www.vocabsushi.com"><img src="./images/logo_new.png" height="100"></a><br><span class="topnav small">Brought to you by <a href="http://www.vocabsushi.com">VocabSushi.com</a></span></div>

<br><br>

<table class="site_nav">
<tr>
<td width="700">	
<a class="item" href="index.php">home</a>
<a class="nav_selected" href="rate.php">rate some tweets</a>
<a class="item" href="toptweets.php">top tweets</a>
<a class="item" href="scoreboard.php">scoreboard</a>
<a class="item" href="challenge.php">today's challenge</a>
<a class="item" href="about.php">about</a>
</td>

</tr>
</table>

<br>

<table border="0" cellspacing ="5" width="100%" class="bigtable">
<tr>
<td valign="top" align="left">
<?php require('googleAds.txt'); ?>
</td>


<td>
<?php

//require_once('boxChallenge.php');
require_once('boxRateTweet.php');
require_once('previousRatedTweets.php');

?>

</td>

<td valign="top" align="right">
<?php require('googleAds.txt'); ?>
</td>

</tr>
</table>

<?php
	mysql_close();
	require('googleAnalytics.txt');
?>
</div>
</body>
</html>