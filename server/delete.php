<?php
session_start();
if(!isset($_SESSION['admin'])){
    http_response_code(403);
    exit('Accès interdit');
}

$name = $_GET['app'] ?? '';
if($name === ''){
    http_response_code(400);
    exit('Paramètre manquant');
}

$dataFile = __DIR__ . '/data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
$newData = [];
$deleted = false;
foreach($data as $app){
    if($app['name'] === $name){
        $deleted = true;
        @unlink(__DIR__.'/apps/'.$app['file']);
        if(!empty($app['script'])){
            @unlink(__DIR__.'/scripts/'.$app['script']);
        }
        continue;
    }
    $newData[] = $app;
}
if($deleted){
    file_put_contents($dataFile, json_encode($newData, JSON_PRETTY_PRINT));
}
header('Location: admin.php?tab=apps');

