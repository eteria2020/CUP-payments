<?php

$loader = include __DIR__ . '/../vendor/autoload.php';

// autoload mock class needed for Payment tests
$loader->addPsr4('MvlabsPayments\\PaymentRequest\\', __DIR__ . '/MvlabsPayments/PaymentRequest/');
