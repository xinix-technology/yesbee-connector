<?php

namespace Test;

require '../vendor/autoload.php';

use Yesbee\Yesbee;
use Guzzle\Http\Client;

// ------- POST method with headers
// $client = Yesbee::factory('http://localhost');
// $response = $client->post('/a.php')->header('anu', 'gemes')->header(array('itu' => 'ituan', 'ngeng' => 'ngong'))->send();
// $response = $client->header('anu', 'gemes')->header(array('itu' => 'ituan', 'ngeng' => 'ngong'))->send('/a.php');
// print_r($response->json());

// -------
// $client = new Client();
// $req = $client->put('http://localhost/a.php', array('body' => array('a' => 'anu')));
// $response = $client->send($req);
// print_r($response->json());

// -------
// $client = Yesbee::factory(array('base_url' => 'http://httpbin.org'));
// $response = $client->get()->send('/get');
// print_r($response->json());

// -------
// $client = Yesbee::factory(array('base_url' => 'http://localhost'));
// $response = $client->post()->exchange(array('name' => 'Farid Hidayat', 'age' => 26))->send('/a.php');
// print_r($response->json());



// $client = new Client();

// $req = $client->get('http://localhost/a.php', array(), array('a' => 'anu', 'b' => 'bau'));
// print_r($client->send($req)->json());

$client = Yesbee::factory('http://localhost');
$res = $client->exchange(array('a' => 'anu', 'b' => 'bau'))->send('/a.php');
print_r($res->json());