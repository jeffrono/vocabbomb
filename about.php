<?php
require_once "dbFunctions.php";
$link = vb_connect();
?>

<html>

<head>
	 <meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<script src="http://platform.twitter.com/anywhere.js?id=qnnOypQXcQj5gryeUGf3Hw&amp;v=1" type="text/javascript"></script>
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
<a class="item" href="rate.php">rate some tweets</a>
<a class="item" href="toptweets.php">top tweets</a>
<a class="item" href="scoreboard.php">scoreboard</a>
<a class="item" href="challenge.php">today's challenge</a>
<a class="nav_selected" href="about.php">about</a>
</td>

</tr>
</table>

<br>

<table border="0" cellspacing ="5" width="100%" class="bigtable">
	<tr>
		<td valign="top" align="left">
			<?php require('googleAds.txt'); ?>
		</td>

		<td width="100%">
		
<?php
require_once('boxAbout.php');
?>

</td>

<td valign="top" align="right">
<?php require('googleAds.txt'); ?>
</td>

</tr>
</table>
<?php
	require('googleAnalytics.txt');
?>
</body>
</html>