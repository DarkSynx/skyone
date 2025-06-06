<?php
session_start();
$dataFile = __DIR__ . '/data.json';
$configFile = __DIR__ . '/config.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
$config = file_exists($configFile) ? json_decode(file_get_contents($configFile), true) : [];
$isAdmin = isset($_SESSION['admin']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Bibliothèque d'applications</title>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
body{background:#222;color:#eee;font-family:sans-serif;margin:20px;}
table.dataTable thead{background:#333;color:#eee;}
button{background:#444;color:#fff;padding:5px 10px;border:none;border-radius:4px;}
</style>
</head>
<body>
<h1>Gestionnaire d'applications</h1>
<table id="apps" class="display">
<thead>
<tr><th></th><th>Nom</th><th>Taille</th><th></th><?php if($isAdmin) echo '<th>Supprimer</th>'; ?></tr>
</thead>
<tbody>
<?php foreach($data as $app): ?>
<tr>
<td><input type="checkbox" name="select" value="<?= htmlspecialchars($app['name']) ?>"></td>
<td><?= htmlspecialchars($app['name']) ?></td>
<td><?= number_format($app['size']/1024,2).' Ko' ?></td>
<td><a href="download.php?app=<?= urlencode($app['name']) ?>"><button>Installer</button></a></td>
<?php if($isAdmin): ?>
<td><a href="delete.php?app=<?= urlencode($app['name']) ?>" onclick="return confirm('Supprimer ?');"><button>Supprimer</button></a></td>
<?php endif; ?>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button id="downloadAll">Télécharger la sélection</button>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
  var table=$('#apps').DataTable({"order":[[1,"asc"]]});
  $('#downloadAll').on('click',function(){
    var names=[];
    table.$('input[name=select]:checked').each(function(){names.push($(this).val());});
    if(names.length){
      window.location='download.php?multi='+encodeURIComponent(names.join(','));
    }
  });
});
</script>
</body>
</html>
