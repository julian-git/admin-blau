## L'Admin Blau

L'Admin Blau és un gestor de les dades de la colla dels Castellers de la Vila de Gràcia (CVG). 

Està basat en els frameworks Laravel [![Latest Stable Version](https://poser.pugx.org/laravel/framework/version.png)](https://packagist.org/packages/laravel/framework) i Bootstrap (https://github.com/twbs/bootstrap/).

### Contribuir a l'Admin Blau

**Tots els errors trobats i funcionalitats noves desitjades es poden indicar al repositori [admin-blau](https://github.com/julian-git/admin-blau/issues)**

### Llicència

L'Admin Blau és programari lliure, llicenciat amb la llicència [GPL v3](https://www.gnu.org/licenses/gpl.html).

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Installation

* Install git, php, mysql.

* Download this repository using ```git clone https://github.com/julian-git/admin-blau```. This will put all files into a new subdirectory ```admin-blau``` inside the directory you called ```git clone``` from.


* Edit ```.git/config``` to say
```
[branch "master"]
        remote = origin 
        merge = master
```

* Create a mysql user. Log into mysql using ```mysql -u root -p``` and say
```
create user 'admin_blau'@'localhost' identified by 'admin_blau';
grant all on admin_blau.* to 'admin_blau'@'localhost';
create database admin_blau;
```

* Say
```
php artisan migrate:install
php artisan migrate
php artisan db:seed
```

* To use the app, open a new shell and say 
```
php artisan serve
``` 
then open your browser to ```http://localhost:8000```

### Com canviar les versions de Bootstrap i jQuery

Les versions utilitzades en aquests moments són la Bootstrap 3.1.0 i jQuery 1.11.0.
Aquests components estan ubicats a public/components amb els noms genèrics, sense la versió. En cas de voler canviar la versió, només cal sobreescriure els components actuals.

