<?php
$dataFile = __DIR__ . '/data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

function findApp($name, $data){
  foreach($data as $app){
    if($app['name'] === $name) return $app;
  }
  return null;
}

$apps = [];
if(isset($_GET['app'])){
  $app = findApp($_GET['app'], $data);
  if($app) $apps[] = $app;
}
if(isset($_GET['multi'])){
  $names = explode(',', $_GET['multi']);
  foreach($names as $n){
    $app = findApp($n, $data);
    if($app) $apps[] = $app;
  }
}
if(!$apps){
  http_response_code(404);
  exit('Aucune application.');
}

$tmp = tempnam(sys_get_temp_dir(), 'apps');
$zip = new ZipArchive();
if($zip->open($tmp, ZipArchive::OVERWRITE) !== true){
  http_response_code(500);
  exit('Erreur lors de la création de l\'archive');
}
foreach($apps as $app){
  $zip->addFile(__DIR__.'/apps/'.$app['file'], $app['file']);
  if(!empty($app['script'])){
    $zip->addFile(__DIR__.'/scripts/'.$app['script'], $app['script']);
  }
}
$zip->close();
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="applications.zip"');
readfile($tmp);
unlink($tmp);
?>
