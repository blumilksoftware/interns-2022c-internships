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
### 3.Install frontend dependencies :
```
docker-compose exec node npm install
```

### 4. Install backend dependencies and build static API endpoints:
```shell script
docker-compose exec php composer install
docker-compose exec php composer build
```
Application should be available under `localhost:8027` or other port if you changed `EXTERNAL_WEBSERVER_PORT` value in `.env` file.

Website for apprenticeship programme.
## Deployment

GitHub Actions should deploy everything to GitHub Pages after every push to `main` branch. Built website should be available under this URL: https://blumilksoftware.github.io/internships/

