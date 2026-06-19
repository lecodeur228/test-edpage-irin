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

#### Installation
```bash
npm install -g @creopse/cli
creopse install                             # Installation complète (vous invite à choisir le template)
creopse install -t vue                      # Installation avec template Vue (équivalent à php artisan creopse:install -t vue)
creopse install -t react                    # Installation avec template React
creopse install --no-force                  # Désactive le mode force (force activé par défaut)
```

#### Gestion des Sections
```bash
creopse section add NomSection              # Ajoute une section (crée composant + entrée BD)
creopse section add Hero ContactForm Footer # Ajoute plusieurs sections à la fois
creopse section remove NomSection           # Supprime une section et son entrée BD
creopse section remove Hero Footer          # Supprime plusieurs sections
```

#### Gestion des Widgets
```bash
creopse widget add NomWidget                # Ajoute un widget (crée composant seulement)
creopse widget add NewsletterForm Button    # Ajoute plusieurs widgets
creopse widget remove NomWidget             # Supprime un widget
creopse widget remove NewsletterForm Button # Supprime plusieurs widgets
```

#### Développement
```bash
pnpm dev                                    # Lance serveur Vite (frontend)
php artisan serve                           # Lance serveur Laravel (backend)
php artisan migrate --seed                  # Exécute migrations + données par défaut
```

---

## 📚 8. Résumé & Flux de Travail

### 8.1 Architecture globale
```
┌─────────────────────────────────┐
│      Frontend (Vue 3)            │
│  - Composants Sections           │
│  - Composants Widgets            │
│  - Rendu via Inertia.js          │
└────────────┬────────────────────┘
             │
    ┌────────▼────────┐
    │  Laravel Backend │
    │  - Routes dyn   │
    │  - API REST     │
    │  - Admin SPA    │
    └────────┬────────┘
             │
    ┌────────▼────────┐
    │  Base de Données │
    │  - Sections      │
    │  - Pages         │
    │  - Contenus      │
    └──────────────────┘
```

### 8.2 Flux de création d'une page

1. **Créer les sections** via CLI ou admin
   ```bash
   creopse section add HeroBanner FeaturesGrid ContactForm
   ```

2. **Développer les composants** Vue (`resources/js/components/sections/`)
   - Importer `SectionProps`, `useHelper()`, `useContent()`
   - Récupérer les données avec `getSectionRootData()` et `getSectionData()`

3. **Ajouter du contenu** via l'admin Creopse (`/creopse`)
   - Créer une page et ordonner les sections
   - Saisir le contenu de chaque section

4. **Vérifier le rendu** via les routes dynamiques
   - Les routes `/page-path` sont générées automatiquement
   - Le frontend charge et affiche les sections correspondantes

### 8.3 Points clés à retenir

| Concept | Description |
|---------|-------------|
| **Section** | Composant réutilisable avec structure de données et rendu |
| **Page** | Pile ordonnée de sections avec contenu unique par instance |
| **Widget** | Mini-composant (formulaire, bouton) intégrable dans les sections |
| **Localisation** | Contenu multilingue géré automatiquement (`tr()`) |
| **Rendu HTML** | `rHtml()` pour sécuriser et formater l'HTML enrichi WYSIWYG |
| **API REST** | Accessible en parallèle pour intégrations externes |
| **CLI Creopse** | Génère composants + entrées BD en une commande |
| **Admin SPA** | Interface accessible à `/creopse` après installation |

### 8.4 Configuration essentielle

**`config/creopse.php`** (backend)
- Modèle utilisateur pour authentification
- Limites de débit API
- Compression automatique des réponses

**`public/creopse/config.jsonc`** (admin frontend)
- URL de base de l'API (`apiBaseUrl`)
- Mode développement (`forceDevMode`)

### 8.5 Prochaines étapes recommandées

- ✅ Vérifier l'installation : `php artisan tinker` → `\App\Models\Section::count()`
- ✅ Accéder à l'admin : `http://localhost:8000/creopse`
- ✅ Créer les sections métier : `creopse section add [noms]`
- ✅ Développer les composants Vue correspondants
- ✅ Configurer le routage et les menus
- ✅ Tester l'API REST : `curl http://localhost:8000/api/pages`
