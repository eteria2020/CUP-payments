<?php

$loader = include __DIR__ . '/../vendor/autoload.php';

// autoload mock class needed for Payment tests
$loader->addPsr4('Payments\\PaymentRequest\\', __DIR__ . '/Payments/PaymentRequest/');
