# Configuration

## General setup and backend configuration
The general configuration of the application (for the backend and frontend) is located in the project's root directory, in the .env file.

### The .env file
In order for the application to function properly, it is necessary to:
1. Generate key (see: [run](/en/technical/run.html#manual)). The generated key should be in `APP_KEY`.
2. [Generate](https://cloud.maptiler.com/account/keys/) and set MapLibre token in the `VITE_MAPLIBRE_TOKEN` variable. 

In the .env file, we can also configure:
- Application environment settings
```
APP_NAME="Internships"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
```
If you want to run the application in production, the following changes are recommended:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=adres.strony
```

- Database connection settings
```
DB_CONNECTION=mysql
DB_HOST=intern-mysql
DB_PORT=3306
DB_DATABASE=intern
DB_USERNAME=intern
DB_PASSWORD=password
DB_ROOT_PASSWORD=example
```

- Settings of the selected email service
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


### College structure seeder
The college structure used in the DepartmentSeeder can be configured in the `database/seeders/Data/college.yml` file. For example, if we want to create two departments, with two fields and two specializations in each field.
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


## Frontend configuration
All configuration files from the frontend are located in the `frontend` directory.

### College name and coordinates
The name and coordinates of the university can be set in the `assets.json` file. Example configuration:
``` json
todo
```

### Map style
todo

### Website colors
In order to change the primary and secondary colors (the defaults: <span style="background-color:#171c58">#171c58</span> and <span style="background-color:#34375c">#34375c</span>), go to file `tailwind.config.js`.
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