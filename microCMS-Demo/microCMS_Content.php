<?php
$id = $_GET['id'];

// クエリパラメータを取得
if (isset($id) == true) {
    GetContent($id);
} else {
    echo 'Set query parameters';
}

function GetContent($id)
{
    // cUrlでAPIを叩く
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://***************.microcms.io/api/v1/news/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    $headers[] = 'X-Api-Key: ***************************************';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);

    // 取得したら表示
    $result = json_decode($response, true);
    ShowHtml(
        $result['title'],
        $result['createdAt'],
        $result['updatedAt'],
        $result['body']
    );
}

// コンテンツ表示部
function ShowHtml($title, $createAt, $updatedAt, $body)
{
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<h2>タイトル:' . $title . '</h2>';
    echo '<p>作成日:' . $createAt . '</p>';
    echo '<p>更新日:' . $updatedAt . '</p><br>';
    echo '<article style="background-color: aliceblue;">本文:<br>' . $body . '</article>';
}