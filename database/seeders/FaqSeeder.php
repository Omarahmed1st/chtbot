<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        // Inserting sample FAQ data in Arabic
        Faq::create([
            'question' => 'كيف يمكنني تثبيت Laravel؟',
            'answer' => 'يمكنك تثبيت Laravel عن طريق تشغيل الأمر التالي: composer create-project --prefer-dist laravel/laravel اسم_مشروعك',
        ]);

        Faq::create([
            'question' => 'ما هو Laravel؟',
            'answer' => 'Laravel هو إطار عمل PHP لبناء تطبيقات الويب باستخدام نمط العمارة MVC (نموذج-عرض-تحكم).',
        ]);

        Faq::create([
            'question' => 'كيف يمكنني استخدام Laravel مع قاعدة بيانات؟',
            'answer' => 'لاستخدام Laravel مع قاعدة بيانات، قم بتكوين ملف `.env` باستخدام بيانات اعتماد قاعدة البيانات ثم قم بتشغيل الهجرات عبر الأمر: php artisan migrate.',
        ]);

        Faq::create([
            'question' => 'ما هي الهجرات في Laravel؟',
            'answer' => 'الهجرات هي وسيلة لإصدار نسخ للتحكم في بنية قاعدة البيانات في Laravel. يمكنك إنشاء وتحديث وتعديل جداول قاعدة البيانات باستخدام ملفات الهجرة.',
        ]);
    }
}

