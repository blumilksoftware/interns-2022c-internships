# internships

Website for apprenticeship programme.

## Usage & Development

### 1. Create `.env` file based on `.env.example`:

```shell script
cp .env.example .env
```

### 2. Run containers:

```shell script
docker-compose up -d
```

### 3.Install frontend dependencies and build frontend:

```
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

Application should be available under `localhost:8027` or other port if you changed `EXTERNAL_WEBSERVER_PORT` value in `.env` file.

## Additional information

### Backend

Static API comes with help command, describing all available script options.
You can access it with:

```shell script
docker-compose exec php composer intern
```

Not all options are available for each environment. Set `COMMANDLINE_MODE` environment variable to `deploy` for deployment, and `local` for development.

It's recommended to run `populate` command for new faculties defined in `faculties.csv` to generate missing required files. It does not overwrite existing data.

## Deployment

Frontend and backend builds site from templates and resources contents into `dist` folder. You can copy its contents to the web server, or configure build scripts to generate content directly into distributed directory.

GitHub Actions should deploy everything to GitHub Pages after every push to `main` branch. Generated content is pushed into `public` branch.

Built website for example data set should be available under this URL: https://blumilksoftware.github.io/internships/
