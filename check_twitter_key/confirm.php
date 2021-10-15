<?php

session_start();
require_once 'vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

try {
    $request_token['oauth_token'] = $_SESSION['oauth_token'];
    $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

    $connection = new TwitterOAuth($_SESSION['ck'], $_SESSION['cs'], $request_token['oauth_token'], $request_token['oauth_token_secret']);
    $token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

    $status = "正常に取得が完了しました.<br>文字列をタップするとコピーされます.";
    $clipboard = "new ClipboardJS('.copy');";
    $info = ["at" => $token['oauth_token'], "ats" => $token['oauth_token_secret'], "id" => $token['user_id'], "name" => $token['screen_name']];
    session_destroy();
} catch (\Throwable $th) {
    $status = "取得に失敗しました.安全のため,セッションは更新すると削除されます.";
    $clipboard = "";
    $info = ["at" => " - - ", "ats" => " - - ", "id" => " - - ", "name" => " - - "];
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccessToken取得結果</title>
    <link rel="stylesheet" href="../frameworks/skeleton_custom.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <style>
        .copy:hover {
            background: #f2fafc;
        }

        .copy {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="six columns">
        <h2>Twitter Access Token確認ツール</h2>
        <p>自分のAPIキーでアカウントのアクセストークンを取得するツールです. ここ最近TwitterDevの審査が大変なのでこのツールで発行できます.
        </p>
        <h4>取得結果</h4>
        <p>ステータス:<?=$status;?></p>
        <table class="u-full-width" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 20%">項目</th>
                    <th>値</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>AccessToken</td>
                    <td class="copy" data-clipboard-text="<?=$info["at"];?>"><?=$info["at"];?></td>
                </tr>
                <tr>
                    <td>AccessTokenSecret</td>
                    <td class="copy" data-clipboard-text="<?=$info["ats"];?>"><?=$info["ats"];?></td>
                </tr>
                <tr>
                    <td>UserID</td>
                    <td class="copy" data-clipboard-text="<?=$info["id"];?>"><?=$info["id"];?></td>
                </tr>
                <tr>
                    <td>ScreenName</td>
                    <td class="copy" data-clipboard-text="<?=$info["name"];?>"><?=$info["name"];?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <hr>
        <p style="margin-bottom: 20px;">© 2020-21 IchiiLab by 市井P All Rights Reserved.</p>
    </div>
    <script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>
    <script><?=$clipboard;?></script>
</body>

</html>
