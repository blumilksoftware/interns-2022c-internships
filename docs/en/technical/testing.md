# Testing application
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

## Browser testing
You might have to install chrome drivers first:
```shell script
docker-compose run --rm php php artisan dusk:chrome-driver
```

Dusk assumes the .env file is stored at the base location of a Laravel application.

You have to create a hard link to make it modify the correct file:
```shell script
ln .env ./backend/.env
```

To run browser tests:
```shell script
docker-compose run --rm php php artisan dusk
```

If you have the XDebugger installed, you can add `-e XDEBUG_MODE=off` to improve performance:
```shell script
docker-compose run --rm -e XDEBUG_MODE=off php php artisan dusk
```
