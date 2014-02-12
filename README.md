## L'Admin Blau

L'Admin Blau és un gestor de les dades de la colla dels Castellers de la Vila de Gràcia (CVG). 

Està basat en els frameworks Laravel [![Latest Stable Version](https://poser.pugx.org/laravel/framework/version.png)](https://packagist.org/packages/laravel/framework) i Bootstrap (https://github.com/twbs/bootstrap/).

### Contribuir a l'Admin Blau

**Tots els errors trobats i funcionalitats noves desitjades es poden indicar al repositori (https://github.com/julian-git/admin-blau)**

### Licència

L'Admin Blau és programari lliure, licenciat amb la licència GPL v3.

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


## INSTALLATION

This installation process is adapted from (http://daylerees.com/codebright/getting-started).

1. Install git, php, mysql.

2. Create a mysql user. Log into mysql using ```mysql -u root -p``` and say
```
create user 'admin_blau'@'localhost' identified by 'admin_blau'
grant all on admin_blau.* to 'admin_blau'@'localhost'
```

3. Clone the Laravel framework
    git clone https://github.com/laravel/laravel.git myadmin-blau/

4. Install PHP Composer from (https://getcomposer.org/download/)

5. Run
    php /path/to/composer.phar install 

6. Rename git origins:
    git remote rename origin laravel
    git remote add origin git@github.com:julian-git/admin-blau.git

7. Edit ```.git/config``` to say
```
[branch "master"]
        remote = origin 
        merge = master
```

8. ```rm composer.lock```

9. ```git pull```

10. Fix merge conflicts in ```app/routes.php, app/lang/en/validation.php, app/config/database.php, app/config/app.php, .gitignore``` leaving always the part between ```========``` and ```>>>>>>>>>```


To use the app, open a shell and say 
    php artisan serve

then open your browser to ```http://localhost:8000```
