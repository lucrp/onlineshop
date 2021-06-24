# onlineshop
Site e-commerce en PHP sans framework et containers Docker (PostgreSQL, NGINX et PHP-FPM-Alpine)
Ce projet se base sur les vidéos de Thibaud Dauce sur YouTube dans la playlist https://www.youtube.com/playlist?list=PLMWEEzYqZ0em0jJa4LmQPjDqJNaApqKan

C'est un travail à finir et à améliorer.

## Prerequisites
- Docker

## Instructions

Pour installer:

1- Dans le dossier `docker-web`  créer un dossier `data` et un dossier `log` 

2- Aller dans le dossier docker-web/ et lancer les containers
` docker-compose up --build -d`

3 - Entrez dans le container `web-pgsql` et créez l'utilisateur `onlineshop`  avec le mot de passe ` onlineshop ` 

### Pour aller dans le container web-pgsql
`docker exec -it web-pgsql /bin/sh`

- Dans le container pour avoir accès au user `onlineshop` dans la base de données:
  `psql -U onlineshop`

- Pour lister les tables ( \dt ):
`onlineshop=# \dt`


### Pour créer/recréer la base de données:
- Rentrer dans le container web-php :
    `docker exec -it web-php /bin/sh` 

- Lancer le script
  `php /script/database/refresh.php` 

### Pour créer un nouveau admin
- Rentrer dans le container web-php :
  `docker exec -it web-php /bin/sh` 

- Lancer le script :
  `php /script/console/create_admin.php user password` 
  
  Exemple :
  `php /script/console/create_admin.php admin 123456` 