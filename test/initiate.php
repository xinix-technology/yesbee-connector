<?php

namespace Test;

require '../vendor/autoload.php';

use Yesbee\Yesbee;

$client = Yesbee::factory(array('base_url' => 'http://localhost/mcoin/yesbee-connector/test'));
$response = $client->get()->exchange(array('store_id' => 'xyz', 'api_token' => 'xxx', 'amount' => '123456'))->send('/checkout.php');

$parameter = $response->json();
include('generate.php');