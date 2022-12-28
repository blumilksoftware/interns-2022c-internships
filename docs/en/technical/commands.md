# Commands
In the application, we can use all the commands offered by the Laravel framework and the custom commands described below.

## Using commands via Docker
If the application is running in Docker containers (for example, it was launched using [convenient script](../technical/run.html#using-a-convenient-script)), in order to send commands, use docker-compose in the root directory of the application:

```
docker-compose exec {service} {command}
```

In the {service}, enter the appropriate service name (all services are in the docker-compose.yml file):
@[code](@/docker/service-list.md)

::: tip
For more information about the exec command, see the [Docker documentation.](https://docs.docker.com/engine/reference/commandline/compose_exec/)
:::

## Creating an administrator account
The administrator account is created using the artisan command with the desired email, password, first and last name:
```
php artisan make:admin {email} {password} {first_name} {last_name}
```

Example command usage:
```
php artisan make:admin email@example.com password123 Jane Doe
```

## Locate with the locate:place command
To test the geocoding service, you can use the command:
```
php artisan locate:place {adres}
```

The address should be listed in order from most to least detailed: `{house number} {street} {postcode} {city} {state}`.
```
php artisan locate:place 5A Sejmowa 59-220 Legnica Dolnośląskie Polska
```

## Migrations and seeders
The section containing information on migration and seeders can be found: [Migrations and seeders](../technical/migrations-and-seeders) 
