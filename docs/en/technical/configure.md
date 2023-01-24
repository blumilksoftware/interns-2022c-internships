# Configuration

## General setup and backend configuration
The general configuration of the application (for the backend and frontend) is located in the project's root directory, in the `.env` file.

### .env file
In order for the application to function properly, it is necessary to:
1. Generate key (see: [run](../technical/run.html#manual)). The generated key should be in `APP_KEY`.
2. [Generate](https://cloud.maptiler.com/account/keys/) and set MapLibre token in the `VITE_MAPLIBRE_TOKEN` variable. 

In the `.env` file, we can also configure:
- Application environment settings
@[code sh](@/env/app-default.md)

If you want to run the application in production, the following changes are recommended:
@[code sh](@/env/app-default.md)

- Database connection settings
@[code sh](@/env/db-default.md)

- Settings of the selected email service
@[code sh](@/env/mail-default.md)

### College structure seeder
The college structure used in the DepartmentSeeder can be configured in the `database/seeders/Data/college.yml` file. For example, if we want to create two departments, with two fields and two specializations in each field.
@[code yml](@/seeder/department-data.md)

## Frontend configuration
All configuration files from the frontend are located in the `frontend` directory.

### College name and coordinates
The name and coordinates of the university can be set in the `assets.json` file. Example configuration:
@[code json](@/config/college.md)

### Website colors
In order to change the primary and secondary colors (the defaults: <span style="background-color:#171c58">#171c58</span> and <span style="background-color:#34375c">#34375c</span>), go to file `tailwind.config.js`.
@[code js](@/config/tailwind.md)