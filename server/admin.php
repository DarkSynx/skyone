<?php
session_start();
$configFile = __DIR__ . '/config.json';
$config = json_decode(file_get_contents($configFile), true);

if(isset($_POST['login'])){
  if($_POST['user'] === $config['adminUser'] && $_POST['pass'] === $config['adminPass']){
    $_SESSION['admin']=true;
    header('Location: admin.php');
    exit;
  }
  $error="Identifiants invalides";
}
if(isset($_GET['logout'])){
  session_destroy();
  header('Location: admin.php');
  exit;
}
if(!isset($_SESSION['admin'])):
?>
<!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><title>Connexion admin</title>
<style>body{background:#222;color:#eee;font-family:sans-serif;margin:20px;}input{margin:5px;}button{background:#444;color:#fff;padding:5px;border:none;}</style>
</head><body>
<h1>Connexion administrateur</h1>
<?php if(!empty($error)) echo '<p>'.$error.'</p>'; ?>
<form method="post">
<input name="user" placeholder="Utilisateur"><br>
<input name="pass" type="password" placeholder="Mot de passe"><br>
<button name="login">Connexion</button>
</form>
</body></html>
<?php exit; endif; ?>
<!DOCTYPE html><html lang="fr">
<head><meta charset="UTF-8"><title>Admin</title>
<style>body{background:#222;color:#eee;font-family:sans-serif;margin:20px;}nav a{margin-right:10px;color:#0bf;}input,button{margin:5px;}button{background:#444;color:#fff;border:none;padding:5px 10px;}</style>
</head>
<body>
<nav>
<a href="admin.php?tab=apps">Applications</a>
<a href="admin.php?tab=add">Ajouter</a>
<a href="admin.php?logout=1">Quitter</a>
</nav>
<?php $tab=$_GET['tab']??'apps'; if($tab==='add'): ?>
<h2>Ajouter une application</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Nom"><br>
<input type="file" name="file"><br>
<label>Script install.bat :</label><input type="file" name="script"><br>
<button>Envoyer</button>
</form>
<?php else: ?>
<iframe src="index.php" style="width:100%;height:600px;border:1px solid #333;"></iframe>
<?php endif; ?>
</body></html>
