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
Remember to add VITE_MAPBOX_TOKEN key in .env.

### 2. Run development environment:
To develop the application in a local environment:
```shell script
docker-compose exec node npm run dev
```
The application should be available under `localhost:80` or another port if you changed `EXTERNAL_WEBSERVER_PORT` value in the `.env` file.

## Development
### Codestyle
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
