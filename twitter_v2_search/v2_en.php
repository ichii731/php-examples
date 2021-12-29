<?php
require_once "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(
    "************************", // API Key
    "************************", // API Secret
    null,
    "************************" // Bearer Token
);
$query = "#keyword";
// Set API version
$connection->setApiVersion("2");
$params = [
    /*
    - Reference:https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent
    - query and max_result are required
    */
    "query" => $query . " -is:retweet", // if you exclute retweets
    "start_time" => "2021-12-12T00:00:00", // UTC
    "end_time" => "2021-12-03T00:00:00",
    "tweet.fields" => "created_at", // additional posting date and time
    "max_results" => 100 // set between 10-100
];
// Set the number of requests to $req_count
// set the number of requests to $loop_count
$req_count = 0;
$loop_count = 400;

for ($i = 0; $i < $loop_count; $i++) {

    /**
     * When request is limited
     * We have set the time longer than 15 minutes and shorter than 450 times to allow for this.
     * Please take care of these issues on your own.
     */
    if($req_count > 400){
        echo "Wait for 15 minutes";
        $loop_count = 0;
        sleep(1000000);
    }
    // Request using v2 API
    $request = $connection->get("tweets/search/recent", $params);
    // Process the acquired information
    foreach ($request->data as $data) {
        // Your code here
    }
    echo "Success Request";
    // If you have more than 100 cases
    if (isset($request->meta->next_token)) {
        echo $req_count;
        $req_count++;
        // Add next_token to the query parameter array
        $params["next_token"] = $request->meta->next_token;
    } else {
        // If not, quit
        break;
    }
}
