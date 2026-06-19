# 📖 Creopse CMS — Guide de Fonctionnement Technique (Officiel)

Ce document récapitule les concepts, configurations, structures de fichiers et commandes de **Creopse CMS**, d'après sa documentation officielle.

---

## 🚀 1. Qu'est-ce que Creopse ?

**Creopse** est un CMS hybride et extensible conçu autour d'un backend **Laravel** (ou Adonis) couplé à un frontend **Vue.js 3** ou **React** via **Inertia.js**. 

### Pourquoi "hybride" ?
Contrairement aux CMS traditionnels (WordPress, Drupal) qui lient étroitement le rendu et les données, ou aux CMS Headless purs qui suppriment l'affichage final, Creopse propose le meilleur des deux mondes :
* **Un frontend intégré** (via Inertia) pour déployer rapidement un site complet sans infrastructure séparée.
* **Une API REST** prête à l'usage pour alimenter des applications mobiles, des intégrations tierces ou tout autre client découplé.

### Extensible par nature
L'architecture de Creopse repose sur des **plugins** : toute nouvelle fonctionnalité peut être encapsulée, distribuée et installée de manière indépendante sans toucher au cœur du CMS.

---

## 💡 2. Concepts Clés : Sections & Pages

### 2.1 Les Sections
La brique de base de Creopse est la **Section**. Elle correspond à un bloc de contenu contextualisé et localisé (multilingue). Chaque section possède :
* Une **structure de données** (champs saisis dans l'admin).
* Des **paramètres de rendu** pour adapter l'affichage.

### 2.2 Les Pages
Dans Creopse, une page est simplement une **pile de sections** ordonnée.
* La position et le contenu de chaque section peuvent être modifiés pour chaque page.
* Le contenu d'une section est **lié à la page sur laquelle elle se trouve**. Ainsi, une même section peut être réutilisée sur plusieurs pages avec des contenus différents, ou présente plusieurs fois sur la même page.
* Il est également possible de lier/synchroniser le contenu d'une section entre plusieurs pages.

---

## 🚦 3. Routage Backend Laravel

Creopse s'occupe de l'enregistrement dynamique des routes web (dans `vendor/creopse/creopse/routes/web/index.php`) :
1. **Pages dynamiques :** Scanne la table `menus` et enregistre une route Laravel `Route::get($path)` vers le `DynamicPageController` pour chaque élément de type `PAGE_LINK` actif.
2. **Permaliens :** Lit les préfixes enregistrés (ex: `/blog/`) et crée des routes dynamiques de type `Route::get('/{prefixe}/{id}')` vers le `DynamicPageController`.
3. **Admin SPA :** Enregistre la route de l'interface d'administration `/creopse/{any?}` qui sert le fichier statique `public/creopse/index.html`.

---

## 📂 4. Structure des Fichiers (Laravel + Vue)

Lors de l'installation dans un projet Laravel avec un frontend Vue, Creopse ajoute les éléments suivants (notés avec ✦) :

```text
mon-projet/
├── config/
│   └── creopse.php           # ✦ Configuration backend (Laravel)
├── public/
│   └── creopse/              # ✦ Fichiers du panneau d'administration (SPA)
│       ├── config.jsonc      # ✦ Configuration de l'administration
│       └── install.lock      # ✦ Fichier de verrouillage d'installation
├── resources/
│   └── js/
│       ├── components/
│       │   ├── sections/     # ✦ Vos composants de sections Vue
│       │   └── widgets/      # ✦ Vos composants de widgets Vue
│       └── pages/
│           └── Container.vue # ✦ Conteneur principal (RootContainer)
```

---

## ⚙️ 5. Configuration de l'Application

### 5.1 Configuration de l'Administration (`public/creopse/config.jsonc`)
Ce fichier configure l'interface d'administration SPA :
```jsonc
{
  "apiBaseUrl": "https://creopse.test", // URL de base de votre backend API Laravel
  "forceDevMode": false                 // Force le mode dev (permet de modifier la structure des sections directement en production)
}
```

### 5.2 Configuration du Backend (`config/creopse.php`)
Ce fichier configure le comportement de Laravel :
```php
return [
    'user_model' => \App\Models\User::class, // Modèle utilisateur pour l'authentification
    'seed_default_data' => true,             // Insertion automatique des données de base (admin par défaut, menus...)
    'rate_limit' => env('CREOPSE_RATE_LIMIT', 600), // Limite de requêtes API par minute
    'rate_limit_by' => 'ip',                 // Critère de limitation ('ip' ou 'user')
    'compression' => [
        'enabled' => env('CREOPSE_COMPRESSION', true), // Compression automatique des réponses (Brotli, Gzip)
        'level' => 5,
        'min_length' => 1024
    ]
];
```

---

## 💻 6. Rendu Frontend dans Vue 3

### 6.1 Point d'entrée : `app.ts`
Le plugin est enregistré et instruit pour scanner vos sections locales :
```typescript
import creopse from '@creopse/vue'

// Dans createInertiaApp setup :
app.use(creopse, {
  initialProps: props.initialPage.props,
  router,
  resolveSections: () => {
    return import.meta.glob('./components/sections/**/*.vue', { eager: true })
  },
  config: { ... }
})
```

### 6.2 Composant de Section standard (`resources/js/components/sections/MonComposant.vue`)
```html
<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  // Reçoit la clé d'instance de la section passée par le RootContainer
  const props = defineProps<SectionProps>()

  // Hooks Creopse pour extraire les données et formater le texte
  const { tr, rHtml } = useHelper()
  const { getSectionRootData, getSectionData } = useContent()

  // Chargement des données
  const contentData = getSectionRootData(props.sectionKey) // Données globales (titre, sous-titre...)
  const customFields = getSectionData(props.sectionKey)    // Champs spécifiques (tableaux, listes...)
</script>

<template>
  <section class="section">
    <!-- tr() traduit le texte en fonction de la locale active du site -->
    <h1>{{ tr(contentData?.title) }}</h1>
    
    <!-- rHtml() rend proprement le code HTML enrichi de l'éditeur WYSIWYG -->
    <div v-html="rHtml(contentData?.text)"></div>
  </section>
</template>
```

---

## 🛠️ 7. Outils & Ligne de Commande (CLI)

Creopse propose un outil en ligne de commande global pour gérer les composants et les installations.

### Installation du CLI
```bash
npm install -g @creopse/cli
```

### Commandes principales
* **`creopse install`** (ou `php artisan creopse:install -t vue`) : Installe le package et crée les fichiers de structure. Cette commande génère aussi `public/creopse/install.lock` pour activer l'assistant d'installation web.
* **`pnpm dev`** : Lance le serveur de développement Vite pour compiler les assets.
* **`php artisan migrate --seed`** : Exécute les migrations et injecte les données par défaut si l'installation manuelle est préférée.
