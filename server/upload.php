<?php
session_start();
if(!isset($_SESSION['admin'])){http_response_code(403);exit;}
$dataFile=__DIR__.'/data.json';
$data=file_exists($dataFile)?json_decode(file_get_contents($dataFile),true):[];
$name=$_POST['name']??'';
if(!$name||!isset($_FILES['file'])){die('Paramètres manquants');}
$filename=basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.'/apps/'.$filename);
$scriptName='';
if(isset($_FILES['script'])&&$_FILES['script']['size']>0){
  $scriptName=basename($_FILES['script']['name']);
  move_uploaded_file($_FILES['script']['tmp_name'], __DIR__.'/scripts/'.$scriptName);
}
$data[]=['name'=>$name,'file'=>$filename,'script'=>$scriptName,'size'=>filesize(__DIR__.'/apps/'.$filename)];
file_put_contents($dataFile,json_encode($data,JSON_PRETTY_PRINT));
header('Location: admin.php?tab=apps');
