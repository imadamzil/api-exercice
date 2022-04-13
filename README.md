API Exercice | Users - Groups

technologies utilisé : 
php 7.2
symfony 4.2
api-platform
mysql 5.7

Après avoir clôné ce repository, modifiez le fichier .env et remplacer la ligne ci-dessous par votre accès à la base de données

```yml
DATABASE_URL=mysql://root:@127.0.0.1:3306/api-exercice
```
Pour installer les différents packages nécessaire au fonctionnement de l'application

```powershell
$ composer install
```
Lancez le serveur

```powershell
$ php bin/console server:run
```
Générez la base de données 
```powershell
$  php bin/console doctrine:database:create --env=test
$  php bin/console doctrine:migrations:migrate --env=test
$  php bin/console doctrine:database:create
$  php bin/console doctrine:migrations:migrate


```
Générez les fixtures

```powershell
$ php bin/console doctrine:fixtures:load --append
$ php bin/console doctrine:fixtures:load --env=test
```
run tests 
```powershell
$  php bin/phpunit

```
acceder à la doc de l'api via le lien 
```powershell
http://127.0.0.1:8000/api

```
admin account

email : admin@admin.com
password: admin

