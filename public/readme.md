# ECF DIETETIQUE
## Démarche pour l'installer en Local
***

**Récupérer les datas :**
https://github.com/JeanMarcB-studi/dietetic.git

Cliquer sur le bouton : [<> Code]  > Download ZIP
Copier le répertoire diete et tout son contenu sur un ordinateur.

**Installations**

Installer PHP si pas déjà fait :
https://www.apachefriends.org/fr/index.html 

Installer Composer si pas déjà fait :
https://getcomposer.org/download/

Installer Symfony si pas déjà fait :
https://symfony.com/download 

Création des dépendances :
```composer install```

Créer une base de données « dietetic » ou autre dans mySQL ou MariaDB…
Entrer les informations du setup dans un fichier .env.local à situer à la racine, 
>ex de paramétrage local en fonction de votre environnement :
DATABASE_URL="mysql://root:@127.0.0.1:3306/dietetic?serverVersion=mariadb-10.4.25&charset=utf8mb4"
APP_ENV=dev

Lancer les serveurs apache et mysql

Lancer symphony:
```symfony server:start```

Créer les tables dans votre base de donnée :
```php bin/console doctrine:migrations:migrate```

Vérifier avec PHP myAdmin que les tables suivantes ont bien été créées :
*	allergene
*	note 
*	recette 
*	recette_allergene 
*	recette_regime 
*	regime 
*	user 
*	user_allergene 
*	user_regime
*	meal 

**Charger des données**
Un jeu de données est fourni, exécuter dans mySQL le fichier SQL fourni dans le dossier « Public » :
game_set.sql

Diverses données seront créées, incluant un compte administrateur pour la gestion du backoffice.
Se connecter alors sur la page de Symfony, le site de Diététique devrait apparaître. 

**Important**
Pour se logger en tant que Admin et voir ainsi la partie des CRUD, cliquer sur l’icône de connexion en haut à droite de la page et saisir :
Email : 	admin@test.com
mot de passe : voir le document ECF rendu