# Social Deal Demo - Vue Frontend

Een moderne Vue 3 frontend applicatie voor de Social Deal Demo, gebouwd met TypeScript, Vite en Tailwind CSS. Deze app toont een interactieve productcatalogus die communiceert met de Symfony backend API.

## 📋 Overzicht

Deze frontend applicatie demonstreert:
- **Vue 3 Composition API** met `<script setup>`
- **TypeScript** voor typeveiligheid
- **Vite** voor snelle ontwikkelserver en build
- **Tailwind CSS** voor styling
- **Proxy configuratie** voor API communicatie zonder CORS problemen

## 🚀 Installatie & Uitvoering

### Vereisten
- Node.js >= 18
- npm of yarn

### Installatie
```bash
cd app
npm install
```

### Ontwikkelserver starten
```bash
npm run dev
```

De app draait standaard op: `http://localhost:5173/`

**Belangrijk:** Zorg ervoor dat de Symfony backend draait op `http://localhost:8000` voor API toegang.

### Build voor productie
```bash
npm run build
```

### Preview productie build
```bash
npm run preview
```

## 🔧 Configuratie

### API Proxy
De app gebruikt een Vite proxy om `/api` requests door te sturen naar de Symfony backend:

```typescript
// vite.config.ts
server: {
  proxy: {
    '/api': {
      target: 'http://localhost:8000',
      changeOrigin: true,
      secure: false,
    },
  },
}
```

Dit voorkomt CORS problemen tijdens ontwikkeling.

## 📁 Project Structuur

```
src/
├── App.vue              # Hoofdcomponent
├── main.ts              # Applicatie entry point
├── index.css            # Globale styles
├── style.css            # Extra styles
├── assets/              # Statische assets
└── components/          # Vue componenten
    └── ProductsList.vue # Productcatalogus component
```

## 🎯 Functionaliteit

### Productcatalogus
- Toont lijst van producten uit de API
- Filteren op minimum prijs
- Paginatie voor grote datasets
- Responsief design met Tailwind CSS

### API Integratie
- Automatische proxy naar Symfony backend
- Error handling voor API calls
- Realtime updates bij filter/paginatie wijzigingen

## 🛠️ Ontwikkeling

### Scripts
- `npm run dev` - Start ontwikkelserver
- `npm run build` - Build voor productie
- `npm run preview` - Preview productie build

### TypeScript Configuratie
- `tsconfig.json` - Basis TypeScript configuratie
- `tsconfig.app.json` - App-specifieke instellingen
- `tsconfig.node.json` - Node.js type definities

### Styling
- **Tailwind CSS** voor utility-first styling
- **PostCSS** voor CSS processing
- `tailwind.config.js` voor Tailwind configuratie

## 🔗 Gerelateerde Projecten

- **Backend API**: Zie `../api/README.md` voor Symfony backend documentatie
- **Monorepo Root**: Zie `../README.md` voor algemene project informatie

## 📚 Meer Informatie

- [Vue 3 Documentatie](https://vuejs.org/)
- [Vite Documentatie](https://vitejs.dev/)
- [Tailwind CSS](https://tailwindcss.com/)
- [TypeScript Vue Guide](https://vuejs.org/guide/typescript/overview.html)
