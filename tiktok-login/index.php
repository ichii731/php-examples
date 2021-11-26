<?php
require("vendor/autoload.php");

use gimucco\TikTokLoginKit;

session_start();
$client_id = "****************";
$client_secret = "**************************************";
$callback = "https://tools.ic731.net/tiktok/index.php";
$_TK = new TikTokLoginKit\Connector($client_id, $client_secret, $callback);
if (TikTokLoginKit\Connector::receivingResponse()) {
	try {
		$token = $_TK->verifyCode($_GET[TikTokLoginKit\Connector::CODE_PARAM]);
		// Your logic to store the access token
		$user = $_TK->getUserInfo()->data;
		// Your logic to manage the User info
		$return_html = <<< EOM
		<a href="$user->avatar_larger"><img class="avatar" src="$user->avatar_larger"></a>
		<p style="font-size:2rem;"><b>$user->display_name</b></p>
		<p>Open_ID:$user->open_id / Union_ID:$user->union_id</p>
		EOM;
		// Get directly from the returned data
		//var_dump($user->data);

	} catch (Exception $e) {
		$err = $e->getMessage();
		$return_html = <<<EOM
		<img src="tiktok.png" class="brand" alt="brand icon">
		<h1>TikTok Login Demo</h1>	
		<p><b>[Error]</b> $err</p>
		<div class="login-area" style="width: 150px;">
			<a class="social-button tiktok"  href="/tiktok">
				<div class="icon">
					<i class="fab fa-tiktok"></i>
				</div>
				<div class="box-text">
				Retry
				</div>
			</a>
		</div>
		EOM;
	}
} else {
	
	$redirect = $_TK->getRedirect();
	$return_html = <<<EOM
	<img src="tiktok.png" class="brand" alt="brand icon">
	<h1>TikTok Login Demo</h1>
	<div class="login-area">
		<a class="social-button tiktok" href="$redirect">
			<div class="icon">
				<i class="fab fa-tiktok"></i>
			</div>
			<div class="box-text">
			Log in with TikTok
			</div>
		</a>
	</div>
	EOM;
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<title>TikTok Login Demo</title>
</head>

<body>
	<?php echo $return_html; ?>
	<div class="dev">
		<p> Dev by <a href="https://twitter.com/ichii731" target="_blank" rel="noopener noreferrer">@ichii731</a>
		</p>
		<a href="http://" target="_blank" rel="noopener noreferrer">Sample Code on GitHub</a>
	</div>
</body>

</html>