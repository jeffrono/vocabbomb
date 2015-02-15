<?php
require_once "dbFunctions.php";
vb_connect();

//$ip=@$REMOTE_ADDR;
$ip=$_SERVER['REMOTE_ADDR']; //global something, may need to switch back

?>

<html>
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
<a class="nav_selected" href="challenge.php">today's challenge</a>
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

<td valign="top">
<table border="0" bgcolor="white" cellspacing ="0" align="center" width="100%">
	<tr height=50>
		<td valign="middle" align="center" class="site_nav">
			<span class="objective redText">Previous challenges:</span>
		</td>
		<td valign="middle" align="center" class="site_nav">
			<img src="./images/mysterysm.jpg">
		</td>
	</tr>
</table>

<?php require_once('tableChallenges.php'); ?>

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