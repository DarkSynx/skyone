# Skyone

Ce répertoire contient deux parties :

* `server` : une petite application PHP pour gérer et télécharger des programmes.
* `client` : un client Electron qui ouvre automatiquement la page serveur.

## Lancement rapide du serveur

```
php -S 0.0.0.0:8080 -t server
```

Puis accédez à `http://localhost:8080/index.php` ou `http://localhost:8080/admin.php` pour la partie administration. L'interface d'administration permet maintenant de supprimer les applications existantes.

## Client Electron

Voir les instructions dans `client/README.md`.
