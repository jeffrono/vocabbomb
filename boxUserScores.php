<table border="0" bgcolor="white" cellspacing ="5" align="middle" valign="top" width="100%" height="175">

<?php
// if user submitted their handle
if (isset($_POST["handle"])) {
	$handle = $_POST["handle"];
?>
<tr height=50>
	<td colspan=6 valign="middle" align="center" class="site_nav">
		<span class="objective redText">Scoreboard for </span><span class="objective blackText"><?php echo $handle; ?></span><span class="objective redText">:<br>
		<span class="midbold grayText">Nice work.  Keep up the boom.</span><br>
	</td>
</tr>

<tr><td><br></td></tr>

<?php

// print out the user's scoreboard!
$query="select * from user where handle = '$handle';";
$result=mysqli_query($link, $query);

require('tableScoreboard.php');

?>
</table>
<br><br>

<?php
// get last 5 tweets from this user
$query="select * 
from tweet join user on tweet.handle_id = user.id 
where user.handle = '$handle'
order by tweet.id desc
limit 5;";

$result=mysqli_query($link, $query);

require('tableUserTweets.php');

} // if
else {
?>

<tr height=50><td valign="middle" align="center">
<span class="instruction">Enter your handle to get your scores.</span></td></tr>
<tr><td height="100" align="center">
<form method="POST">
<span class="big">
<input type="text" name="handle" value="your twitter handle" class="big" size="20" onblur="if(this.value.length == 0) this.value='your twitter handle';" onclick="if(this.value == 'your twitter handle') this.value='';" />
<input type="submit" value="Get my score!" class="btn" />
</form>
</span>
</td></tr>
</table>

<?php
} // else
?>