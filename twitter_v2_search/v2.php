<?php
require_once "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(
    "************************", // API Key
    "************************", // API Secret
    null,
    "************************" // ベアラートークン
);
$query = "キーワード";
// ここでAPIのバージョンを2に指定
$connection->setApiVersion("2");
$params = [
    /*
    参照：https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent
    ※queryとmax_resultは必須
    */
    "query" => $query . " -is:retweet", // RTを除外したい時
    "start_time" => "2021-12-12T00:00:00+09:00",
    "end_time" => "2021-12-03T00:00:00+09:00",
    "tweet.fields" => "created_at", // 今回は追加で投稿日時を指定
    "max_results" => 100 // 10～100の間を指定
];
// $req_countにリクエストの回数を設定・$loop_countにリクエスト回数を設定
$req_count = 0;
$loop_count = 400;

for ($i = 0; $i < $loop_count; $i++) {

    /* リクエスト制限時
    余裕を持って15分より長く、450回より短く設定しています。
    ここら辺の処理は各自皆さんでうまく対処してください。
    */
    if($req_count > 400){
        echo "制限 / 15分待機";
        $loop_count = 0;
        sleep(1000000);
    }
    // v2でリクエスト
    $request = $connection->get("tweets/search/recent", $params);
    // 取得情報を処理
    foreach ($request->data as $data) {
        // ＜ここでデータの処理をする＞
    }
    echo "Success Request";
    // 100件以上ある場合
    if (isset($request->meta->next_token)) {
        echo $req_count;
        $req_count++;
        // クエリパラメータの配列にnext_tokenを追加
        $params["next_token"] = $request->meta->next_token;
    } else {
        // 無いときは終了
        break;
    }
}
