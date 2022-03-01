<?php
$start = microtime(true);

require_once './vendor/autoload.php';
use Phpml\Math\Matrix;
$inverse = [];

for ($i = 0; $i < 1000000; $i++) {
    $matrix = new Matrix([
        [rand(1, 100000000), rand(1, 100000000), rand(1, 100000000)],
        [rand(1, 100000000), rand(1, 100000000), rand(1, 100000000)],
        [rand(1, 100000000), rand(1, 100000000), rand(1, 100000000)],
    ]);

    // 逆行列
    $inverse[$i] = $matrix->inverse()->toArray();
}
unset($inverse);
$end = microtime(true);
echo "Done" . PHP_EOL;

echo '処理時間:' . ($end - $start) . ' s' . PHP_EOL;