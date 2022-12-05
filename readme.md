# internships
Website for apprenticeship programme.
# Architecture
The project contains a modified default configuration and is structured as follows:
* The application root stores configuration for Composer and Laravel application;
* `frontend` is for Node.js npm, Vite, Vue.js and lint configuration - it also contains assets used in the webpage;

## Setup and Run
### 1. Run setup script:
```shell script
sh setup.sh
```
Or you can do provided steps in the file manually.
Remember to add VITE_MAPLIBRE_TOKEN and API_GEOCODE_TOKEN keys in .env.

### 2. Run development environment:
To develop the application in a local environment:
```shell script
docker-compose exec node npm run dev
```
The application should be available under `localhost:80` or another port if you changed `EXTERNAL_WEBSERVER_PORT` value in the `.env` file.

### 3. Admin account:
To be able to login to an admin account and use its features, create it with the artisan command with the desired email, password, name and surname:
```shell script
docker-compose exec php php artisan make:admin email@example.com password123 name surname
```
You should now be able to login to an account using these credentials on the website.

## Development
### 1. Codestyle
Before committing changes, it is recommended to run code style and lint checkers:
```shell script
docker-compose exec php composer run csf
docker-compose exec node npm run lintf
```
You can remove `f` at the end of these commands if you don't want to fix issues:
```shell script
docker-compose exec php composer run cs
docker-compose exec node npm run lint
```

### 2. Running tests
Before running tests, you might want to clear cache to make sure you are using newest configuration:
```
docker-compose exec php php artisan config:clear
```

You have to build an application in the development mode to be able to pass all tests.

To do that, you can use the provided command:
```shell script
docker-compose run --rm node npm run dev-build
```

To run tests:
```shell script
docker-compose run --rm php php artisan test
```

### 3. Browser testing
You might have to install chrome drivers first:
```shell script
docker-compose run --rm php php artisan dusk:chrome-driver
```

To run browser tests:
```shell script
docker-compose run --rm php php artisan dusk
```

If you have the XDebugger installed, you can add `-e XDEBUG_MODE=off` to improve performance:
```shell script
docker-compose run --rm -e XDEBUG_MODE=off php php artisan dusk
```
