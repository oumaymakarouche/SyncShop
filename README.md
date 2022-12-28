# SyncShop
Cette application est développée avec Symfony 6, un framework PHP open-source pour développer des applications web professionnelles de manière rapide et sécurisée.
## Prérequis
PHP Version 8.1 <a href="https://www.php.net/manual/fr/install.php">Installer PHP </a><br>
MySQL  Installer MySQL<br>
Symfony version 6.0  avec le CLI(Binaire) <a href="https://symfony.com/doc/current/setup.html" >Installer Symfony</a>-- <a href="https://symfony.com/download"> Installer Binaire Symfony</a><br>
Composer  <a href="https://getcomposer.org/download/"> composer installer </a> <br>


## Installer depuis GitHub
```
$ git clone https://github.com/oumaymakarouche/SyncShop.git
$ cd SyncShop
```

## Installation
Taper les commandes dans votre terminal

1 ```composer install``` afin d'installer toutes les dépendances composer du projet. <br>
2 Installer la base de donnée MySQL. Pour paramétrer la création de votre base de donnée, rdv dans le fichier .env du projet, et modifier la variable d'environnement selon vos paramètres : <br>

```DATABASE_URL=mysql://User:Password@127.0.0.1:3306/nameDatabasse?serverVersion=5.7``` <br>
3 Puis exécuter la création de la base de donnée avec la commande : ```symfony console doctrine:database:create``` <br>

5 Exécuter la migration en base de donnée : ```symfony console doctrine:migration:migrate``` <br>
6 Vous pouvez maintenant accéder à votre portfolio en vous connectant au serveur : ```symfony server:start```<br>

## Démarrage
Vous êtes prêt à partir, il suffit d'ouvrir le site avec votre navigateur préféré !