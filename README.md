# Fundación Piedra Libre

Sitio web institucional sobre la fundacion piedra libre.


# Dependencias

Git : https://git-scm.com/downloads

Git ftp : https://github.com/git-ftp/git-ftp

node & npm : https://nodejs.org/en/download/

# Levantar el proyecto

Con un servidor local, sea: [MAMP (mac)](https://www.mamp.info/en/) , [XAMP](https://www.apachefriends.org/es/index.html) o [WAMP](http://www.wampserver.com/en/) (windows)

Clonar el repo dentro de la carpeta a la que apunta tu localhost:

``
$ git clone https://github.com/castiarena/piedra-libre.git
``

O por ssh, si esta configurada tu cuenta de git con tu key de ssh local

``
$ git clone git@github.com:castiarena/piedra-libre.git
``

Crear la base de datos en localhost y cargarle a la base de datos la estructura, corriendo el sql dentro de tu phpMyAdmin (http://localhost/phpMyAdmin (copiar y pegar el sql en la solapa de sql)
https://github.com/castiarena/piedra-libre/blob/develop/application/config/.dump-db


Correr http://localhost/piedra-libre/


