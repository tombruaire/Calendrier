# Gestion d'un calendrier dynamique
# Insertion, modification et suppression d'un évènement

Pour pouvoir utiliser le projet

# 1 - Prérequis
-> Avoir PHP 7.4.0 ou plus d'installer<br>
-> Avoir composer d'installer

# 2 - Chargement la base de données 
Charger et connecter la base de données -> calendar.sql

# 3 - Connection au serveur interne de PHP
1) Placer le dossier dans le dossier du serveur local en question (www ou htdocs)
2) Ouvrir cmd depuis ce dossier (à l'aide du chemin d'accès)
3) Taper la commande : php -S localhost:8000 -d dispay_errors=1 -t public

Ce qui donnera l'adresse url suivante : http://localhost:8000/index.php

Pour se déconnecter du serveur interne de PHP : ctrl + C

# 4 - Modification du fichier composer.json (facultatif)
S'il y a eu modification du fichier composer.json

Depuis le terminal (cmd) :
1) Taper la commande : composer dump-autoload
3) Se reconnecter au serveur interne de PHP : php -S localhost:8000 -d display_errors=1 -t public

# Droit d'auteur
&copy; Copyright 2021 | By Tom BRUAIRE<br>
Tout droits réservés
