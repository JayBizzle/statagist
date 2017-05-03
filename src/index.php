<?php

require __DIR__.'/../vendor/autoload.php';

$climate = new League\CLImate\CLImate();

$packagist = new \Statagist\Packagist(new \GuzzleHttp\Client());

if (empty($argv[1])) {
    die($climate->backgroundRed()->white()->output('Please specify a package name'));
}

if (strpos($argv[1], '/') === false) {
    $options = $packagist->getPackagesByVendor($argv[1]);
    $input = $climate->radio('Select a package:', $options['packageNames']);
    $argv[1] = $input->prompt();
}

try {
    $package = $packagist->findPackageByName($argv[1]);

    $climate->br()->green()->bold()->flank("{$argv[1]}");

    $climate->white()->bold()->underline()->output('Downloads');
    $padding = $climate->padding(35);
    $padding->label('<yellow>Today</yellow>')->result(number_format($package['package']['downloads']['daily']));
    $padding->label('<yellow>Last 30 days</yellow>')->result(number_format($package['package']['downloads']['monthly']));
    $padding->label('<yellow>Total</yellow>')->result(number_format($package['package']['downloads']['total']));

    $climate->br();
} catch (Exception $e) {
    $climate->backgroundRed()->white()->output("No package called {$argv[1]} could be found.");
}
