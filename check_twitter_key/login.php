<?php
require_once "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

function validateCSRFToken($token)
{
    if (isset($_SESSION['csrf_tokens'][$token])) {
        unset($_SESSION['csrf_tokens'][$token]);
        return true;
    }

    return false;
}

session_start();
$callback = 'https://tools.ic731.net/check_twitter_key/confirm.php';

if (isset($_POST['csrf_token']) && validateCSRFToken($_POST['csrf_token'])) {
    $ck = htmlspecialchars($_POST['ck']);
    $cs = htmlspecialchars($_POST['cs']);
    $_SESSION['ck'] = $ck;
    $_SESSION['cs'] = $cs;
    try {
        $connection = new TwitterOAuth($ck, $cs);
        $request = $request_token = $connection->oauth('oauth/request_token', ['oauth_callback' => $callback]);
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $connection->url('oauth/authenticate', ['oauth_token' => $request_token['oauth_token']]);
        header('location: ' . $url);    
    } catch (\Throwable $th) {
        error();
    }
} else {
    error();
}

function error(){
    echo <<<EOM
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h3>アクセスエラー</h3>
    <p>以下のことが考えられます.トップへお戻りください.</p>
    <ul>
        <li>このページに直接アクセスした</li>
        <li>CallbackのURLが間違っている</li>
        <li>APIキーの入力ミス</li>
        <li>CSRFトークンが不正</li>
    </ul>
    EOM;
}