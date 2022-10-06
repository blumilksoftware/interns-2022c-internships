# Migrations and seeders
For proper functioning of the application, the database must be structured properly. For this purpose, appropriate migrations and seeders have been created.

## Migrations
Migrations only create the database structure, but do not fill it with data. To invoke a migration, use the command:
```
php artisan migrate
```

If for some reason we need to rebuild the entire database (clean and create the structure again), there is a command:
```
php artisan migrate:refresh
```

::: tip
For more information regarding migration, see [Laravel documentation](https://laravel.com/docs/9.x/migrations)
:::

## Seeders
Seeders fill the created database structure with data. Two main seeders were created in the application: the college structure and random data.

### College structure seeder
The college structure seeder populates the database with information about the university structure: department names, fields and specializations. This is the data needed to properly add and filter companies. The college structure seeder is started by calling the command:
```
php artisan db:seed --class=DepartmentSeeder
```

[University structure seeder configuration](configure)

### Random data seeder
Seeder UserSeeder populates a database with users who own their own companies. The companies have random names, descriptions, contact information and logos. Seeder startup:
```
php artisan db:seed --class=UserSeeder
```

### General Seeder
If we want to create a structure of the college and fill it with random data, we can call a general seeder - DatabaseSeeder
```
php artisan db:seed
```
