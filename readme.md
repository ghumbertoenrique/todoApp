# Todo Laravel/Vue App

> Todo App Creada con una api Laravel API aprovechando resources como backend y Vuejs en el Frontend

## Quick Start

``` bash
# Instala las Dependencias del composer
composer install

# Corre las migraciones
php artisan migrate

# Agrega un Host virtual si usas apache

# Si te da un error de encryption key corre el siguiente comando
php artisan key:generate

# Instala las dependencias JS
npm install

# Corre la aplicacion Vue
npm run watch
```

## Endpoints

### Mostrar los todos los To Do
``` bash
GET api/todos
```
### Mostrar todo solo un To Do
``` bash
GET api/todo/{id}
```
### Crear todo
``` bash
POST api/todo
```
### Borrar Todo
``` bash
DELETE api/todo/{id}
```

### Modificar todo
``` bash
PUT api/todo
```


### Modificar estado
``` bash
PUT api/todo/{id}
```
```

## App Info

### Autor

Humberto Gonzalez

### Version

1.0.0
