# Job App
Job App est une application d'offres d'emploi réalisée avec symfony

## Requirements

- php : ^7.4
- Symfony : ^5.4
- composer
- node avec (yarn ou npm)

## Installation
```bash
 git clone https://github.com/moussazoungrana/job-offer-app.git
 composer install
 yarn (ou npm install)
```
Vous devez modifier la variable .env pour l'adapter à votre environnement.

Ensuite Vous devez créer votre base de donnée et lancer les migrations
```bash
  php bin/console doctrine:database:create
  php bin/console doctrine:migrations:migrate
```

## Usage

Vous pouvez maintenant lancer l'application avec cette commande
```bash
  php -S localhost:8000 -t public
```
Ensuite, vous compilez les assets
```bash
  yarn dev-server
```

Et vous pouvez ensuite accéder à l'application en allant à l'url http://localhost:8000/ dans votre navigateur

## Administration

L'administration permet la gestion de l'application et pour y accéder il faut aller à l'url http://localhost:8000/admin , 
mails il faut être authentifié pour pouvoir avoir l'accès.

Pour cela on créer une fixture qui permet de générer un utilisateur par défaut.  

Vous pouvez la lancer avec cette commande : 
```bash
  php bin/console doctrine:fixtures:load --append
```

Vous pouvez maintenant vous connecter.

email : admin@admin.com  
password : admin


Il ne vous reste maintenant qu'à créer vos offres d'emploi qui seront visible pour toute le monde

Félicitations !!!!




