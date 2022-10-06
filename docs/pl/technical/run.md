# Uruchomienie

## Środowisko developerskie przy użyciu Dockera
Aplikacja została skonfigurowana pod uruchomienie w skonteneryzowanym środowisku za pomocą oprogramowania Docker i narzędzia Docker Compose. Dzięki czemu, można ją uruchomić na dowolnym środowisku, niezależnie od jego rodzaju i konfiguracji infrastruktury.

::: tip
Informacje odnośnie instalacji Dockera oraz Docker Compose znajdują się w ich oficjalnej dokumentacji:
https://docs.docker.com/engine/install/
https://docs.docker.com/compose/
:::
### Za pomocą wygodnego skryptu
W celu minimalizacji działań potrzebnych do przygotowania środowiska deweloperskiego, przygotowano wygodny skrypt `setup.sh` znajdujący się w głównym katalogu projektu. Uruchomienie skryptu:
```
sh setup.sh
```

### Manualnie
Jeżeli nie chcesz korzystać ze skryptu. Możesz uruchomić aplikację w sposób manualny.


Kopia przykładowego pliku .env. (Zobacz: [Konfiguracja pliku .env](/pl/technical/configure.html#plik-env)):
```
cp .env.example .env
```

Budowa i uruchomienie serwisów Dockera:
```
docker-compose build --no-cache --pull
docker-compose up -d
```

Instalacja zależności backendowych:
```
docker-compose run --rm -u "$(id -u):$(id -g)" php composer install
```

Wygenerowanie klucza aplikacji oraz utworzenie łącza symbolicznego:
```
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan key:generate
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan storage:link
```

Instalacja zależności frontendowych:
```
docker-compose run --rm -u "$(id -u):$(id -g)" node npm install
```

## Środowisko produkcyjne
*todo*