# Konfiguracja


## Ogólna konfiguracja oraz konfiguracja backendu
Ogólna konfiguracja aplikacji (dla backendu oraz frontendu) znajduje się w głównym katalogu projektu, w pliku .env.

### Plik .env
Do prawidłowego funkcjonowania aplikacji konieczne jest:
1. Wygenerowanie klucza (patrz: [uruchomienie](run)). Wygenerowany klucz powinien znajdować się w `APP_KEY`.
2. [Wygenerowanie](https://cloud.maptiler.com/account/keys/) i ustawienie tokena MapLibre w zmiennej `VITE_MAPLIBRE_TOKEN`. 

W pliku .env możemy skonfigurować ponaddto:
- Ustawienia środowiska aplikacji 
```
APP_NAME="Internships"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
```
Jeżeli chcemy uruchomić aplikację na produkcji, zalecane są zmiany:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=adres.strony
```

- Ustawienia połączenia z bazą danych
```
DB_CONNECTION=mysql
DB_HOST=intern-mysql
DB_PORT=3306
DB_DATABASE=intern
DB_USERNAME=intern
DB_PASSWORD=password
DB_ROOT_PASSWORD=example
```

- Ustawienia wybranego serwisu do wysyłania wiadomości mailowych
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=${MAILHOG_PORT}
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"
```


### Seeder struktury uczelni
Struktura uczelni używana w seederze DepartmentSeeder może zostać skonfigurowana w pliku `database/seeders/Data/college.yml`. Przykładowo, jeśli chcemy utworzyć dwa wydziały, z dwoma kierunkami i dwiema specjalizacjami na każdym z kierunków.
``` yml
departments:
  - name: "Wydział Nauk Społecznych i Humanistycznych"
    fields_of_study:
      - name: "Administracja"
        specializations:
          - "Menadżer w administracji publicznej"
          - "Administracja i prawo w biznesie"
      - name: "Bezpieczeństwo wewnętrzne"
        specializations:
          - "Administrowanie i zarządzanie w sferze bezpieczeństwa wewnętrznego"
          - "Służby mundurowe w bezpieczeństwie"
  - name: "Wydział Nauk Technicznych i Ekonomicznych"
    fields_of_study:
      - name: "Finanse"
        specializations:
          - "Rachunkowość i podatki"
          - "Finanse podmiotów gospodarczych"
      - name: "Zarządzanie"
        specializations:
          - "Zarządzanie przedsiębiorstwem"
          - "Zarządzanie zasobami ludzkimi"
```


## Konfiguracja frontendu
Wszelkie pliki konfiguracyjne od frontendu znajdują się w katalogu `frontend`.

### Nazwa i koordynaty uczelni
Nazwę oraz koordynaty uczelni można ustawić w pliku `assets.json`. Przykładowa konfiguracja:
``` json
todo
```

### Styl mapy
todo

### Kolory strony
W celu zmiany koloru podstawowego oraz dodatkowego (domyślnie jest to: <span style="background-color:#171c58">#171c58</span> oraz <span style="background-color:#34375c">#34375c</span>), należy udać się do pliku `tailwind.config.js`.
``` json
module.exports = {
    (...)
      theme: {
        (...)
        colors: {
            primary: "#171c58",
            secondary: "#34375c",
        }
      }
```