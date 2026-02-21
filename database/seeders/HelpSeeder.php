<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Help;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HelpSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Тимчасово вимикаємо перевірку зовнішніх ключів
        Schema::disableForeignKeyConstraints();

        // 2. Очищаємо таблиці (спочатку таблицю зв'язків "обране", потім основну)
        DB::table('help_user')->truncate();
        Help::truncate();

        // 3. Вмикаємо перевірку назад
        Schema::enableForeignKeyConstraints();

        $helps = [
            // ================= КИЇВ =================
            ['city' => 'Київ', 'category' => 'money', 'title' => 'єДопомога', 'title_en' => 'eDopomoga', 'description' => 'державні виплати', 'description_en' => 'government payments', 'link' => 'https://aid.edopomoga.gov.ua'],
            ['city' => 'Київ', 'category' => 'money', 'title' => 'UNHCR', 'title_en' => 'UNHCR', 'description' => 'реєстрація на виплати', 'description_en' => 'registration for payments', 'link' => 'https://help.unhcr.org/ukraine/uk/'],
            ['city' => 'Київ', 'category' => 'human', 'title' => 'Спілка Поруч', 'title_en' => 'Poruch Union', 'description' => 'продуктові набори', 'description_en' => 'food packages', 'link' => 'https://to4ka.fun/volonterska-spilka-poruch-prezentuie-vlasni-produktovi-nabory-dlia-vpo-kyieva/'],
            ['city' => 'Київ', 'category' => 'human', 'title' => 'Карітас Київ', 'title_en' => 'Caritas Kyiv', 'description' => 'гуманітарна допомога', 'description_en' => 'humanitarian aid', 'link' => 'https://caritas.kyiv.ua/'],
            ['city' => 'Київ', 'category' => 'human', 'title' => 'Соціальний хаб "Кенгураш"', 'title_en' => 'Social Hub Kengurush', 'description' => 'одяг та речі', 'description_en' => 'clothing and items', 'link' => 'https://kengurush.org.ua/'],
            ['city' => 'Київ', 'category' => 'psy', 'title' => 'Veteran Hub', 'title_en' => 'Veteran Hub', 'description' => 'підтримка ветеранів', 'description_en' => 'veteran support', 'link' => 'https://veteranhub.com.ua'],
            ['city' => 'Київ', 'category' => 'psy', 'title' => 'Соціальний проєкт Разом', 'title_en' => 'Social Project Together', 'description' => 'психологічна допомога', 'description_en' => 'psychological help', 'link' => 'https://razom.live/'],
            ['city' => 'Київ', 'category' => 'psy', 'title' => 'Право на захист', 'title_en' => 'Right to Protection', 'description' => 'юридичні консультації', 'description_en' => 'legal consultations', 'link' => 'https://r2p.org.ua/'],

            // ================= ЛЬВІВ =================
            ['city' => 'Львів', 'category' => 'money', 'title' => 'Карітас Львів', 'title_en' => 'Caritas Lviv', 'description' => 'грошові гранти', 'description_en' => 'cash grants', 'link' => 'https://caritas-lviv.org/'],
            ['city' => 'Львів', 'category' => 'money', 'title' => 'Червоний Хрест', 'title_en' => 'Red Cross', 'description' => 'фінансова допомога', 'description_en' => 'financial aid', 'link' => 'https://redcross.org.ua/tag/lviv/'],
            ['city' => 'Львів', 'category' => 'money', 'title' => 'ЦНАП м.Львів', 'title_en' => 'Lviv ASC', 'description' => 'фінансова допомога', 'description_en' => 'financial assistance', 'link' => 'https://cnap.city-adm.lviv.ua/'],
            ['city' => 'Львів', 'category' => 'human', 'title' => 'Гуманітарний штаб', 'title_en' => 'Humanitarian HQ', 'description' => 'їжа та одяг', 'description_en' => 'food and clothing', 'link' => 'https://city-adm.lviv.ua/'],
            ['city' => 'Львів', 'category' => 'human', 'title' => 'Мальтійська служба', 'title_en' => 'Maltese Service', 'description' => 'польова кухня, набори', 'description_en' => 'field kitchen, kits', 'link' => 'https://malteser.ua/'],
            ['city' => 'Львів', 'category' => 'human', 'title' => 'Спільнота «Емаус-Оселя»', 'title_en' => 'Emmaus-Oselya', 'description' => 'притулок та речі', 'description_en' => 'shelter and items', 'link' => 'https://emaus-oselya.org/ua/'],
            ['city' => 'Львів', 'category' => 'psy', 'title' => 'Центр "Жіночі перспективи"', 'title_en' => 'Womens Perspectives', 'description' => 'допомога жінкам', 'description_en' => 'help for women', 'link' => 'http://women.lviv.ua/'],
            ['city' => 'Львів', 'category' => 'psy', 'title' => 'БПД Львів', 'title_en' => 'Legal Aid Lviv', 'description' => 'безоплатні юристи', 'description_en' => 'free lawyers', 'link' => 'https://legalaid.gov.ua/'],
            ['city' => 'Львів', 'category' => 'psy', 'title' => '«RAZOM з тобою»', 'title_en' => 'RAZOM With You', 'description' => 'безоплатні психологічна допомога', 'description_en' => 'free psychological help', 'link' => 'https://razomztoboyu.org/'],

            // ================= ХАРКІВ =================
            ['city' => 'Харків', 'category' => 'money', 'title' => 'ACTED', 'title_en' => 'ACTED', 'description' => 'Грошова допомога', 'description_en' => 'Financial aid', 'link' => 'https://www.acted.org/'],
            ['city' => 'Харків', 'category' => 'money', 'title' => 'ERC', 'title_en' => 'ERC', 'description' => 'Виплати постраждалим', 'description_en' => 'Victim payments', 'link' => 'https://register.pagulasabi.ee/uk/'],
            ['city' => 'Харків', 'category' => 'human', 'title' => 'БФ "Фавор"', 'title_en' => 'Favor Charity', 'description' => 'Гарячі обіди', 'description_en' => 'Hot lunches', 'link' => 'https://www.bf-favor.org/'],
            ['city' => 'Харків', 'category' => 'human', 'title' => 'БФ "Ренесанс"', 'title_en' => 'Renaissance Charity', 'description' => 'Продуктові набори', 'description_en' => 'Food kits', 'link' => 'https://renaissance.co.ua/'],
            ['city' => 'Харків', 'category' => 'psy', 'title' => 'БО “Відродження громад”', 'title_en' => 'Community Revival', 'description' => 'регіональна психологічна служба', 'description_en' => 'psychological service', 'link' => 'https://revivalfund.com.ua/'],
            ['city' => 'Харків', 'category' => 'psy', 'title' => 'Depaul', 'title_en' => 'Depaul', 'description' => 'Центр психологічної підтримки', 'description_en' => 'Psychological support', 'link' => 'https://depaul.org.ua/'],

            // ================= ДНІПРО =================
            ['city' => 'Дніпро', 'category' => 'money', 'title' => 'Карітас Донецьк (у Дніпрі)', 'title_en' => 'Caritas Donetsk', 'description' => 'виплати на оренду', 'description_en' => 'rent payments', 'link' => 'https://caritas.ua/'],
            ['city' => 'Дніпро', 'category' => 'money', 'title' => 'БФ "Помагаєм"', 'title_en' => 'Pomogaem Charity', 'description' => 'адресна фіндопомога', 'description_en' => 'financial assistance', 'link' => 'https://pomogaem.com.ua/'],
            ['city' => 'Дніпро', 'category' => 'human', 'title' => 'СпівДія Хаб', 'title_en' => 'SpivDiia Hub', 'description' => 'одяг та продукти', 'description_en' => 'clothing and food', 'link' => 'https://spivdiia.org.ua/'],
            ['city' => 'Дніпро', 'category' => 'human', 'title' => 'Шелтер "Добро"', 'title_en' => 'Shelter Dobro', 'description' => 'тимчасовий прихисток', 'description_en' => 'temporary shelter', 'link' => 'https://dobro.ua/'],
            ['city' => 'Дніпро', 'category' => 'psy', 'title' => 'Мартін-клуб', 'title_en' => 'Martin-club', 'description' => 'соціальна адаптація', 'description_en' => 'social adaptation', 'link' => 'https://martin-club.org/'],
            ['city' => 'Дніпро', 'category' => 'psy', 'title' => 'Центр Правової Допомоги', 'title_en' => 'Legal Aid Center', 'description' => 'безоплатна юридична допомога', 'description_en' => 'free legal aid', 'link' => 'https://urist24.com.ua/'],

            // ================= ОДЕСА =================
            ['city' => 'Одеса', 'category' => 'money', 'title' => 'Карітас Одеса', 'title_en' => 'Caritas Odesa', 'description' => 'екстрені гранти', 'description_en' => 'emergency grants', 'link' => 'https://www.caritas.od.ua/'],
            ['city' => 'Одеса', 'category' => 'money', 'title' => 'Solidarites', 'title_en' => 'Solidarites', 'description' => 'реєстрація на кеш', 'description_en' => 'cash aid', 'link' => 'https://www.solidarites.org/'],
            ['city' => 'Одеса', 'category' => 'human', 'title' => 'Корпорація Монстрів', 'title_en' => 'Monsters Corp', 'description' => 'ліки та продукти', 'description_en' => 'medicine and food', 'link' => 'https://monstrov.org/'],
            ['city' => 'Одеса', 'category' => 'human', 'title' => 'Гостина Хата', 'title_en' => 'Hostinna Khata', 'description' => 'гуманітарний центр', 'description_en' => 'humanitarian center', 'link' => 'https://www.hostinnakhata.org/'],
            ['city' => 'Одеса', 'category' => 'human', 'title' => 'Одеса-Хаб', 'title_en' => 'Odesa-Hub', 'description' => 'допомога ВПО', 'description_en' => 'IDP assistance', 'link' => 'https://omr.gov.ua/'],
            ['city' => 'Одеса', 'category' => 'psy', 'title' => 'Way Home', 'title_en' => 'Way Home', 'description' => 'фонд "Шлях додому"', 'description_en' => 'Way Home Foundation', 'link' => 'https://wayhome.org.ua/'],
            ['city' => 'Одеса', 'category' => 'psy', 'title' => 'Центр Правової Допомоги', 'title_en' => 'Legal Aid Center', 'description' => 'безоплатна юридична допомога', 'description_en' => 'free legal aid', 'link' => 'https://urist24.com.ua/'],

            // ================= ЗАПОРІЖЖЯ =================
            ['city' => 'Запоріжжя', 'category' => 'money', 'title' => 'Посмішка ЮА', 'title_en' => 'Posmishka UA', 'description' => 'фінансова підтримка', 'description_en' => 'financial support', 'link' => 'https://posmishka.org.ua/'],
            ['city' => 'Запоріжжя', 'category' => 'money', 'title' => 'Save the Children', 'title_en' => 'Save the Children', 'description' => 'виплати сім\'ям', 'description_en' => 'family payments', 'link' => 'https://www.savethechildren.net/'],
            ['city' => 'Запоріжжя', 'category' => 'human', 'title' => 'Карітас Запоріжжя', 'title_en' => 'Caritas Zaporizhzhia', 'description' => 'продуктові набори', 'description_en' => 'food packages', 'link' => 'https://zp.caritas.ua/'],
            ['city' => 'Запоріжжя', 'category' => 'human', 'title' => 'Белуга', 'title_en' => 'Beluga', 'description' => 'безкоштовна їжа', 'description_en' => 'free food', 'link' => 'https://www.instagram.com/uabeluga/'],
            ['city' => 'Запоріжжя', 'category' => 'psy', 'title' => 'Опліч ХАБ', 'title_en' => 'Oplich HUB', 'description' => 'простір підтримки', 'description_en' => 'support space', 'link' => 'https://globalcompact.org.ua/'],
            ['city' => 'Запоріжжя', 'category' => 'psy', 'title' => 'КЗ Обласний центр', 'title_en' => 'Regional Center', 'description' => 'безоплатна психологічна підтримка', 'description_en' => 'free psychological support', 'link' => 'https://kriziscentr.net/'],

            // ================= ВІННИЦЯ =================
            ['city' => 'Вінниця', 'category' => 'money', 'title' => 'Карітас Вінниця', 'title_en' => 'Caritas Vinnytsia', 'description' => 'грошова допомога', 'description_en' => 'cash aid', 'link' => 'https://caritas-spes.org/'],
            ['city' => 'Вінниця', 'category' => 'money', 'title' => 'УВКБ ООН', 'title_en' => 'UNHCR', 'description' => 'грошова допомога', 'description_en' => 'cash aid', 'link' => 'https://t.me/s/unhcr_help_vinnitsia'],
            ['city' => 'Вінниця', 'category' => 'human', 'title' => 'Подільська громада', 'title_en' => 'Podilska Hromada', 'description' => 'гуманітарний хаб', 'description_en' => 'humanitarian hub', 'link' => 'https://gromada.vn.ua/'],
            ['city' => 'Вінниця', 'category' => 'human', 'title' => 'Волонтерський центр «Шахіна»', 'title_en' => 'Shakhina Center', 'description' => 'одяг та речі', 'description_en' => 'clothing and items', 'link' => 'https://podolianchuk.com/'],
            ['city' => 'Вінниця', 'category' => 'psy', 'title' => 'Джерело надії', 'title_en' => 'Spring of Hope', 'description' => 'психологічна служба', 'description_en' => 'psychological service', 'link' => 'https://springofhope.org.ua/'],
            ['city' => 'Вінниця', 'category' => 'psy', 'title' => 'Центр Правової Допомоги', 'title_en' => 'Legal Aid Center', 'description' => 'безоплатна юридична допомога', 'description_en' => 'free legal aid', 'link' => 'https://urist24.com.ua/'],

            // ================= ІВАНО-ФРАНКІВСЬК =================
            ['city' => 'Івано-Франківськ', 'category' => 'money', 'title' => 'Карітас ІФ', 'title_en' => 'Caritas IF', 'description' => 'гранти на оренду', 'description_en' => 'rent grants', 'link' => 'https://caritas.if.ua/'],
            ['city' => 'Івано-Франківськ', 'category' => 'money', 'title' => 'Офіційний сайт міста', 'title_en' => 'Official City Site', 'description' => 'Соціальна допомога', 'description_en' => 'social aid', 'link' => 'https://www.mvk.if.ua/'],
            ['city' => 'Івано-Франківськ', 'category' => 'human', 'title' => 'СпівДія ІФ', 'title_en' => 'SpivDiia IF', 'description' => 'гуманітарна допомога', 'description_en' => 'humanitarian aid', 'link' => 'https://spivdiia.org.ua/'],
            ['city' => 'Івано-Франківськ', 'category' => 'human', 'title' => 'Мальтійська служба', 'title_en' => 'Maltese Service', 'description' => 'їжа та гігієна', 'description_en' => 'food and hygiene', 'link' => 'https://omro.if.ua/'],
            ['city' => 'Івано-Франківськ', 'category' => 'psy', 'title' => 'Дім Воїна', 'title_en' => 'Warrior House', 'description' => 'допомога ветеранам', 'description_en' => 'help for veterans', 'link' => 'https://www.instagram.com/dim.voina/'],
            ['city' => 'Івано-Франківськ', 'category' => 'psy', 'title' => 'БПД', 'title_en' => 'Legal Aid', 'description' => 'юридична допомога', 'description_en' => 'legal aid', 'link' => 'https://legalaid.gov.ua/'],
            ['city' => 'Івано-Франківськ', 'category' => 'psy', 'title' => '«RAZOM з тобою»', 'title_en' => 'RAZOM With You', 'description' => 'безоплатні психологічна допомога', 'description_en' => 'free psychological help', 'link' => 'https://razomztoboyu.org/'],
        ];

        foreach ($helps as $item) {
            Help::create($item);
        }
    }
}