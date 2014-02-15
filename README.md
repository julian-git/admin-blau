## L'Admin Blau

L'Admin Blau és un gestor de les dades de la colla dels Castellers de la Vila de Gràcia (CVG). 

Està basat en els frameworks Laravel [![Latest Stable Version](https://poser.pugx.org/laravel/framework/version.png)](https://packagist.org/packages/laravel/framework) i Bootstrap (https://github.com/twbs/bootstrap/).

### Contribuir a l'Admin Blau

**Tots els errors trobats i funcionalitats noves desitjades es poden indicar al repositori [admin-blau](https://github.com/julian-git/admin-blau/issues)**

### Llicència

L'Admin Blau és programari lliure, llicenciat amb la llicència [GPL v3](https://www.gnu.org/licenses/gpl.html).

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


## Installation

This installation process is adapted from http://daylerees.com/codebright/getting-started .

* Install git, php, mysql.

* Create a mysql user. Log into mysql using ```mysql -u root -p``` and say
```
create user 'admin_blau'@'localhost' identified by 'admin_blau';
grant all on admin_blau.* to 'admin_blau'@'localhost';
create database admin_blau;
```

* Clone the Laravel framework via ```git clone https://github.com/laravel/laravel.git admin-blau/```

* Install [PHP Composer](https://getcomposer.org/download/)

* Inside ```admin_blau/```, run ```php /your/path/to/composer.phar install```

* Rename git origins:
```
    git remote rename origin laravel
    git remote add origin https://github.com/julian-git/admin-blau.git
```

* Edit ```.git/config``` to say
```
[branch "master"]
        remote = origin 
        merge = master
```

* Say 
```
git rm artisan
git commit -am "artisan"
rm composer.lock
```

* Say 
```
git pull -s recursive -X theirs
```

* Say
```
php artisan migrate:install
php artisan migrate
```

* To use the app, open a new shell and say 
```
php artisan serve
``` 
then open your browser to ```http://localhost:8000```
