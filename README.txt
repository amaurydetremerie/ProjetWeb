A faire au début :
Ouvrir Wamp


Ouvrir phpMyAdmin
Nouvelle bdd qui s'appelle classnotfound en utf8_general_ci
importer classnotfound.sql
importer insertion_db.sql


décommenter la dernière ligne de index.php (echo realpath)
Ouvrir localhost et copier le lien absolu du fichier
mettre à jour les .htaccess dans les dossier (config, controllers, models)
commenter la dernière ligne de index.php (echo realpath)
.htpasswd : utilisateur : admin et mdp : admin


Répertoire views non protégé par .htaccess car trop compliqué de mettre en place les exception pour les images ET le css.
Si c'est que pour l'un ou pour l'autre, c'est faisable.
Order deny,allow
Deny from all

<Files "images">
  Order allow,deny
  Allow from all
</Files>


On a fait le choix qu'un admin peut éditer une question qui ne lui appartient pas


MDP des utilisateurs du script : abc
    admin actif : jimmy.fallon@gmail.com
    admin inactif : utilisateur@gmail.com
    utilisateur inactif : jetetr0ll@gmail.com
    utilisateur actif : espace@gmail.com