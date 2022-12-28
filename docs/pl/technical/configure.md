# Konfiguracja


## Ogólna konfiguracja oraz konfiguracja backendu
Ogólna konfiguracja aplikacji (dla backendu oraz frontendu) znajduje się w głównym katalogu projektu, w pliku .env.

### Plik .env
Do prawidłowego funkcjonowania aplikacji konieczne jest:
1. Wygenerowanie klucza (patrz: [uruchomienie](../technical/run)). Wygenerowany klucz powinien znajdować się w `APP_KEY`.
2. [Wygenerowanie](https://cloud.maptiler.com/account/keys/) i ustawienie tokena MapLibre w zmiennej `VITE_MAPLIBRE_TOKEN`. 

W pliku .env możemy skonfigurować ponaddto:
- Ustawienia środowiska aplikacji 
@[code sh](@/env/app-default.md)

Jeżeli chcemy uruchomić aplikację na produkcji, zalecane są zmiany:
@[code sh](@/env/app-production.md)

- Ustawienia połączenia z bazą danych
@[code sh](@/env/db-default.md)

- Ustawienia wybranego serwisu do wysyłania wiadomości mailowych
@[code sh](@/env/mail-default.md)

### Seeder struktury uczelni
Struktura uczelni używana w seederze DepartmentSeeder może zostać skonfigurowana w pliku `database/seeders/Data/college.yml`. Przykładowo, jeśli chcemy utworzyć dwa wydziały, z dwoma kierunkami i dwiema specjalizacjami na każdym z kierunków.
@[code yml](@/seeder/department-data.md)

## Konfiguracja frontendu
Wszelkie pliki konfiguracyjne od frontendu znajdują się w katalogu `frontend`.

### Nazwa i koordynaty uczelni
Nazwę oraz koordynaty uczelni można ustawić w pliku `assets.json`. Przykładowa konfiguracja:
@[code json](@/config/college.md)

### Kolory strony
W celu zmiany koloru podstawowego oraz dodatkowego (domyślnie jest to: <span style="background-color:#171c58">#171c58</span> oraz <span style="background-color:#34375c">#34375c</span>), należy udać się do pliku `tailwind.config.js`.
@[code js](@/config/tailwind.md)
