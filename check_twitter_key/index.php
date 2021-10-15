<?php
function getCSRFToken()
{
    $bytes = function_exists('random_bytes') ?
        random_bytes(48) : openssl_random_pseudo_bytes(48);
    $nonce = base64_encode($bytes);
    if (empty($_SESSION['csrf_tokens'])) {
        $_SESSION['csrf_tokens'] = [];
    }
    $_SESSION['csrf_tokens'][$nonce] = true;
    return $nonce;
}

session_start();
$token = getCSRFToken();
$token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Access Token確認ツール</title>
    <link rel="stylesheet" href="../frameworks/skeleton_custom.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<body>
    <div class="six columns">
        <h2>Twitter Access Token確認ツール</h2>
        <p>自分のAPIキーでアカウントのアクセストークンを取得するツールです. ここ最近TwitterDevの審査が大変なのでこのツールで発行できます.
        </p>
        <form action="login.php" method="POST">
            <label for="ck">API Key</label>
            <input class="u-full-width" type="password" id="ck" name="ck" required>
            <label for="cs">API Secret</label>
            <input class="u-full-width" type="password" id="cs" name="cs" required>
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>" required>
            <input type="checkbox" id="show" value="1">
            <span>テキスト内容を表示</span><br>
            <input class="button-primary" type="submit" value="確認する(ログイン)">
        </form>

        <div class="row">
            <h4>使い方</h4>
            <p>Callback URLを以下に指定して御利用ください.</p>
            <p style="word-wrap: break-word;"><b>https://tools.ic731.net/check_twitter_key/confirm.php</b></p>
            <img alt="コールバック指定" src="assets/callback.png" width="100%">
        </div>
        <br>
        <hr>
        <p style="margin-bottom: 20px;">© 2020-21 IchiiLab by 市井P All Rights Reserved.</p>
    </div>
    <script>
        const ck = document.getElementById("ck");
        const cs = document.getElementById("cs");
        const keysCheck = document.getElementById("show");
        keysCheck.addEventListener("change", function() {
            if (keysCheck.checked) {
                ck.setAttribute("type", "text");
                cs.setAttribute("type", "text");
            } else {
                ck.setAttribute("type", "password");
                cs.setAttribute("type", "password");
            }
        }, false);
    </script>
</body>

</html>