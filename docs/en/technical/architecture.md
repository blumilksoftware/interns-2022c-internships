# Architecture
The project contains a modified default configuration and is structured as follows:
- `backend` stores configuration for Composer and Laravel application and other PHP related stuff;
- `frontend` is for Node.js npm, Vite, Vue.js and lint configuration - it also contains assets used in the webpage;

## Backend - structure
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
## Frontend - structure
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