Quizzly
=======

A Symfony project created on May 29, 2018, 9:44 am.
"# ProjetSymphony" 

Git install:
http://msysgit.github.io

Travaillez sur votre propre branche en la "tirant" de la branche develop
git checkout -b origin develop

Pour pusher (uploader) vos modifications sur votre branche
git gui

Dans la fenetre en haut a gauche vous selectionnez les modifications a "commit" (enregistrer localement) qui se retrouve en bas a gauche
Pour commit on met un message commentaire et on clic sur commit
Puis si on veut uploader ses "commit" on clic sur Push


Demarrer le serveur:
php bin/console server:run


Generons la table correspondante dans la base :

php bin/console doctrine:schema:update --dump-sql

apres

php bin/console doctrine:schema:update --force



Datatable:
Si erreur "Fatal error: Allowed memory size of XXXXXXX bytes exhausted"
Modifier le php.ini (C:\wamp64\bin\php\php5.6.35)
memory_limit = -1