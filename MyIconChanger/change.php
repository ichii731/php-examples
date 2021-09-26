<?php
require('vendor/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$connection = new TwitterOAuth($_ENV['CK'], $_ENV['CS'], $_ENV['AT'], $_ENV['ATS']);
$img_arr = glob('imgs/*');
$connection->post('account/update_profile_image', ['image' => base64_encode(file_get_contents($img_arr[array_rand($img_arr, 1)]))]);