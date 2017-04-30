<?php

require __DIR__.'/../vendor/autoload.php';

$c = new \Colors\Color();
$packagist = new \Spatie\Packagist\Packagist(new \GuzzleHttp\Client());

$package = $packagist->findPackageByName($argv[1]);

echo $c($argv[1])->white()->bold()->highlight('green') . PHP_EOL;

echo $c('Downloads')->white()->bold() . PHP_EOL;

echo $c(' - Total: ')->yellow()->bold();
echo $c($package['package']['downloads']['total'])->white()->bold() . PHP_EOL;

echo $c(' - Monthly: ')->yellow()->bold();
echo $c($package['package']['downloads']['monthly'])->white()->bold() . PHP_EOL;

echo $c(' - Daily: ')->yellow()->bold();
echo $c($package['package']['downloads']['daily'])->white()->bold() . PHP_EOL;