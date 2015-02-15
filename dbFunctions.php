<?php

// *** DATABASE FUNCTIONS ***
function vb_connect() {
	$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	return $link;
}

# gets the top tweets for the day or week
function top_tweets($when) {
	# today
	if($when = "today") {
	$query = "select distinct tweet.tweet, tweet.handle_id, tweet.rating, tweet.num_ratings
from tweet join rating on tweet.id = rating.tweet_id
where tweet.rating > 0 and tweet.num_ratings > 0
and YEARweek(tweet.published) = YEARweek(CURRENT_DATE - INTERVAL 7 DAY)
order by ((tweet.rating)*(tweet.num_ratings)) desc
limit 25;";

		$result = mysqli_query($link, $query);
		if($lst = mysql_fetch_assoc($result))
		{
			mysql_free_result($result);
			return $lst;
		}
		mysql_free_result($result);
		return false;
	}
	
	if($when == "lastweek") {
	$query = "select distinct tweet.tweet, tweet.handle_id, tweet.rating, tweet.num_ratings
from tweet join rating on tweet.id = rating.tweet_id
where tweet.rating > 0 and tweet.num_ratings > 0
and YEARweek(tweet.published) = YEARweek(CURRENT_DATE - INTERVAL 7 DAY)
order by ((tweet.rating)*(tweet.num_ratings)) desc
limit 25;";
		$result = mysqli_query($link, $query);
		if($lst = mysqli_fetch_assoc($result))
		{
			mysqli_free_result($result);
			return $lst;
		}
		mysqli_free_result($result);
		return false;
	}
}

# gets the top tweets for the day or week
class countdown
{
	public $hours;
	public $minutes;
	
	public function hours() {
		// get hour and minute countdown
		$date1 = date("Y-m-d H:i:s"); 
		$tomorrow = mktime(3, 0, 0, date("m"), date("d")+1, date("y"));
		$date2 = date("Y-m-d H:i:s ", $tomorrow);
		$diff = abs(strtotime($date2) - strtotime($date1));
		$years   = floor($diff / (365*60*60*24)); 
		$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
		$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
		$minutes  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
		return $hours;
	} # hours
	
	public function minutes() {
		// get hour and minute countdown
		$date1 = date("Y-m-d H:i:s"); 
		$tomorrow = mktime(24, 0, 0, date("m"), date("d")+1, date("y"));
		$date2 = date("Y-m-d H:i:s ", $tomorrow);
		$diff = abs(strtotime($date2) - strtotime($date1));
		$years   = floor($diff / (365*60*60*24)); 
		$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
		$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
		$minutes  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
		return $minutes;
	} # hours
}

?>