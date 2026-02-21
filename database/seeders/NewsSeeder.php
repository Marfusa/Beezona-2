<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Очищаємо таблицю перед записом
        News::truncate();

        // 2. СПИСОК НОВИН З ПЕРЕКЛАДАМИ
        $newsList = [
            [
                'title' => 'Умови призначення пенсії за віком',
                'title_en' => 'Old-age pension eligibility conditions',
                'category' => 'money',
                'published_at' => '2026-02-28',
                'content' => 'Від 1 січня в Україні змінилися умови призначення пенсії за віком.',
                'content_en' => 'Since January 1, the conditions for assigning an old-age pension have changed in Ukraine.',
                'image' => 'https://img.tsn.ua/cached/129/tsn-7d69491ed57b2e0aebe0922b41d97a86/thumbs/1200x630/97/7f/eb47a7b524ad567e729d39cce8f07f97.jpeg',
                'source_name' => 'ТСН',
                'source_link' => 'https://tsn.ua/groshi/khto-moze-vyyty-na-pensiiu-za-vikom-2026-roku-umovy-zminylysia-3006155.html'
            ],
            [
                'title' => 'Безкоштовна стоматологія',
                'title_en' => 'Free dentistry',
                'category' => 'med',
                'published_at' => '2026-02-26',
                'content' => 'Старт пілотної програми лікування для учасників бойових дій.',
                'content_en' => 'Launch of a pilot treatment program for combat participants.',
                'image' => 'https://images.pexels.com/photos/3845653/pexels-photo-3845653.jpeg',
                'source_name' => 'МОЗ',
                'source_link' => 'https://moz.gov.ua/uk/bezoplatna-stomatologichna-dopomoga-dlya-zahisnikiv-i-zahisnic-programoyu-skoristalas-majzhe-70-tisyach-paciyentiv'
            ],
            [
                'title' => 'Дитячі набори',
                'title_en' => 'Childrens kits',
                'category' => 'human',
                'published_at' => '2026-02-24',
                'content' => 'Видача канцелярії, планшетів та рюкзаків для школярів-ВПО.',
                'content_en' => 'Distribution of stationery, tablets, and backpacks for IDP schoolchildren.',
                'image' => 'https://nsn.net.ua/wp-content/uploads/2026/01/photo_2026-01-26_18-00-43.jpg',
                'source_name' => 'ДеДопомога',
                'source_link' => 'https://nsn.net.ua/dehelp/other/janina-vidkryto-reiestratsiiu-na-riukzaky-z-kantseliariieiu-dlia-ditej-vpo-khto-i-iak-mozhe-podaty-zaiavku/'
            ],
            [
                'title' => 'Компенсації за майно',
                'title_en' => 'Property compensation',
                'category' => 'legal',
                'published_at' => '2026-02-21',
                'content' => 'Оновлення реєстру пошкодженого майна в Дії: нові правила.',
                'content_en' => 'Updating the register of damaged property in Diia: new rules.',
                'image' => 'https://images.pexels.com/photos/5668772/pexels-photo-5668772.jpeg',
                'source_name' => 'Дія',
                'source_link' => 'https://erecovery.diia.gov.ua/'
            ],
            [
                'title' => 'Ярмарок вакансій',
                'title_en' => 'Job fair',
                'category' => 'edu',
                'published_at' => '2026-02-18',
                'content' => 'Фестиваль Кар\'єри 21-24 травня.',
                'content_en' => 'Career Festival May 21-24.',
                'image' => 'https://career.vdng.ua/assets/img/18112025-2.jpg',
                'source_name' => 'Інформація',
                'source_link' => 'https://career.vdng.ua/'
            ],
            [
                'title' => 'Тимчасове житло',
                'title_en' => 'Temporary housing',
                'category' => 'house',
                'published_at' => '2026-02-15',
                'content' => 'Розширення модульних містечок у західних областях.',
                'content_en' => 'Expansion of modular towns in western regions.',
                'image' => 'https://city-adm.lviv.ua/img/1792x1008/2/6z7a7902-e596e76b.jpeg',
                'source_name' => 'Львівська міська рада',
                'source_link' => 'https://city-adm.lviv.ua/news/society/social-sphere/lviv-hotuie-modulni-mistechka-dlia-pereselentsiv-do-zymy/'
            ],
            [
                'title' => 'Ваучери на навчання',
                'title_en' => 'Education vouchers',
                'category' => 'edu',
                'published_at' => '2026-02-12',
                'content' => 'Програма перекваліфікації для дорослих ВПО від центру зайнятості.',
                'content_en' => 'Retraining program for adult IDPs from the employment center.',
                'image' => 'https://miskrada-ks.gov.ua/wp-content/uploads/2023/05/vaucher.jpg',
                'source_name' => 'Державна служба зайнятості',
                'source_link' => 'https://www.dcz.gov.ua/profnavch/voucher'
            ],
            [
                'title' => 'Онлайн-психологи',
                'title_en' => 'Online psychologists',
                'category' => 'psy',
                'published_at' => '2026-02-07',
                'content' => 'Запуск платформи для безкоштовних індивідуальних сесій.',
                'content_en' => 'Launch of a platform for free individual sessions.',
                'image' => 'https://res2.weblium.site/res/67f67674dea10eb193864adf/67f7a120fbc48d6a45d0157e_optimized',
                'source_name' => 'Соціальний проєкт Разом',
                'source_link' => 'https://razom.live/'
            ],
            [
                'title' => 'Виплати ВПО у лютому',
                'title_en' => 'IDP payments in February',
                'category' => 'money',
                'published_at' => '2026-02-01',
                'content' => 'Автоматичне продовження допомоги для вразливих категорій.',
                'content_en' => 'Automatic extension of aid for vulnerable categories.',
                'image' => 'https://www.pfu.gov.ua/content/uploads/2026/01/FB-Pensiyi-14.jpg',
                'source_name' => 'Пенсійний фонд України',
                'source_link' => 'https://www.pfu.gov.ua/rv/222522-prodovzhennya-vyplat-vpo-u-2026-rotsi-yakyj-dohid-daye-pravo-na-dopomogu/'
            ],
            [
                'title' => 'Грошова допомога UNHCR',
                'title_en' => 'UNHCR cash assistance',
                'category' => 'money',
                'published_at' => '2026-01-28',
                'content' => '3600 грн на особу для вразливих категорій ВПО.',
                'content_en' => 'UAH 3,600 per person for vulnerable categories of IDPs.',
                'image' => 'https://enovosty.com/wp-content/uploads/2025/08/iiprgczfzpthuzrfnzecwpt6nx7odylh.jpg',
                'source_name' => 'UNHCR',
                'source_link' => 'https://help.unhcr.org/ukraine/uk/ukraine-uk-where-to-seek-help-ua/multi-purpose-cash-assistance-programme-for-idps/'
            ],
        ];

        // 3. Записуємо в базу
        foreach ($newsList as $item) {
            News::create($item);
        }
    }
}