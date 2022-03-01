<?php
require_once './vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

$start = microtime(true);

// 100回繰り返し
for ($i = 0; $i < 100; $i++) {
    $result = Builder::create()
        ->writer(new PngWriter())
        ->data(bin2hex(random_bytes(256)))
        ->build();
    $result->saveToFile('./tmp/qr_' . $i . '.png');
}

$end = microtime(true);
echo "Done" . PHP_EOL;

echo '処理時間:' . ($end - $start) . ' s' . PHP_EOL;
