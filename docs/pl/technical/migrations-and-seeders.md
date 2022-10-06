# Migracje i seedery
Do prawidłowego funkcjonowania aplikacji, baza danych musi mieć odpowiednią strukturę. W tym celu zostały stworzone odpowiednie migracje oraz seedery.

## Migracje
Migracje tworzą jedynie strukturę bazy danych, ale nie wypełniają jej danymi. W celu wywołania migracji, należy użyć komendy:
```
php artisan migrate
```

Jeżeli z jakiegoś powodu potrzebujemy przebudować całą bazę danych (wyczyścic i stworzyć strukturę na nowo), istnieje polecenie:
```
php artisan migrate:refresh
```

::: tip
Więcej informacji odnośnie migracji znajduje się w [dokumentacji Laravela](https://laravel.com/docs/9.x/migrations)
:::

## Seedery
Seedery wypełniają danymi utworzoną strukturę bazy danych. W aplikacji zostały utworzone dwa główne seedery: struktury uczelni oraz losowych danych.

### Seeder struktury uczelni
Seeder struktury uczelni uzupełnia bazę danych informacjami na temat struktury uczelni: nazwami wydziałów, kierunkami oraz specjalizacjami. Są to dane potrzebne do prawidłowego dodawania oraz filtrowania firm. Uruchomienie seedera struktury uczelni następuje przez wywołanie komendy:
```
php artisan db:seed --class=DepartmentSeeder
```

[Konfiguracja seedera struktury uczelni](configure#seeder-struktury-uczelni)

### Seeder losowych danych
Seeder UserSeeder wypełnia bazę danych użytkownikami, które posiadają własne firmy. Firmy posiadają losowe nazwy, opisy, dane kontaktowe oraz loga. Uruchomienie seedera:
```
php artisan db:seed --class=UserSeeder
```

### Seeder ogólny
Jeżeli chcemy stworzyć strukturę uczelni opraz wypełnić ją losowymi danymi, możemy wywołać ogólny seeder - DatabaseSeeder
```
php artisan db:seed
```
