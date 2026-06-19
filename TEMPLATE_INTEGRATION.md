# 📱 Intégration du Template Voltz dans Creopse

## 📋 Vue d'ensemble

Ce document décrit l'intégration du template HTML **Voltz** (template statique) dans le projet **Creopse CMS**.

### Sections créées
Les sections Creopse suivantes ont été créées automatiquement :
- ✅ **HeroBanner** - Bannière/slider principal
- ✅ **About** - Section À propos
- ✅ **Services** - Section Services
- ✅ **Projects** - Section Projets
- ✅ **Testimonials** - Section Témoignages
- ✅ **FAQ** - Section FAQ
- ✅ **Blog** - Section Blog
- ✅ **Contact** - Section Contact
- ✅ **CTA** - Section Appel à l'action

---

## 🎨 Structure du Template Original

Le template Voltz offre plusieurs **variantes de homepage** :
- `index.html` - Homepage 1
- `index2.html` - Homepage 2
- `index3.html` - Homepage 3
- `index4.html` - Homepage 4
- `index5.html` - Homepage 5

Chaque homepage contient une **combinaison différente** de sections.

### Pages spécialisées
- **Blog** : `blog.html`, `blog-left.html`, `blog-right.html`, `blog-single.html`, `blog2.html`
- **Services** : `service.html`, `service-left.html`, `service-right.html`, `service-single.html`
- **Projets** : `project.html`, `project-left.html`, `project-right.html`, `project-single.html`
- **Autres** : `contact.html`, `faq.html`, `pricing.html`, `team.html`, `testimonial.html`, `team-single.html`

---

## 🔧 Localisation des Assets

### CSS
```
public/assets/css/
├── plugins/          (Bootstrap, AOS, FontAwesome, etc.)
└── main.css         (Styles personnalisés)
```

### JavaScript
```
public/assets/js/
├── plugins/         (jQuery, Bootstrap, AOS, etc.)
└── main.js         (Logique personnalisée)
```

### Images & Médias
```
public/assets/img/
├── logo/
├── all-images/
│   ├── bg/          (Backgrounds)
│   └── ...         (Autres images)
├── svg/
└── ...
```

---

## 📝 Configuration des Composants Vue

### Modèle Standard de Section

Chaque composant Vue suit cette structure :

```typescript
<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'
  
  const props = defineProps<SectionProps>()
  
  // Récupérer les données Creopse
  const { getSectionRootData, getSectionData } = useContent()
  
  // Données de la section
  const sectionData = getSectionRootData(props.sectionKey)
  const customData = getSectionData(props.sectionKey)  // Champs personnalisés
</script>

<template>
  <!-- HTML intégré du template -->
</template>

<style scoped>
  /* Styles spécifiques au composant */
</style>
```

### Utilisation de Données Multilingues

```typescript
// Traduction de texte
const { tr } = useHelper()
{{ tr(sectionData?.title) }}

// HTML enrichi (WYSIWYG)
const { rHtml } = useHelper()
{{ rHtml(sectionData?.description) }}
```

---

## 📊 Champs Creopse Recommandés par Section

### HeroBanner
- `title` (texte) - Titre principal
- `subtitle` (texte) - Sous-titre
- `description` (WYSIWYG) - Description
- `background_image` (image) - Image de fond
- `cta_text` (texte) - Texte du bouton CTA
- `cta_link` (URL) - Lien du bouton CTA

### About
- `title` (texte)
- `description` (WYSIWYG)
- `image` (image)
- `highlights` (tableau) - Points clés

### Services
- `title` (texte)
- `services` (tableau) - Tableau de services
  - `icon` (image)
  - `title` (texte)
  - `description` (WYSIWYG)

### Projects
- `title` (texte)
- `projects` (tableau) - Tableau de projets
  - `image` (image)
  - `title` (texte)
  - `description` (WYSIWYG)
  - `category` (texte)

### Testimonials
- `title` (texte)
- `testimonials` (tableau)
  - `author_name` (texte)
  - `author_role` (texte)
  - `author_image` (image)
  - `content` (texte)
  - `rating` (nombre 1-5)

### FAQ
- `title` (texte)
- `faqs` (tableau)
  - `question` (texte)
  - `answer` (WYSIWYG)

### Blog
- `title` (texte)
- `posts` (tableau)
  - `image` (image)
  - `title` (texte)
  - `excerpt` (texte)
  - `content` (WYSIWYG)
  - `author` (texte)
  - `date` (date)
  - `category` (texte)

### Contact
- `title` (texte)
- `description` (WYSIWYG)
- `form_fields` (tableau) - Champs du formulaire
- `contact_info` (tableau)
  - `type` (email/phone/address)
  - `value` (texte)

### CTA
- `title` (texte)
- `description` (WYSIWYG)
- `button_text` (texte)
- `button_link` (URL)
- `background_image` (image)

---

## 🚀 Prochaines Étapes

### Phase 1 : Développement des Composants
1. ✅ Créer les structures de base Vue
2. ⏳ Intégrer les HTML du template
3. ⏳ Ajouter les styles Tailwind/CSS
4. ⏳ Implémenter la logique multilingue

### Phase 2 : Intégration des Assets
1. ⏳ Copier/optimiser images et médias
2. ⏳ Intégrer les scripts JS
3. ⏳ Configurer les CSS globaux

### Phase 3 : Configuration Creopse
1. ⏳ Créer la page d'accueil
2. ⏳ Configurer les menus
3. ⏳ Ajouter les sections à la BD
4. ⏳ Tester les routes dynamiques

### Phase 4 : Fonctionnalités Avancées
1. ⏳ Formulaire de contact
2. ⏳ Pagination blog
3. ⏳ Filtres projets/services
4. ⏳ SEO & Meta tags

---

## 📖 Commandes Utiles

```bash
# Voir les sections disponibles
php artisan tinker
>>> \App\Models\Section::pluck('name')

# Tester les routes
php artisan route:list | grep -i creopse

# Serveur de développement
pnpm dev
php artisan serve

# Accéder à l'admin
http://localhost:8000/creopse
```

---

## 🔗 Ressources

- [Documentation Creopse](https://creopse.github.io/doc)
- [Template Voltz - Démo](https://html.vikinglab.agency/voltz/)
- [Repository Creopse CLI](https://github.com/creopse/creopse)
