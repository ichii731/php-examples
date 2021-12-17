<?php
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;


function tweet_loop($keyword, $loop_count)
{
	global $CK, $CS, $AT, $ATS;
	$connection = new TwitterOAuth($CK, $CS, $AT, $ATS);
	$params = [
		'q' => $keyword,
		'count' => 100
	];
	for ($i = 0; $i < $loop_count; $i++) {
		$results = $connection->get("search/tweets", $params);
		foreach ($results->statuses as $val) {
			// Write the post-acquisition process here
			$tweet_results[] = $val->text;
		}

		//Conditional branching to see if there are more tweets that can be retrieved
		if (isset($results->search_metadata->next_results)) {
			// Get max_id
			$max_id = preg_replace('/.*?max_id=([\d]+)&.*/', '$1', $results->search_metadata->next_results);
			// Add max_id to params
			$options['max_id'] = $max_id;
		} else {
			break; // なければループを抜ける
		}
	}
	return $tweet_results;
}
