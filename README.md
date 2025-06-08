# Skyone

Ce répertoire contient deux parties :

* `server` : une petite application PHP pour gérer et télécharger des programmes.
* `client` : un client Electron qui ouvre automatiquement la page serveur.

## Lancement rapide du serveur

```
php -S 0.0.0.0:8080 -t server
```

Créez d'abord les dossiers `server/apps` et `server/scripts` pour stocker les fichiers téléversés.

Puis accédez à `http://localhost:8080/index.php` ou `http://localhost:8080/admin.php` pour la partie administration. L'interface d'administration permet maintenant de supprimer les applications existantes.

## Client Electron

Avant de lancer le client, vous pouvez personnaliser l'URL du serveur en définissant la variable d'environnement `SKYONE_URL`.
Par défaut le client ouvre `http://localhost:8080/index.php`.

Voir les instructions dans `client/README.md`.
