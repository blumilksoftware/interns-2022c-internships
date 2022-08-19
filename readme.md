# internships
Website for apprenticeship programme.
# Architecture
Project contains modified default configuration and is structured as follows:
* `backend` stores configuration for php composer and Laravel application and other php related stuff;
* `frontend` is for node's npm, vite, vue and lint configuration - it also contains assets used in webpage;

## Setup and Run
### 1. Run setup script:
The script will ask you to input a MapBox public key, which will be written into an .env file as VITE_MAPBOX_TOKEN:
```shell script
sh setup.sh
```
Or you can do provided steps in the file manually.
Remember to add VITE_MAPBOX_TOKEN key in .env.

### 2. Run development environment:
To develop application in local environment:
```shell script
docker-compose exec node npm run dev
```
Application should be available under `localhost:80` or other port if you changed `EXTERNAL_WEBSERVER_PORT` value in `.env` file.

## Development
### Codestyle
Before committing changes, it is recommended to run codestyle and lint checkers:
```shell script
docker-compose exec php composer run csf
docker-compose exec node npm run lintf
```
You can remove `f` at the end of these commands, if you don't want to fix issues.
