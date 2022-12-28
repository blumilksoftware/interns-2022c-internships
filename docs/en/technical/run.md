# Run

## Development environment using Docker
The application has been configured to run in a containerized environment using Docker software and the Docker Compose tool. Thus, it can be run on any environment, regardless of its type and infrastructure configuration.

::: tip
For official installation instructions, see their official documentation: [Docker](https://docs.docker.com/engine/install/), [Docker Compose](https://docs.docker.com/compose/).
:::
### Using a convenient script
In order to minimize the steps needed to prepare the development environment, a convenient `setup.sh` script located in the project's main directory has been prepared. Running the script:
```
sh setup.sh
```

### Manual
If you do not want to use the script. You can run the application manually.


A copy of the example .env file. (See: [Configuring the .env file](../technical/configure.html#the-env-file)):
```
cp .env.example .env
```

Building and running Docker services:
```
docker-compose build --no-cache --pull
docker-compose up -d
```

Installing backend dependencies:
```
docker-compose run --rm -u "$(id -u):$(id -g)" php composer install
```

Generate an application key and create a symbolic link:
```
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan key:generate
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan storage:link
```

Installing frontend dependencies:
```
docker-compose run --rm -u "$(id -u):$(id -g)" node npm install
```