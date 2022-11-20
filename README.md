
# App fullstack - challenge




## Install backend 

. Laravel 8
. PHP 7.4 - 8

#### 1) Composer
```bash
  composer install

  composer dumpautoload

``` 

#### 2) Server
#### With Laravel server
```bash
  php artisan serve --port={port}

  Example: php artisan serve --port=8080
```
#### With PHP server
```bash
  php -S localhost:{port}

  Example: php -S localhost:8080
``` 

#### With Wampp software
##### After configuring the local host
```bash
  backend-stations/plublic/index.php
``` 

## Install Frontend

. Nodejs 14
. Vuejs 2
. Axios

#### Install dependencies
```bash
  npm install

  npm run serve -- --port {port}

  Example: npm run serve -- --port 4000
``` 
## API Reference

#### Get stations and localizations

```http
  GET /api/v01/stations/localization
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |



#### List stations

```http
  GET /api/v01/stations/list
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Lista all stations

```http
  GET /api/v01/stations/listAll
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |


```http
  GET /api/v01/stations/localizationId/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `int` | **Required** |


```http
  GET /api/v01/stations/detail/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `int` | **Required**.|