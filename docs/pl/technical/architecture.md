# Architektura
Projekt zawiera zmodyfikowaną domyślną konfigurację i ma następującą strukturę:
- `backend` przechowuje konfigurację dla Composera i aplikacji Laravel oraz inne rzeczy związane z PHP;
- `frontend` służy do konfiguracji Node.js npm, Vite, Vue.js i lint - zawiera również zasoby używane na stronie internetowej;

## Backend - struktura
```
└── backend
    ├── app
    │   ├── Console
    │   │   └── Commands
    │   ├── Enums
    │   ├── Exceptions
    │   ├── Http
    │   │   ├── Controllers
    │   │   │   └── Auth
    │   │   ├── Middleware
    │   │   ├── Requests
    │   │   │   ├── Api
    │   │   │   └── Auth
    │   │   └── Resources
    │   ├── Models
    │   │   └── Embeddable
    │   ├── Policies
    │   ├── Providers
    │   └── Services
    ├── bootstrap
    ├── config
    ├── database
    │   ├── factories
    │   │   └── Embeddable
    │   ├── migrations
    │   └── seeders
    │       └── Data
    ├── routes
    ├── storage
    └── tests
```
## Frontend - struktura
```
    ├── frontend
    │   ├── assets
    │   │   ├── icons
    │   │   ├── images
    │   │   └── lang
    │   ├── js
    │   │   ├── Pages
    │   │   │   ├── Auth
    │   │   │   └── Company
    │   │   │       └── Components
    │   │   └── Shared
    │   │       ├── Components
    │   │       └── Layout
    │   └── views
    └── public
```