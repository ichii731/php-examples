<?php
// cUrlでAPIを叩く
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://***************.microcms.io/api/v1/news');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$headers[] = 'X-Api-Key: **************************************';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// 取得したら表示
$result = json_decode($response, true);
foreach ($result['contents'] as $contents) {
    $url = 'https://0115765.com/samples/php/MicroCMS_Content.php?id=' . $contents['id'];
    ShowHtml(
        $contents['title'],
        $contents['createdAt'],
        $url
    );
}

function ShowHtml($title, $createAt, $url)
{
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<h2>タイトル:' . $title . '</h2>';
    echo '<p>作成日:' . $createAt . '</p>';
    echo '<p>URL: <a href="' . $url . '">' . $url . '</a></p><hr>';
};