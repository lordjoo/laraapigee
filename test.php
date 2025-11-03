<?php

require_once __DIR__.'/vendor/autoload.php';


$xConfigStaticDriver = new \Lordjoo\LaraApigee\ConfigReaders\ConfigStaticDriver();
$xConfigStaticDriver
    ->setEndpoint('https://sa-apigee.googleapis.com/v1')
    ->setOrganization('prj-sia-cloudypedia')
    ->setKeyFile(__DIR__.'/key.json');

$edgeConfigStaticDriver = new \Lordjoo\LaraApigee\ConfigReaders\ConfigStaticDriver();
$edgeConfigStaticDriver
    ->setEndpoint("http://34.55.190.84:8080/v1")
    ->setOrganization("playground")
    ->setUserName('opdk@apigee.com')
    ->setPassword('Apigee123!');
$apigeeEdge = new \Lordjoo\LaraApigee\Api\Edge\Edge($edgeConfigStaticDriver);
$apigeeX    = new \Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX($xConfigStaticDriver);

$app = $apigeeX->apps()->find("1142418e-28f3-471f-95f2-4614cc868efc");
dump($app);
