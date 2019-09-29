Esempio di modellazione DDD di un Utente con Symfony 4
========================

## Preparazione ambiente sviluppo
L'applicazione funziona all'interno di un conainer docker. Preparare l'ambiente in questo modo:

```
$git clone https://github.com/matiux/ddd-utente-esempio-v2.git && cd ddd-utente-esempio-v2
$cp docker/docker-compose.override.dist.yml docker-compose.override.yml
$./dc up -d
```

## Sviluppo

#### Entrare nel container PHP per lo sviluppo
```
$./dc enter
./setup --force
```

## Comandi e Aliases all'interno del container PHP

* `test` è un alias a `vendor/bin/phpunit`
* `sf` è un alias a `bin/console` per usare la console di Symfony
* `sfcc` è un alias a `rm -Rf var/cache/*` per svuotare la cache
* `memflush` è un alias a `echo \"flush_all\" | nc servicememcached 11211 -q 1"` per svuotare memcached


## API

Creazione utente:

`POST http://localhost:8080/v1/utente`

Payload:
```json
{
	"email":"pinco2@email.it",
	"password":"verde",
	"ruolo":"admin",
	"competenze":          [
            "raccogli foglie",
            "raccogli aghi di pino"
         ]
}
```
