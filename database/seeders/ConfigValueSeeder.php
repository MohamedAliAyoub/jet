<?php

namespace Database\Seeders;

use App\Models\ConfigValues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigValues::query()->firstOrCreate([
            'name' => 'terms',
            'value' => [
                'en' => 'Terms & Conditions
This website presents the terms and conditions under which we provide our services to our customers on the Internet. If you use the site after reading this
If you have any questions about the terms and conditions or anything about this website, please contact us at the address provided above or by email info@privatejet.com
 Rehlat Responsibilities',
                'ar' => 'الشروط والأحكام
يعرض هذا الموقع الشروط والأحكام التي بموجبها نقدم خدماتنا لعملائنا على شبكة الإنترنت. فإذا استخدمت الموقع بعد قراءة هذه الصفحة، فأنت بذلك توافق على الالتزام بالشروط والأحكام المفصلة أدناه. وإذا كنت لا توافق عليها، يجب عليك عدم استخدام الموقع لحجز تذاكر رحلات الطيران أو تأكيد حجز الفنادق.
بالاستمرار في استخدام هذا الموقع، فأنت تؤكد أنك كبير بما يكفي لإبرام العقود القانونية والالتزام بها، ومُدرك أنك سوف تكون مسؤولًا عن جميع المبالغ التي تلتزم بدفعها عند الحجز على الموقع.
يُشير مصطلح "رحلات"أو "لنا" أو "نحن" أو "لدينا"أو "معنا" إلى صاحب الموقع. كما يُشير مصطلح "أنت" إلى المستخدم أو المتصفح لموقعنا على الانترنت.
إذا كان لديك أي أسئلة حول الشروط والأحكام أو أي شيءٍ عن هذا الموقع، يرجى التواصل معنا على العنوان المذكور أعلاه أو عن طريق البريد الإلكتروني info@privatejet.com
مسؤوليات موقع "رحلات"',
            ],
        ]);

        ConfigValues::query()->firstOrCreate([
            'name' => 'conditions',
            'value' => [
                'en' => 'Privacy and Data Protection:',
                'ar' => 'الخصوصية وحماية البيانات:',
            ],
        ]);
    }
}
