### Installing

```
docker-compose build
```

### Start

```
docker-compose up
```
## Project

Simple example of CQRS with DDD, implemented in easy way Exchange Rate API

To update a Exchange, simple patch to
```
curl -X PATCH http://localhost/index.php/update/eur/rate/14 
```
To get all change rates, simple get to
```
curl -X GET http://localhost/index.php/rates
```
Response 200 ok

```
[{"Rates":[{"Currency":"EUR","Rate":12}]}]
```

## Unit tests
```
php bin/phpunit
```
`
## Details

Created in docker stack with php and apache, further versions will include 
real infrastructure implementation.