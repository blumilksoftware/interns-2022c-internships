# internships

Website for apprenticeship programme.

## Usage & Development

### 1. Create `.env` file based on `.env.example`:

```shell script
cp .env.example .env
```

### 2. Build and run containers:

```shell script
docker-compose build --no-cache --pull
docker-compose up -d
```

### 3.Install frontend dependencies and build frontend:

```shell script
docker-compose exec node npm install
docker-compose exec node npm run build
```

### 4. Install backend dependencies and build static API endpoints:

```shell script
docker-compose exec php composer install
docker-compose exec php composer intern-populate
docker-compose exec php composer intern-build
```

### 5. Generate Application Key:

```shell script
docker-compose exec php php artisan key:generate
```

### 6. Run development environment:
```shell script
docker-compose exec node npm run dev
```
Application should be available under `localhost` or other port if you changed `EXTERNAL_WEBSERVER_PORT` value in `.env` file.

## Additional information

### Backend

Static API comes with help command, describing all available script options.
You can access it with:

```shell script
docker-compose exec php composer intern
```

Not all options are available for each environment. Set `COMMANDLINE_MODE` environment variable to `deploy` for deployment, and `local` for development.

It's recommended to run `populate` command for new faculties defined in `faculties.csv` to generate missing required files. It does not overwrite existing data.
