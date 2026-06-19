<?php

namespace Database\Seeders;

use Creopse\Creopse\Enums\MenuItemTargetType;
use Creopse\Creopse\Models\AppInformation;
use Creopse\Creopse\Models\Menu;
use Creopse\Creopse\Models\MenuItem;
use Creopse\Creopse\Models\MenuLocation;
use Creopse\Creopse\Models\Page;
use Creopse\Creopse\Models\PageSection;
use Creopse\Creopse\Models\Section;
use Illuminate\Database\Seeder;

class VoltzTemplateSeeder extends Seeder
{
    public function run(): void
    {
        AppInformation::updateOrCreate(['key' => 'name'], ['value' => 'Voltz']);
        AppInformation::updateOrCreate(['key' => 'description'], ['value' => '{"en":"Renewable energy solutions for a sustainable tomorrow.","fr":"Solutions d energie renouvelable pour un avenir durable."}']);
        AppInformation::updateOrCreate(['key' => 'icon'], ['value' => '/assets/img/logo/fav-logo1.png']);

        $sections = [
            'Content' => [
                'title' => '{"en":"Content","fr":"Contenu"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'text',
                            'label' => '{"en":"Text","fr":"Texte"}',
                            'type' => 'i18n-editor',
                            'required' => true,
                            'options' => [],
                        ],
                    ],
                    'headlinks' => [
                        'title' => '{"en":"Head links","fr":"Liens rapides"}',
                        'items' => [
                            [
                                'key' => 'title',
                                'label' => '{"en":"Title","fr":"Titre"}',
                                'type' => 'i18n-text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'url',
                                'label' => '{"en":"URL","fr":"URL"}',
                                'type' => 'text',
                                'required' => true,
                                'options' => [],
                            ],
                        ],
                    ],
                    'features' => [
                        'title' => '{"en":"Features","fr":"FonctionnalitÃ©s"}',
                        'items' => [
                            [
                                'key' => 'icon',
                                'label' => '{"en":"Icon","fr":"IcÃ´ne"}',
                                'type' => 'icon',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'title',
                                'label' => '{"en":"Title","fr":"Titre"}',
                                'type' => 'i18n-text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'text',
                                'label' => '{"en":"Text","fr":"Texte"}',
                                'type' => 'i18n-editor',
                                'required' => true,
                                'options' => [],
                            ],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"A CMS built for Voltz","fr":"Un CMS conÃ§u pour Voltz"}',
                    'text' => '{"en":"Manage your pages, sections, and content directly from the dashboard without touching code.","fr":"GÃ©rez vos pages, sections et contenus directement depuis le tableau de bord sans toucher au code."}',
                    'headlinks' => [
                        [
                            'title' => '{"en":"Documentation","fr":"Documentation"}',
                            'url' => 'https://creopse.github.io/docs/',
                        ],
                        [
                            'title' => '{"en":"Dashboard","fr":"Tableau de bord"}',
                            'url' => '/creopse',
                        ],
                    ],
                    'features' => [
                        [
                            'icon' => 'layout-dashboard',
                            'title' => '{"en":"Database-first","fr":"DonnÃ©es en base"}',
                            'text' => '{"en":"All template content is stored in MySQL and exposed to the dashboard.","fr":"Tous les contenus du template sont stockÃ©s dans MySQL et visibles dans le dashboard."}',
                        ],
                        [
                            'icon' => 'file-tree',
                            'title' => '{"en":"Reusable sections","fr":"Sections rÃ©utilisables"}',
                            'text' => '{"en":"Each Voltz block is a CMS section that can be edited independently.","fr":"Chaque bloc Voltz est une section CMS modifiable sÃ©parÃ©ment."}',
                        ],
                        [
                            'icon' => 'wand-sparkles',
                            'title' => '{"en":"Seeded setup","fr":"Installation initialisÃ©e"}',
                            'text' => '{"en":"The homepage is prefilled so the public site is ready right after seeding.","fr":"La page dâ€™accueil est prÃ©remplie pour que le site soit prÃªt juste aprÃ¨s le seed."}',
                        ],
                    ],
                ],
            ],
            'HeroBanner' => [
                'title' => '{"en":"Hero Banner","fr":"BanniÃ¨re principale"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'subtitle',
                            'label' => '{"en":"Subtitle","fr":"Sous-titre"}',
                            'type' => 'i18n-text',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'description',
                            'label' => '{"en":"Description","fr":"Description"}',
                            'type' => 'i18n-textarea',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'image',
                            'label' => '{"en":"Image","fr":"Image"}',
                            'type' => 'image',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'background_image',
                            'label' => '{"en":"Background image","fr":"Image de fond"}',
                            'type' => 'image',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'cta_text',
                            'label' => '{"en":"CTA text","fr":"Texte du bouton"}',
                            'type' => 'i18n-text',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'cta_link',
                            'label' => '{"en":"CTA link","fr":"Lien du bouton"}',
                            'type' => 'text',
                            'required' => false,
                            'options' => [],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"Power Your Future with Voltz","fr":"Alimentez votre avenir avec Voltz"}',
                    'subtitle' => '{"en":"Clean Energy Solutions","fr":"Solutions dâ€™Ã©nergie propre"}',
                    'description' => '{"en":"Renewable energy solutions for a sustainable tomorrow.","fr":"Des solutions dâ€™Ã©nergie renouvelable pour un avenir durable."}',
                    'image' => '/assets/img/all-images/hero/hero-img1.png',
                    'background_image' => '/assets/img/all-images/bg/hero-bg1.png',
                    'cta_text' => '{"en":"Get Started","fr":"Commencer"}',
                    'cta_link' => '#contact',
                ],
            ],
            'About' => [
                'title' => '{"en":"About","fr":"Ã€ propos"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'description',
                            'label' => '{"en":"Description","fr":"Description"}',
                            'type' => 'i18n-editor',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'image',
                            'label' => '{"en":"Image","fr":"Image"}',
                            'type' => 'image',
                            'required' => false,
                            'options' => [],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"About Voltz","fr":"Ã€ propos de Voltz"}',
                    'description' => '{"en":"Voltz delivers reliable and sustainable electrical solutions for modern businesses.","fr":"Voltz fournit des solutions Ã©lectriques fiables et durables pour les entreprises modernes."}',
                    'image' => '/assets/img/all-images/about/about-img1.png',
                ],
            ],
            'Services' => [
                'title' => '{"en":"Services","fr":"Services"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'description',
                            'label' => '{"en":"Description","fr":"Description"}',
                            'type' => 'i18n-editor',
                            'required' => false,
                            'options' => [],
                        ],
                    ],
                    'cards' => [
                        'title' => '{"en":"Cards","fr":"Cartes"}',
                        'items' => [
                            [
                                'key' => 'icon',
                                'label' => '{"en":"Icon","fr":"IcÃ´ne"}',
                                'type' => 'icon',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'title',
                                'label' => '{"en":"Title","fr":"Titre"}',
                                'type' => 'i18n-text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'description',
                                'label' => '{"en":"Description","fr":"Description"}',
                                'type' => 'i18n-editor',
                                'required' => false,
                                'options' => [],
                            ],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"Our Services","fr":"Nos services"}',
                    'description' => '{"en":"What we can build for your energy and infrastructure needs.","fr":"Ce que nous pouvons construire pour vos besoins Ã©nergÃ©tiques et dâ€™infrastructure."}',
                    'cards' => [
                        [
                            'icon' => 'solar-panel',
                            'title' => '{"en":"Solar Installation","fr":"Installation solaire"}',
                            'description' => '{"en":"Design and deploy efficient solar systems.","fr":"Concevoir et dÃ©ployer des systÃ¨mes solaires performants."}',
                        ],
                        [
                            'icon' => 'bolt',
                            'title' => '{"en":"Electrical Maintenance","fr":"Maintenance Ã©lectrique"}',
                            'description' => '{"en":"Keep your electrical systems running safely.","fr":"Assurez la sÃ©curitÃ© et la performance de vos systÃ¨mes."}',
                        ],
                        [
                            'icon' => 'battery-full',
                            'title' => '{"en":"Energy Storage","fr":"Stockage dâ€™Ã©nergie"}',
                            'description' => '{"en":"Store power for peak resilience.","fr":"Stockez lâ€™Ã©nergie pour une meilleure rÃ©silience."}',
                        ],
                    ],
                ],
            ],
            'Projects' => [
                'title' => '{"en":"Projects","fr":"Projets"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'description',
                            'label' => '{"en":"Description","fr":"Description"}',
                            'type' => 'i18n-editor',
                            'required' => false,
                            'options' => [],
                        ],
                    ],
                    'projects' => [
                        'title' => '{"en":"Projects","fr":"Projets"}',
                        'items' => [
                            [
                                'key' => 'image',
                                'label' => '{"en":"Image","fr":"Image"}',
                                'type' => 'image',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'title',
                                'label' => '{"en":"Title","fr":"Titre"}',
                                'type' => 'i18n-text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'category',
                                'label' => '{"en":"Category","fr":"CatÃ©gorie"}',
                                'type' => 'text',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'description',
                                'label' => '{"en":"Description","fr":"Description"}',
                                'type' => 'i18n-editor',
                                'required' => false,
                                'options' => [],
                            ],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"Recent Projects","fr":"Projets rÃ©cents"}',
                    'description' => '{"en":"Some of the recent work we delivered.","fr":"Quelques rÃ©alisations rÃ©centes."}',
                    'projects' => [
                        [
                            'image' => '/assets/img/all-images/projects/p-img1.png',
                            'title' => '{"en":"Solar Farm","fr":"Ferme solaire"}',
                            'category' => 'Energy',
                            'description' => '{"en":"Large-scale renewable production.","fr":"Production dâ€™Ã©nergie renouvelable Ã  grande Ã©chelle."}',
                        ],
                        [
                            'image' => '/assets/img/all-images/projects/p-img2.png',
                            'title' => '{"en":"Smart Grid","fr":"RÃ©seau intelligent"}',
                            'category' => 'Infrastructure',
                            'description' => '{"en":"Modern grid modernization project.","fr":"Projet de modernisation du rÃ©seau."}',
                        ],
                    ],
                ],
            ],
            'Testimonials' => [
                'title' => '{"en":"Testimonials","fr":"TÃ©moignages"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                    ],
                    'testimonials' => [
                        'title' => '{"en":"Testimonials","fr":"TÃ©moignages"}',
                        'items' => [
                            [
                                'key' => 'author_name',
                                'label' => '{"en":"Author name","fr":"Nom de lâ€™auteur"}',
                                'type' => 'text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'author_role',
                                'label' => '{"en":"Author role","fr":"Poste"}',
                                'type' => 'text',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'author_image',
                                'label' => '{"en":"Author image","fr":"Image de lâ€™auteur"}',
                                'type' => 'image',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'content',
                                'label' => '{"en":"Content","fr":"Contenu"}',
                                'type' => 'text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'rating',
                                'label' => '{"en":"Rating","fr":"Note"}',
                                'type' => 'text',
                                'required' => false,
                                'options' => [],
                            ],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"What clients say","fr":"Ce que disent nos clients"}',
                    'testimonials' => [
                        [
                            'author_name' => 'Sarah M.',
                            'author_role' => 'Director, GreenTech',
                            'author_image' => '/assets/img/all-images/testimonial/testi-img1.png',
                            'content' => 'Great execution and reliable delivery.',
                            'rating' => 5,
                        ],
                    ],
                ],
            ],
            'FAQ' => [
                'title' => '{"en":"FAQ","fr":"FAQ"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                    ],
                    'faqs' => [
                        'title' => '{"en":"FAQs","fr":"Questions frÃ©quentes"}',
                        'items' => [
                            [
                                'key' => 'question',
                                'label' => '{"en":"Question","fr":"Question"}',
                                'type' => 'i18n-text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'answer',
                                'label' => '{"en":"Answer","fr":"RÃ©ponse"}',
                                'type' => 'i18n-editor',
                                'required' => false,
                                'options' => [],
                            ],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"Frequently Asked Questions","fr":"Questions frÃ©quemment posÃ©es"}',
                    'faqs' => [
                        [
                            'question' => '{"en":"How long does installation take?","fr":"Combien de temps dure lâ€™installation ?"}',
                            'answer' => '{"en":"Usually a few weeks depending on the scope.","fr":"GÃ©nÃ©ralement quelques semaines selon le pÃ©rimÃ¨tre."}',
                        ],
                    ],
                ],
            ],
            'Blog' => [
                'title' => '{"en":"Blog","fr":"Blog"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'description',
                            'label' => '{"en":"Description","fr":"Description"}',
                            'type' => 'i18n-editor',
                            'required' => false,
                            'options' => [],
                        ],
                    ],
                    'posts' => [
                        'title' => '{"en":"Posts","fr":"Articles"}',
                        'items' => [
                            [
                                'key' => 'image',
                                'label' => '{"en":"Image","fr":"Image"}',
                                'type' => 'image',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'title',
                                'label' => '{"en":"Title","fr":"Titre"}',
                                'type' => 'i18n-text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'excerpt',
                                'label' => '{"en":"Excerpt","fr":"Extrait"}',
                                'type' => 'i18n-textarea',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'content',
                                'label' => '{"en":"Content","fr":"Contenu"}',
                                'type' => 'i18n-editor',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'author',
                                'label' => '{"en":"Author","fr":"Auteur"}',
                                'type' => 'text',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'date',
                                'label' => '{"en":"Date","fr":"Date"}',
                                'type' => 'text',
                                'required' => false,
                                'options' => [],
                            ],
                            [
                                'key' => 'category',
                                'label' => '{"en":"Category","fr":"CatÃ©gorie"}',
                                'type' => 'text',
                                'required' => false,
                                'options' => [],
                            ],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"Latest News","fr":"DerniÃ¨res nouvelles"}',
                    'description' => '{"en":"Updates and insights from the Voltz team.","fr":"ActualitÃ©s et analyses de lâ€™Ã©quipe Voltz."}',
                    'posts' => [
                        [
                            'image' => '/assets/img/all-images/blog/blog-img1.png',
                            'title' => '{"en":"How to reduce energy costs","fr":"Comment rÃ©duire les coÃ»ts Ã©nergÃ©tiques"}',
                            'excerpt' => '{"en":"Practical tips to optimize your energy use.","fr":"Conseils pratiques pour optimiser votre consommation."}',
                            'content' => '{"en":"Energy efficiency starts with planning.","fr":"Lâ€™efficacitÃ© Ã©nergÃ©tique commence par la planification."}',
                            'author' => 'Voltz Team',
                            'date' => now()->toDateString(),
                            'category' => 'Energy',
                        ],
                    ],
                ],
            ],
            'Contact' => [
                'title' => '{"en":"Contact","fr":"Contact"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'description',
                            'label' => '{"en":"Description","fr":"Description"}',
                            'type' => 'i18n-editor',
                            'required' => false,
                            'options' => [],
                        ],
                    ],
                    'contact_info' => [
                        'title' => '{"en":"Contact information","fr":"Informations de contact"}',
                        'items' => [
                            [
                                'key' => 'type',
                                'label' => '{"en":"Type","fr":"Type"}',
                                'type' => 'text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'title',
                                'label' => '{"en":"Title","fr":"Titre"}',
                                'type' => 'text',
                                'required' => true,
                                'options' => [],
                            ],
                            [
                                'key' => 'content',
                                'label' => '{"en":"Content","fr":"Contenu"}',
                                'type' => 'text',
                                'required' => true,
                                'options' => [],
                            ],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"Get in touch","fr":"Contactez-nous"}',
                    'description' => '{"en":"Talk with our team about your next project.","fr":"Parlez avec notre Ã©quipe de votre prochain projet."}',
                    'contact_info' => [
                        [
                            'type' => 'email',
                            'title' => 'Email',
                            'content' => 'info@voltzenergy.com',
                        ],
                        [
                            'type' => 'phone',
                            'title' => 'Phone',
                            'content' => '+1 (123) 456-7890',
                        ],
                    ],
                ],
            ],
            'CTA' => [
                'title' => '{"en":"CTA","fr":"Appel Ã  lâ€™action"}',
                'data_structure' => [
                    'index' => [
                        [
                            'key' => 'title',
                            'label' => '{"en":"Title","fr":"Titre"}',
                            'type' => 'i18n-text',
                            'required' => true,
                            'options' => [],
                        ],
                        [
                            'key' => 'description',
                            'label' => '{"en":"Description","fr":"Description"}',
                            'type' => 'i18n-editor',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'button_text',
                            'label' => '{"en":"Button text","fr":"Texte du bouton"}',
                            'type' => 'i18n-text',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'button_link',
                            'label' => '{"en":"Button link","fr":"Lien du bouton"}',
                            'type' => 'text',
                            'required' => false,
                            'options' => [],
                        ],
                        [
                            'key' => 'background_image',
                            'label' => '{"en":"Background image","fr":"Image de fond"}',
                            'type' => 'image',
                            'required' => false,
                            'options' => [],
                        ],
                    ],
                ],
                'data' => [
                    'title' => '{"en":"Ready to start?","fr":"PrÃªt Ã  dÃ©marrer ?"}',
                    'description' => '{"en":"Letâ€™s launch your next energy project.","fr":"LanÃ§ons votre prochain projet Ã©nergÃ©tique."}',
                    'button_text' => '{"en":"Contact us","fr":"Nous contacter"}',
                    'button_link' => '#contact',
                    'background_image' => '/assets/img/all-images/cta/cta-img1.png',
                ],
            ],
        ];

        $page = Page::updateOrCreate(
            ['name' => 'Home'],
            [
                'title' => '{"en":"Home","fr":"Accueil"}',
                'content' => '{"en":"Voltz homepage with seeded sections","fr":"Page dâ€™accueil Voltz avec sections prÃ©remplies"}',
                'position' => 0,
                'sections_order' => array_values(array_filter(array_keys($sections), fn ($name) => $name !== 'Content')),
                'sections_disabled' => [],
            ]
        );

        foreach ($sections as $name => $sectionDefinition) {
            $section = Section::updateOrCreate(
                ['name' => $name],
                [
                    'title' => $sectionDefinition['title'],
                    'content' => null,
                    'data_structure' => $sectionDefinition['data_structure'],
                    'settings_structure' => [],
                ]
            );

            $linkId = 'default';

            PageSection::updateOrCreate(
                [
                    'section_id' => $section->id,
                    'page_id' => $page->id,
                    'link_id' => $linkId,
                ],
                [
                    'data_source_page_id' => $page->id,
                    'data_source_link_id' => $linkId,
                    'link_title' => $sectionDefinition['title'],
                    'data' => $sectionDefinition['data'],
                    'settings' => [],
                ]
            );

            $page->sections()->syncWithoutDetaching([
                $section->id => [
                    'data_source_page_id' => $page->id,
                    'data_source_link_id' => $linkId,
                    'link_id' => $linkId,
                    'link_title' => $sectionDefinition['title'],
                    'data' => $sectionDefinition['data'],
                    'settings' => [],
                ],
            ]);
        }

        $location = MenuLocation::updateOrCreate(
            ['name' => 'main'],
            [
                'title' => '{"en":"Main menu","fr":"Menu principal"}',
                'description' => '{"en":"Primary website navigation","fr":"Navigation principale du site"}',
            ]
        );

        $menu = Menu::updateOrCreate(
            ['name' => 'main'],
            [
                'menu_location_id' => $location->id,
                'title' => '{"en":"Main menu","fr":"Menu principal"}',
                'description' => '{"en":"Voltz public navigation","fr":"Navigation publique Voltz"}',
                'data' => [],
            ]
        );

        $menuItems = [
            ['title' => '{"en":"Home","fr":"Accueil"}', 'path' => '/', 'position' => 0, 'section_key' => null],
            ['title' => '{"en":"About Us","fr":"A propos"}', 'path' => '/about', 'position' => 1, 'section_key' => 'about__default'],
            ['title' => '{"en":"Services","fr":"Services"}', 'path' => '/services', 'position' => 2, 'section_key' => 'services__default'],
            ['title' => '{"en":"Projects","fr":"Projets"}', 'path' => '/projects', 'position' => 3, 'section_key' => 'projects__default'],
            ['title' => '{"en":"Blog","fr":"Blog"}', 'path' => '/blog', 'position' => 4, 'section_key' => 'blog__default'],
            ['title' => '{"en":"Contact Us","fr":"Contact"}', 'path' => '/contact', 'position' => 5, 'section_key' => 'contact__default'],
            ['title' => '{"en":"FAQ","fr":"FAQ"}', 'path' => '/faq', 'position' => 6, 'section_key' => 'faq__default'],
        ];

        foreach ($menuItems as $item) {
            MenuItem::updateOrCreate(
                [
                    'menu_id' => $menu->id,
                    'path' => $item['path'],
                ],
                [
                    'page_id' => $page->id,
                    'section_key' => $item['section_key'],
                    'title' => $item['title'],
                    'description' => null,
                    'url' => null,
                    'controller' => null,
                    'parent_id' => null,
                    'position' => $item['position'],
                    'is_active' => true,
                    'is_visible' => true,
                    'color' => null,
                    'target_type' => MenuItemTargetType::PAGE_LINK->value,
                    'content_type' => null,
                    'content_id' => null,
                    'image' => null,
                    'menu_item_type_id' => null,
                ]
            );
        }
    }
}

