# internships
Website for apprenticeship programme.
# Architecture
The project contains a modified default configuration and is structured as follows:
* `backend` stores configuration for Composer and Laravel application and other PHP related stuff;
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
To run tests:
```shell script
docker-compose run --rm -e XDEBUG_MODE=off php php artisan test
```
The XDEBUG_MODE=off disables xDebug if it's installed, improving performance.

For Browser suite testing, use this instead:
```
docker-compose run --rm -e XDEBUG_MODE=off php php artisan dusk
```
You need to properly setup environment based on provided .example files.