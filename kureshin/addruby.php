<?php
$ch = curl_init();
$apikey = '';
$sentence = htmlspecialchars($_GET['sentence']);

if (!$sentence) {
    echo 'エラー';
    exit;
}

$jayParsedAry = [
    'id' => '1234-1',
    'jsonrpc' => '2.0',
    'method' => 'jlp.furiganaservice.furigana',
    'params' => [
        'q' => $sentence,
        'grade' => 2
    ]
];

// CURLでリクエスト
curl_setopt($ch, CURLOPT_URL, 'https://jlp.yahooapis.jp/FuriganaService/V2/furigana');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jayParsedAry, JSON_UNESCAPED_UNICODE));

$headers = [];
$headers = [
    'Content-Type: application/json',
    'User-Agent: Yahoo AppID: ' . $apikey
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result, true);

$surface = '';
// 各配列のsurfaceを結合
foreach ($result['result']['word'] as $value) {
    if (isset($value['furigana'])) {
        // もし["subword"]があればforeachで繰り返して結合
        if (isset($value['subword'])) {
            foreach ($value['subword'] as $subvalue) {
                // furiganaとsurfaceが同値だったら結合しない
                if ($subvalue['furigana'] === $subvalue['surface']) {
                    $surface .= $subvalue['furigana'];
                } else {
                    $surface .= '<ruby>' . $subvalue['surface'] . '<rt>' . $subvalue['furigana'] . '</rt></ruby>';
                }
            }
        } else {
            $surface .= '<ruby>' . $value['surface'] . '<rt>' . $value['furigana'] . '</rt></ruby>';
        }
    } else {
        $surface .= $value['surface'];
    }
}

echo $surface;
