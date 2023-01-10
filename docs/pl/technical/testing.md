# Testowanie aplikacji
Przed uruchomieniem testów warto wyczyścić cache, aby upewnić się, że używasz najnowszej konfiguracji:
```
docker-compose exec php php artisan config:clear
```

Musisz zbudować aplikację w trybie deweloperskim, aby móc przejść wszystkie testy.

Aby to zrobić, możesz użyć poniższego polecenia:
```shell script
docker-compose run --rm node npm run dev-build
```

Aby uruchomić testy:
```shell script
docker-compose run --rm php php artisan test
```

## Testowanie przeglądarkowe
Być może będziesz musiał najpierw zainstalować sterowniki do chrome:
```shell script
docker-compose run --rm php php artisan dusk:chrome-driver
```

Dusk zakłada, że plik .env jest przechowywany w lokalizacji bazowej aplikacji Laravel.

Musisz utworzyć twardy link, aby zmusić go do zmodyfikowania prawidłowego pliku:
```shell script
ln .env ./backend/.env
```

Aby uruchomić testy przeglądarkowe:
```shell script
docker-compose run --rm php php artisan dusk
```

Jeśli masz zainstalowany XDebugger, możesz dodać `-e XDEBUG_MODE=off`, aby poprawić wydajność:
```shell script
docker-compose run --rm -e XDEBUG_MODE=off php php artisan dusk
```
