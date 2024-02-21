# LIVE Search of SQL databse with JQuery
---
#### English

Live search project for a SQL table with JQuery in a text field that searches for city information from different cities.

## Database connection

First you need to create a database such as MariaDB and place the connection parameters in the files:

`index.php`
```php
$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "toor";
$DATABASE_NAME = "ajax";
```
`ajaxrequest.php`
```php
$mysqli = new mysqli("localhost", "root", "toor", "ajax");
```
For both cases, the name of the parameters must match.

## Create table
The table that will be used is created with the sql script in the `table.sql` file
```sql
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `city` varchar(30) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `iso2` varchar(10) DEFAULT NULL,
  `iso3` varchar(10) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
```
And the data from the `data.sql` or `cities.csv` file must be imported, in the way that is most comfortable for you, both cases are the same information.

## Run proyect

To run the project you must execute the command `php -S localhost:8000` and go to the browser by entering the URL `http://localhost:8000/index.php` and you will be able to search for information from the table you just created.

---
#### Español
Proyecto de busqueda en vivo de una tabla SQL con JQuery en un campo de texto que busca informacion de ciudades de diefentes ciudades.

## Conexión a la base de datos

Primero necesitas crear una base de datos como por ejemplo en MariaDB y colocar los parámetros de conexión en los archivos:

`index.php`
```php
$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "toor";
$DATABASE_NAME = "ajax";
```

`ajaxrequest.php`
```php
$mysqli = new mysqli("localhost", "root", "toor", "ajax");
```
Para ambos casos, el nombre de los parámetros tienen que coincidir.

## Crear tabla
La tabla que se usara se crea con el script sql en el archivo `table.sql`
```sql
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `city` varchar(30) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `iso2` varchar(10) DEFAULT NULL,
  `iso3` varchar(10) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
```
Y se deberán importar los datos del archivo `data.sql` o `cities.csv`, de la forma que le sea más cómoda ambos casos es la misma información.

## Correr el proyecyo
Para ejecutar el proyecto deberá ejecutar el comando `php -S localhost:8000` y dirigirse al navegado colocando la URL `http://localhost:8000/index.php` podrá buscar información de la tabla que acaba de crear.