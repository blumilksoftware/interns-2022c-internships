# Polecenia
W aplikacji możemy korzystać ze wszystkich poleceń oferowanych przez framework Laravel oraz niżej opisanych poleceń niestandardowych.

## Używanie poleceń przez Dockera
Jeżeli aplikacja pracuje w kontenerach Dockera (na przykład została uruchomiona za pomocą [wygodnego skryptu](/pl/technical/run.html#za-pomoca-wygodnego-skryptu)), w celu wywoływania poleceń należy skorzystać z `docker-compose` w głównym katalogu aplikacji:

```
docker-compose exec {serwis} {komenda}
```

W miejscu {serwis} należy wpisać odpowiednią nazwę serwisu (wszystkie serwisy znajdują się w pliku `docker-compose.yml`):
@[code](@/docker/service-list.md)

::: tip
Więcej informacji odnośnie polecenia `exec` znajduje się w dokumentacji Dockera: [https://docs.docker.com/engine/reference/commandline/compose_exec](https://docs.docker.com/engine/reference/commandline/compose_exec/)
:::

## Tworzenie konta administratora
Tworzenie konta administratora odbywa się za pomocą polecenia artisan z żądanym e-mailem, hasłem, imieniem i nazwiskiem:
```
php artisan make:admin {email} {hasło} {imię} {nazwisko}
```

Przykładowe użycie polecenia:
```
php artisan make:admin email@example.com haslo123 Jan Kowalski
```

## Lokalizowanie poleceniem locate:place
W celu przetestowania serwisu od geokodowania, można skorzystać z polecenia:
```
php artisan locate:place {adres}
```

Adres powinien zostać podany w kolejności od najbardziej do najmniej szczegółowego: `{Numer mieszkania} {Ulica} {Kod pocztowy} {Miasto} {Województwo} {Kraj}`.
```
php artisan locate:place 5A Sejmowa 59-220 Legnica Dolnośląskie Polska
```

## Migracje oraz seedery
Sekcja zawierająca informacje na migracji oraz seederów znajduje się: [migracje oraz seedery](../technical/migrations-and-seeders) 