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

/**
 * Source unique de contenu du site — données adaptées de KYA-Energy Group (Lomé, Togo).
 * https://kya-energy.com — énergie solaire, groupes électrogènes KYA-SoP, ingénierie.
 *
 * Modifier ce fichier puis relancer : php artisan voltz:seed
 */
class VoltzTemplateSeeder extends Seeder
{
    private const LINK_ID = 'default';

    private const COMPANY = 'KYA-Energy Group';

    private const EMAIL = 'info@kya-energy.com';

    private const PHONE = '+228 99 90 33 49';

    private const PHONE_ALT = '+228 99 99 44 96';

    private const ADDRESS_FR = '300 m, rue en face du Centre Culturel Loyola (CCL), Route Mission Tové, Agoè Logopé, Lomé — 08 BP 81101';

    private const ADDRESS_EN = '300m opposite Loyola Cultural Center (CCL), Mission Tové Road, Agoè Logopé, Lomé — P.O. Box 08 BP 81101';

    private const MAP_EMBED = 'https://maps.google.com/maps?q=Centre+Culturel+Loyola+Ago%C3%A8+Logop%C3%A9+Lom%C3%A9+Togo&hl=fr&z=15&output=embed';

    private function t(string $en, ?string $fr = null): string
    {
        return json_encode(['en' => $en, 'fr' => $fr ?? $en], JSON_UNESCAPED_UNICODE);
    }

    public function run(): void
    {
        $this->seedAppInformation();

        $sections = $this->sectionsDefinition();

        $page = Page::updateOrCreate(
            ['name' => 'Home'],
            [
                'title' => $this->t('Home', 'Accueil'),
                'content' => $this->t(
                    'KYA-Energy Group — solar energy solutions in Togo and West Africa',
                    'KYA-Energy Group — solutions solaires au Togo et en Afrique de l Ouest'
                ),
                'position' => 0,
                'sections_order' => array_keys($sections),
                'sections_disabled' => [],
            ]
        );

        $syncPayload = [];

        foreach ($sections as $name => $definition) {
            $section = Section::updateOrCreate(
                ['name' => $name],
                [
                    'title' => $definition['title'],
                    'content' => null,
                    'data_structure' => $definition['data_structure'],
                    'settings_structure' => [],
                ]
            );

            PageSection::updateOrCreate(
                [
                    'section_id' => $section->id,
                    'page_id' => $page->id,
                    'link_id' => self::LINK_ID,
                ],
                [
                    'data_source_page_id' => $page->id,
                    'data_source_link_id' => self::LINK_ID,
                    'link_title' => $definition['title'],
                    'data' => $definition['data'],
                    'settings' => [],
                ]
            );

            $syncPayload[$section->id] = [
                'data_source_page_id' => $page->id,
                'data_source_link_id' => self::LINK_ID,
                'link_id' => self::LINK_ID,
                'link_title' => $definition['title'],
            ];
        }

        // Remplace toutes les sections de Home (retire Content Creopse par défaut, etc.)
        $page->sections()->sync($syncPayload);

        $this->seedMenus($page);
    }

    private function seedAppInformation(): void
    {
        $values = [
            'name' => self::COMPANY,
            'description' => $this->t(
                'Togolese leader in solar energy since 2015. Design, assembly and installation of KYA-SoP systems — ISO 9001:2015 certified.',
                'Leader togolais de l energie solaire depuis 2015. Conception, assemblage et installation de groupes KYA-SoP — certifie ISO 9001:2015.'
            ),
            'icon' => '/assets/img/logo/fav-logo1.png',
            'logo' => '/assets/img/logo/logo1.png',
            'email' => self::EMAIL,
            'phone' => self::PHONE,
            'address' => $this->t(self::ADDRESS_EN, self::ADDRESS_FR),
        ];

        foreach ($values as $key => $value) {
            AppInformation::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    private function seedMenus(Page $page): void
    {
        $location = MenuLocation::updateOrCreate(
            ['name' => 'main'],
            ['description' => $this->t('Primary website navigation', 'Navigation principale du site')]
        );

        $menu = Menu::updateOrCreate(
            ['name' => 'main'],
            [
                'menu_location_id' => $location->id,
                'title' => $this->t('Main menu', 'Menu principal'),
                'description' => $this->t('KYA-Energy public navigation', 'Navigation publique KYA-Energy'),
                'data' => [],
            ]
        );

        // Repartir d'un menu propre à chaque seed (évite les doublons si les paths changent)
        $menu->items()->delete();

        $items = [
            ['title' => $this->t('Home', 'Accueil'), 'path' => '/', 'position' => 0],
            ['title' => $this->t('About Us', 'A propos'), 'path' => '/about', 'position' => 1],
            ['title' => $this->t('Services', 'Services'), 'path' => '/services', 'position' => 2],
            ['title' => $this->t('Projects', 'Projets'), 'path' => '/projects', 'position' => 3],
            ['title' => $this->t('Blog', 'Blog'), 'path' => '/blog', 'position' => 4],
            ['title' => $this->t('Contact Us', 'Contact'), 'path' => '/#contact', 'position' => 5],
            ['title' => $this->t('FAQ', 'FAQ'), 'path' => '/faq', 'position' => 6],
        ];

        foreach ($items as $item) {
            MenuItem::create(
                [
                    'menu_id' => $menu->id,
                    'page_id' => $page->id,
                    'section_key' => null,
                    'title' => $item['title'],
                    'description' => null,
                    'path' => $item['path'],
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

    private function heroSlide(): array
    {
        return [
            'title' => $this->t(
                'Power Your Home and Business with Solar Energy!',
                'Alimentez votre maison et votre entreprise avec l energie solaire !'
            ),
            'description' => $this->t(
                'Since 2015, KYA-Energy Group designs and assembles intelligent solar systems in Togo. Reliable, affordable and ISO 9001:2015 certified solutions for households, SMEs and institutions across West Africa.',
                'Depuis 2015, KYA-Energy Group concoit et assemble des systemes solaires intelligents au Togo. Des solutions fiables, accessibles et certifiees ISO 9001:2015 pour les menages, PME et institutions en Afrique de l Ouest.'
            ),
            'image' => '/assets/img/all-images/hero/hero-img1.png',
            'background_image' => '/assets/img/all-images/bg/hero-bg1.png',
            'primary_text' => $this->t('Discover Our Solutions', 'Decouvrir nos solutions'),
            'primary_link' => '/services',
            'secondary_text' => $this->t('About KYA-Energy', 'A propos de KYA-Energy'),
            'secondary_link' => '/about',
        ];
    }

    private function sectionsDefinition(): array
    {
        $heroSlide = $this->heroSlide();

        $testimonials = [
            [
                'author_name' => 'Kossi Mensah',
                'author_role' => $this->t('SME Owner, Lomé', 'Chef d entreprise, Lome'),
                'content' => $this->t(
                    '"Our KYA-SoP system keeps our shop running during CEET outages. Installation was fast and the after-sales team responds within 24 hours. A solid investment for any Togolese business."',
                    '"Notre groupe KYA-SoP maintient notre commerce en activite pendant les coupures de la CEET. Installation rapide et equipe SAV reactive sous 24 h. Un investissement solide pour toute entreprise togolaise."'
                ),
            ],
            [
                'author_name' => 'Afiwa Koffi',
                'author_role' => $this->t('Homeowner, Kara', 'Proprietaire, Kara'),
                'content' => $this->t(
                    '"We finally have stable electricity at home. KYA-Energy sized our system perfectly and explained every step. Our bills dropped and the children can study in the evening without worry."',
                    '"Nous avons enfin une electricite stable a la maison. KYA-Energy a parfaitement dimensionne notre installation et tout nous a ete explique. Nos factures ont baisse et les enfants peuvent reviser le soir sans souci."'
                ),
            ],
            [
                'author_name' => 'Dr. Komlan Adjei',
                'author_role' => $this->t('Health Center Director', 'Directeur de centre de sante'),
                'content' => $this->t(
                    '"Solar electrification changed our daily operations: vaccines stay cold, deliveries happen at night, and patients are safer. KYA-Energy understands the needs of rural health facilities."',
                    '"L electrification solaire a transforme notre quotidien : vaccins conserves, accouchements de nuit possibles, patients en securite. KYA-Energy comprend les besoins des centres de sante ruraux."'
                ),
            ],
            [
                'author_name' => 'Mawuli Agbessi',
                'author_role' => $this->t('Farm Manager, Plateaux', 'Responsable d exploitation, Plateaux'),
                'content' => $this->t(
                    '"Solar pumping for our poultry farm was a game-changer. KYA-SoP B runs our equipment reliably. Local assembly in Lomé means spare parts and maintenance are always close."',
                    '"Le pompage solaire pour notre ferme avicole a tout change. Le KYA-SoP B alimente nos equipements de facon fiable. L assemblage local a Lome garantit pieces et maintenance a proximite."'
                ),
            ],
            [
                'author_name' => 'Selom Akakpo',
                'author_role' => $this->t('Institution Manager', 'Responsable institutionnel'),
                'content' => $this->t(
                    '"From energy audit to turnkey installation, the KYA-Energy engineering team delivered on time. ISO certification gives us confidence for our donor-funded solar project."',
                    '"De l audit energetique a l installation cle en main, l equipe ingenierie KYA-Energy a respecte les delais. La certification ISO nous rassure pour notre projet solaire finance par bailleurs."'
                ),
            ],
            [
                'author_name' => 'Edem Lawson',
                'author_role' => $this->t('Ecobank Client, Lomé', 'Client Ecobank, Lome'),
                'content' => $this->t(
                    '"Thanks to bank financing partnered with KYA-Energy, we acquired our solar generator with manageable monthly payments. Clean energy is now accessible for our growing business."',
                    '"Grace au financement bancaire en partenariat avec KYA-Energy, nous avons acquis notre groupe solaire avec des mensualites adaptees. L energie propre est enfin accessible pour notre activite."'
                ),
            ],
        ];

        return [
            'Header' => [
                'title' => $this->t('Header', 'En-tete'),
                'data_structure' => ['index' => [
                    ['key' => 'logo', 'label' => $this->t('Logo'), 'type' => 'image', 'required' => false, 'options' => []],
                    ['key' => 'address', 'label' => $this->t('Address', 'Adresse'), 'type' => 'i18n-text', 'required' => false, 'options' => []],
                    ['key' => 'email', 'label' => $this->t('Email'), 'type' => 'text', 'required' => false, 'options' => []],
                    ['key' => 'phone', 'label' => $this->t('Phone', 'Telephone'), 'type' => 'text', 'required' => false, 'options' => []],
                    ['key' => 'cta_text', 'label' => $this->t('CTA text'), 'type' => 'i18n-text', 'required' => false, 'options' => []],
                    ['key' => 'cta_link', 'label' => $this->t('CTA link'), 'type' => 'text', 'required' => false, 'options' => []],
                ]],
                'data' => [
                    'index' => [
                        'logo' => '/assets/img/logo/logo1.png',
                        'address' => $this->t(self::ADDRESS_EN, self::ADDRESS_FR),
                        'email' => self::EMAIL,
                        'phone' => self::PHONE,
                        'cta_text' => $this->t('Request a Quote', 'Demander un devis'),
                        'cta_link' => '/#contact',
                    ],
                ],
            ],
            'HeroBanner' => [
                'title' => $this->t('Hero Banner', 'Banniere principale'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title', 'Titre'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ]],
                'data' => [
                    'index' => [
                        'title' => $heroSlide['title'],
                        'description' => $heroSlide['description'],
                        'image' => $heroSlide['image'],
                        'background_image' => $heroSlide['background_image'],
                        'cta_text' => $heroSlide['primary_text'],
                        'cta_link' => $heroSlide['primary_link'],
                        'secondary_cta_text' => $heroSlide['secondary_text'],
                        'secondary_cta_link' => $heroSlide['secondary_link'],
                    ],
                    'slides' => [$heroSlide, $heroSlide, $heroSlide],
                ],
            ],
            'Features' => [
                'title' => $this->t('Features', 'Atouts'),
                'data_structure' => ['index' => [
                    ['key' => 'background_image', 'label' => $this->t('Background', 'Fond'), 'type' => 'image', 'required' => false, 'options' => []],
                ], 'items' => ['title' => $this->t('Feature boxes'), 'items' => [
                    ['key' => 'icon', 'label' => $this->t('Icon'), 'type' => 'image', 'required' => false, 'options' => []],
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                    ['key' => 'link', 'label' => $this->t('Link'), 'type' => 'text', 'required' => false, 'options' => []],
                ]]],
                'data' => [
                    'index' => ['background_image' => '/assets/img/all-images/bg/ot-bg1.png'],
                    'items' => [
                        ['icon' => '/assets/img/icons/ot-icons1.svg', 'title' => $this->t('500+ Certified Solar Installations in West Africa', 'Plus de 500 installations solaires certifiees en Afrique de l Ouest'), 'link' => '/projects'],
                        ['icon' => '/assets/img/icons/ot-icons2.svg', 'title' => $this->t('1st ISO 9001:2015 Certified Solar Company in Togo', '1ere entreprise solaire certifiee ISO 9001:2015 au Togo'), 'link' => '/about'],
                        ['icon' => '/assets/img/icons/ot-icons3.svg', 'title' => $this->t('Designed & Assembled Locally in Lomé', 'Concu et assemble localement a Lome'), 'link' => '/services'],
                        ['icon' => '/assets/img/icons/ot-icons4.svg', 'title' => $this->t('24/7 Maintenance — Intervention Within 24 Hours', 'Maintenance 24 h/24 — intervention garantie sous 24 h'), 'link' => '/services'],
                    ],
                ],
            ],
            'About' => [
                'title' => $this->t('About', 'A propos'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ]],
                'data' => [
                    'index' => [
                        'subtitle' => $this->t('About KYA-Energy Group', 'A propos de KYA-Energy Group'),
                        'title' => $this->t('Accelerating Energy Access Across Africa', 'Accelerer l acces a l energie en Afrique'),
                        'description' => $this->t(
                            'KYA-Energy Group is an international company specialized in renewable energy and energy efficiency. Since 2015, we design, assemble and distribute KYA-SoP electrosolar units for households and productive uses — helping meet Africa\'s electrification challenge sustainably.',
                            'KYA-Energy Group est une entreprise internationale specialisee dans les energies renouvelables et l efficacite energetique. Depuis 2015, nous concevons, assemblons et distribuons des groupes electrosolaires KYA-SoP pour les menages et usages productifs — pour relever le defi de l electrification en Afrique.'
                        ),
                        'image' => '/assets/img/all-images/about/about-img1.png',
                        'metric_value' => '500',
                        'metric_label' => $this->t('Installations Delivered', 'Installations realisees'),
                        'button_text' => $this->t('Learn More', 'En savoir plus'),
                        'button_link' => '/about',
                    ],
                    'highlights' => [
                        [
                            'icon' => '/assets/img/icons/a-icons1.svg',
                            'title' => $this->t('KYA-SoP: Intelligent Solar Power Units', 'KYA-SoP : groupes electrosolaires intelligents'),
                            'text' => $this->t(
                                'From KYA-SoP M for homes to KYA-SoP B for businesses, our locally assembled systems offer industrial reliability and total autonomy for irrigation, SMEs, schools and health centers.',
                                'Du KYA-SoP M pour les menages au KYA-SoP B pour les entreprises, nos systemes assembles localement offrent fiabilite industrielle et autonomie totale pour irrigation, PME, ecoles et centres de sante.'
                            ),
                            'link' => '/services',
                        ],
                        [
                            'icon' => '/assets/img/icons/a-icons1.svg',
                            'title' => $this->t('End-to-End Engineering & Support', 'Ingenierie et accompagnement de bout en bout'),
                            'text' => $this->t(
                                'Energy audit, custom sizing with KYA-SolDesign, turnkey installation in 1–3 days for households, plus 24/7 monitoring and preventive maintenance across Togo and the sub-region.',
                                'Audit energetique, dimensionnement sur mesure avec KYA-SolDesign, installation cle en main en 1 a 3 jours pour les menages, plus suivi et maintenance preventive 24 h/24 au Togo et dans la sous-region.'
                            ),
                            'link' => '/services',
                        ],
                    ],
                ],
            ],
            'Services' => [
                'title' => $this->t('Services', 'Services'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ], 'cards' => ['title' => $this->t('Cards'), 'items' => [
                    ['key' => 'icon', 'label' => $this->t('Icon'), 'type' => 'image', 'required' => false, 'options' => []],
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                    ['key' => 'description', 'label' => $this->t('Description'), 'type' => 'i18n-editor', 'required' => false, 'options' => []],
                ]]],
                'data' => [
                    'index' => [
                        'subtitle' => $this->t('Our SERVICES', 'Nos SERVICES'),
                        'title' => $this->t('Solar Solutions for Every Need', 'Solutions solaires pour chaque besoin'),
                    ],
                    'cards' => [
                        [
                            'icon' => '/assets/img/icons/s-icons1.svg',
                            'image' => '/assets/img/all-images/service/s-img1.png',
                            'title' => $this->t('KYA-SoP — Residential & Business Solar Units', 'KYA-SoP — groupes solaires menages et entreprises'),
                            'description' => $this->t(
                                'Intelligent electrosolar groups assembled in Togo: KYA-SoP M for homes, KYA-SoP B for productive use (irrigation, SMEs, shops). Financing available through banking partners.',
                                'Groupes electrosolaires intelligents assembles au Togo : KYA-SoP M pour les menages, KYA-SoP B pour usages productifs (irrigation, PME, commerces). Financement possible via partenaires bancaires.'
                            ),
                            'link' => '/services',
                            'link_text' => $this->t('Learn More', 'En savoir plus'),
                        ],
                        [
                            'icon' => '/assets/img/icons/s-icons2.svg',
                            'image' => '/assets/img/all-images/service/s-img1.png',
                            'title' => $this->t('Engineering, Audit & Turnkey Installation', 'Ingenierie, audit et installation cle en main'),
                            'description' => $this->t(
                                'From feasibility study to commissioning: energy audits, KYA-SolDesign sizing, off-grid and hybrid installations for health centers, schools, farms and institutions.',
                                'De l etude de faisabilite a la mise en service : audits energetiques, dimensionnement KYA-SolDesign, installations hors reseau et hybrides pour centres de sante, ecoles, fermes et institutions.'
                            ),
                            'link' => '/services',
                            'link_text' => $this->t('Learn More', 'En savoir plus'),
                        ],
                        [
                            'icon' => '/assets/img/icons/s-icons3.svg',
                            'image' => '/assets/img/all-images/service/s-img1.png',
                            'title' => $this->t('Maintenance, Monitoring & Solar Street Lighting', 'Maintenance, suivi et eclairage public solaire'),
                            'description' => $this->t(
                                '24/7 preventive maintenance with guaranteed intervention within 24 hours. Lithium batteries, all-in-one street lights and KYA-Flexy remote monitoring for lasting performance.',
                                'Maintenance preventive 24 h/24 avec intervention garantie sous 24 h. Batteries lithium, lampadaires tout-en-un et suivi a distance KYA-Flexy pour une performance durable.'
                            ),
                            'link' => '/services',
                            'link_text' => $this->t('Learn More', 'En savoir plus'),
                        ],
                    ],
                ],
            ],
            'Projects' => [
                'title' => $this->t('Projects', 'Projets'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ], 'projects' => ['title' => $this->t('Projects'), 'items' => [
                    ['key' => 'image', 'label' => $this->t('Image'), 'type' => 'image', 'required' => false, 'options' => []],
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ]]],
                'data' => [
                    'index' => [
                        'subtitle' => $this->t('Our Projects', 'Nos projets'),
                        'title' => $this->t('Solar Energy at Work in Togo', 'L energie solaire en action au Togo'),
                    ],
                    'projects' => [
                        ['image' => '/assets/img/all-images/projects/p-img1.png', 'title' => $this->t('Electrification of 314 Rural Health Centers', 'Electrification de 314 centres de sante ruraux'), 'category' => $this->t('Institutional — USAID', 'Institutionnel — USAID'), 'link' => '/projects'],
                        ['image' => '/assets/img/all-images/projects/p-img2.png', 'title' => $this->t('7 Mini Power Plants — Togolese Armed Forces', '7 mini centrales — Forces armees togolaises'), 'category' => $this->t('86.4 kWp — Savanes Region', '86,4 kWc — Region des Savanes'), 'link' => '/projects'],
                        ['image' => '/assets/img/all-images/projects/p-img4.png', 'title' => $this->t('8 Hybrid Mini Power Plants', '8 mini centrales hybrides'), 'category' => $this->t('Off-grid electrification', 'Electrification hors reseau'), 'link' => '/projects'],
                        ['image' => '/assets/img/all-images/projects/p-img5.png', 'title' => $this->t('Regional Solar Academies — African Development Bank', 'Academies solaires regionales — Banque africaine de developpement'), 'category' => $this->t('Training & capacity building', 'Formation et renforcement de capacites'), 'link' => '/projects'],
                        ['image' => '/assets/img/all-images/projects/p-img3.png', 'title' => $this->t('Ecobank Green Financing — KYA-SoP Access', 'Financement vert Ecobank — acces aux KYA-SoP'), 'category' => $this->t('SME & household financing', 'Financement PME et menages'), 'link' => '/projects'],
                    ],
                ],
            ],
            'Testimonials' => [
                'title' => $this->t('Testimonials', 'Temoignages'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ], 'testimonials' => ['title' => $this->t('Testimonials'), 'items' => [
                    ['key' => 'author_name', 'label' => $this->t('Author'), 'type' => 'text', 'required' => true, 'options' => []],
                    ['key' => 'content', 'label' => $this->t('Content'), 'type' => 'text', 'required' => true, 'options' => []],
                ]]],
                'data' => [
                    'index' => [
                        'subtitle' => $this->t('Testimonials'),
                        'title' => $this->t('Testimonials Powering Success'),
                    ],
                    'testimonials' => collect($testimonials)->values()->map(fn (array $item, int $i) => [
                        'author_name' => $item['author_name'],
                        'author_role' => $item['author_role'],
                        'author_image' => '/assets/img/all-images/testimonial/testi-img'.($i + 1).'.png',
                        'content' => $item['content'],
                        'rating' => 5,
                    ])->all(),
                ],
            ],
            'FAQ' => [
                'title' => $this->t('FAQ', 'FAQ'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ], 'faqs' => ['title' => $this->t('FAQs'), 'items' => [
                    ['key' => 'question', 'label' => $this->t('Question'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                    ['key' => 'answer', 'label' => $this->t('Answer'), 'type' => 'i18n-editor', 'required' => false, 'options' => []],
                ]]],
                'data' => [
                    'index' => [
                        'subtitle' => $this->t('FAQ'),
                        'title' => $this->t('Energy Solutions Explained'),
                    ],
                    'faqs' => [
                        [
                            'question' => $this->t('What is a KYA-SoP and who is it for?', 'Qu est-ce qu un KYA-SoP et pour qui est-il concu ?'),
                            'answer' => $this->t(
                                'KYA-SoP is an intelligent electrosolar unit designed and assembled in Togo. KYA-SoP M suits households; KYA-SoP B targets businesses, irrigation, shops and productive activities. Each system is sized with KYA-SolDesign for your actual consumption.',
                                'Le KYA-SoP est un groupe electrosolaire intelligent concu et assemble au Togo. Le KYA-SoP M convient aux menages ; le KYA-SoP B cible entreprises, irrigation, commerces et activites productives. Chaque systeme est dimensionne avec KYA-SolDesign selon votre consommation reelle.'
                            ),
                        ],
                        [
                            'question' => $this->t('How long does installation take?', 'Combien de temps dure une installation ?'),
                            'answer' => $this->t(
                                'For households, our ISO 9001:2015 certified teams typically complete turnkey installation in 1 to 3 days. Larger institutional or off-grid projects are scheduled after a technical audit and feasibility study.',
                                'Pour les menages, nos equipes certifiees ISO 9001:2015 realisent l installation cle en main en 1 a 3 jours en general. Les projets institutionnels ou hors reseau plus importants sont planifies apres audit technique et etude de faisabilite.'
                            ),
                        ],
                        [
                            'question' => $this->t('Can I finance my solar system in Togo?', 'Puis-je financer mon systeme solaire au Togo ?'),
                            'answer' => $this->t(
                                'Yes. KYA-Energy partners with banks such as Ecobank Togo to offer green financing for KYA-SoP acquisition. Eligible businesses and households can access tailored loans with attractive conditions.',
                                'Oui. KYA-Energy s associe a des banques comme Ecobank Togo pour proposer un financement vert a l acquisition de KYA-SoP. Menages et entreprises eligibles peuvent acceder a des prets adaptes a des conditions attractives.'
                            ),
                        ],
                        [
                            'question' => $this->t('What maintenance and warranty do you provide?', 'Quelle maintenance et quelle garantie proposez-vous ?'),
                            'answer' => $this->t(
                                'We provide preventive maintenance and 24/7 technical support with guaranteed intervention within 24 hours in Togo. Components are selected for African climate conditions and our processes follow ISO 9001:2015 quality standards.',
                                'Nous assurons maintenance preventive et support technique 24 h/24 avec intervention garantie sous 24 h au Togo. Les composants sont choisis pour les conditions climatiques africaines et nos processus suivent les normes qualite ISO 9001:2015.'
                            ),
                        ],
                        [
                            'question' => $this->t('Do you work outside Lomé?', 'Intervenez-vous en dehors de Lome ?'),
                            'answer' => $this->t(
                                'Yes. KYA-Energy Group operates across Togo and West Africa (Niger, Burkina Faso and the sub-region). Contact us at '.self::PHONE.' or '.self::EMAIL.' for a remote pre-study or on-site audit.',
                                'Oui. KYA-Energy Group intervient dans tout le Togo et en Afrique de l Ouest (Niger, Burkina Faso et sous-region). Contactez-nous au '.self::PHONE.' ou '.self::EMAIL.' pour une pre-etude a distance ou un audit sur site.'
                            ),
                        ],
                    ],
                ],
            ],
            'Blog' => [
                'title' => $this->t('Blog', 'Blog'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ], 'posts' => ['title' => $this->t('Posts'), 'items' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ]]],
                'data' => [
                    'index' => [
                        'subtitle' => $this->t('BLOG & News'),
                        'title' => $this->t('Smarter Power Brighter Future!'),
                    ],
                    'posts' => [
                        [
                            'image' => '/assets/img/all-images/blog/blog-img1.png',
                            'title' => $this->t('Solar Energy in Togo: What You Need to Know', 'Energie solaire au Togo : l essentiel a savoir'),
                            'excerpt' => $this->t(
                                'With frequent CEET outages and rising tariffs, solar is becoming essential for Togolese households and businesses. Discover how KYA-SoP systems offer a reliable alternative.',
                                'Face aux coupures de la CEET et a la hausse des tarifs, le solaire devient indispensable pour les menages et entreprises togolais. Decouvrez comment les KYA-SoP offrent une alternative fiable.'
                            ),
                            'author' => 'KYA-Energy Team',
                            'date' => 'Jan 24, 2025',
                            'link' => '/blog',
                        ],
                        [
                            'image' => '/assets/img/all-images/blog/blog-img2.png',
                            'title' => $this->t('KYA-Energy Wins AFSIA Best C&I Project 2025', 'KYA-Energy laureat du meilleur projet C&I AFSIA 2025'),
                            'excerpt' => $this->t(
                                'Our locally assembled KYA-SoP solution and innovative bank financing model were recognized at the Renewable Energy Forum for Africa in Accra.',
                                'Notre solution KYA-SoP assemblee localement et notre modele de financement bancaire innovant ont ete reconnus au Renewable Energy Forum for Africa a Accra.'
                            ),
                            'author' => 'KYA-Energy Team',
                            'date' => 'Jan 22, 2025',
                            'link' => '/blog',
                        ],
                        [
                            'image' => '/assets/img/all-images/blog/blog-img3.png',
                            'title' => $this->t('ISO 9001:2015 — Why Certification Matters for Solar', 'ISO 9001:2015 — pourquoi la certification compte pour le solaire'),
                            'excerpt' => $this->t(
                                'As the first ISO 9001:2015 certified solar company in Togo, KYA-Energy guarantees rigorous quality at every step: audit, design, assembly, installation and maintenance.',
                                'Premiere entreprise solaire certifiee ISO 9001:2015 au Togo, KYA-Energy garantit une qualite rigoureuse a chaque etape : audit, conception, assemblage, installation et maintenance.'
                            ),
                            'author' => 'KYA-Energy Team',
                            'date' => 'Feb 15, 2025',
                            'link' => '/blog',
                        ],
                    ],
                ],
            ],
            'Contact' => [
                'title' => $this->t('Contact', 'Contact'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ]],
                'data' => [
                    'index' => [
                        'subtitle' => $this->t('CONTACT US', 'CONTACTEZ-NOUS'),
                        'title' => $this->t('Let\'s Talk About Your Solar Project', 'Parlons de votre projet solaire'),
                        'form_title' => $this->t('Send Us a Message', 'Envoyez-nous un message'),
                        'description' => $this->t(
                            'Whether you are an individual, business or institution, our engineers respond within 24 business hours. Call us at '.self::PHONE.' or WhatsApp '.self::PHONE_ALT.'.',
                            'Particulier, entreprise ou institution : nos ingenieurs repondent sous 24 h ouvrables. Appelez le '.self::PHONE.' ou WhatsApp '.self::PHONE_ALT.'.'
                        ),
                        'map_embed' => self::MAP_EMBED,
                    ],
                ],
            ],
            'CTA' => [
                'title' => $this->t('CTA', 'Appel a l action'),
                'data_structure' => ['index' => [
                    ['key' => 'title', 'label' => $this->t('Title'), 'type' => 'i18n-text', 'required' => true, 'options' => []],
                ]],
                'data' => [
                    'index' => [
                        'title' => $this->t('Reliable Solar Power for Your Home and Business!', 'Une energie solaire fiable pour votre maison et votre entreprise !'),
                        'description' => $this->t(
                            'No more blackouts, no more energy worries! KYA-Energy ensures uninterrupted power with systems designed and assembled in Togo. Request your free energy audit today.',
                            'Fini les coupures et le stress energetique ! KYA-Energy assure une alimentation continue avec des systemes concus et assembles au Togo. Demandez votre audit energetique gratuit.'
                        ),
                        'button_text' => $this->t('Request an Audit', 'Demander un audit'),
                        'button_link' => '/#contact',
                        'image' => '/assets/img/all-images/cta/cta-img1.png',
                    ],
                ],
            ],
            'Footer' => [
                'title' => $this->t('Footer', 'Pied de page'),
                'data_structure' => ['index' => [
                    ['key' => 'logo', 'label' => $this->t('Logo'), 'type' => 'image', 'required' => false, 'options' => []],
                ]],
                'data' => [
                    'index' => [
                        'logo' => '/assets/img/logo/logo1.png',
                        'description' => $this->t(
                            'KYA-Energy Group — major player in renewable energy in West Africa since 2015. Technological innovation, technical reliability and economic accessibility for a sustainable energy transition.',
                            'KYA-Energy Group — acteur majeur des energies renouvelables en Afrique de l Ouest depuis 2015. Innovation technologique, fiabilite technique et accessibilite economique pour une transition energetique durable.'
                        ),
                        'address' => $this->t(self::ADDRESS_EN, self::ADDRESS_FR),
                        'phone' => self::PHONE,
                        'email' => self::EMAIL,
                        'copyright' => $this->t('© 2025 KYA-Energy Group. All Rights Reserved.', '© 2025 KYA-Energy Group. Tous droits reserves.'),
                        'quick_links_title' => $this->t('Quick Links', 'Liens rapides'),
                        'service_links_title' => $this->t('Our Services', 'Nos services'),
                        'contact_title' => $this->t('Contact Us', 'Contactez-nous'),
                    ],
                    'quick_links' => [
                        ['title' => $this->t('Home', 'Accueil'), 'url' => '/'],
                        ['title' => $this->t('About Us', 'A propos'), 'url' => '/about'],
                        ['title' => $this->t('Services', 'Services'), 'url' => '/services'],
                        ['title' => $this->t('Projects', 'Projets'), 'url' => '/projects'],
                        ['title' => $this->t('Blog', 'Blog'), 'url' => '/blog'],
                    ],
                    'service_links' => [
                        ['title' => $this->t('KYA-SoP Solar Units', 'Groupes solaires KYA-SoP'), 'url' => '/services'],
                        ['title' => $this->t('Energy Audit & Installation', 'Audit et installation'), 'url' => '/services'],
                        ['title' => $this->t('Maintenance 24/7', 'Maintenance 24 h/24'), 'url' => '/services'],
                        ['title' => $this->t('Contact Us', 'Contactez-nous'), 'url' => '/#contact'],
                        ['title' => $this->t('FAQ', 'FAQ'), 'url' => '/faq'],
                    ],
                ],
            ],
        ];
    }
}
