# Social Deal Demo

Een lichtgewicht Symfony + Vue demo project dat een productcatalogus ontsluit via een API. Dit project is opgezet als een **monorepo** met een gescheiden backend en frontend.

## 📂 Projectstructuur

```
/socialdeal-demo
├── api          # Symfony backend
├── app          # Vue 3 frontend (Vite)
└── README.md    # Deze file
```

## 🚀 Setup & Run

### Backend (Symfony API)

```bash
cd api
composer install
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load --append
symfony serve
```

API endpoints zijn bereikbaar via: `http://localhost:8000/api/...`

### Frontend (Vue 3 + Vite)

```bash
cd app
npm install
npm run dev
```

Vite dev server draait standaard op: `http://localhost:5173/`

`/api` requests worden automatisch naar Symfony backend gestuurd via proxy (configuratie in `vite.config.ts`).

## 🔌 API Endpoints (voorbeeld)

### GET /api/products

**Optioneel:** filteren op prijs

```
/api/products?minPrice=12.50
```

**Voorbeeld JSON response:**

```json
[
  {
    "id": 1,
    "name": "3-gangen diner bij De Post",
    "priceFormatted": "€ 19,50",
    "description": "Geniet van een heerlijk diner in hartje stad."
  }
]
```

## 🏗️ Architectuur & Design Keuzes

- **Monorepo structuur:** Backend en frontend in één repo
- **Symfony + Service Layer + DTO:** backend blijft clean en testbaar
- **Vite + Vue 3 frontend:** modern, snel en developer friendly
- **Proxy:** frontend kan API calls doen zonder CORS problemen

## 💡 Tips

- Voeg extra Vue components toe in `/app/src/components`
- Voeg extra Symfony endpoints toe in `/api/src/Controller`
- Voor productie: overweeg Docker of Nginx setup