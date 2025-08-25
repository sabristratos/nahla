<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'customer_name' => 'فاطمة محمد',
                'review_text_ar' => 'منتجات رائعة وطبيعية 100%. استخدمت كريم Hydra Plus وأصبحت بشرتي أكثر نعومة ونضارة. أنصح به بشدة!',
                'rating' => 5,
                'location' => 'تونس العاصمة',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'customer_name' => 'أحمد بن علي',
                'review_text_ar' => 'جل مضاد للألم ممتاز! ساعدني كثيراً في علاج آلام الظهر. التأثير سريع والرائحة منعشة.',
                'rating' => 5,
                'location' => 'صفاقس',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'customer_name' => 'زينب الهادي',
                'review_text_ar' => 'زبدة الشيا الخام مفيدة جداً للبشرة الجافة. استخدمتها أثناء الحمل ومنعت ظهور التشققات.',
                'rating' => 5,
                'location' => 'سوسة',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'customer_name' => 'محمد الجندي',
                'review_text_ar' => 'خل التفاح طبيعي ونقي. طعمه ممتاز واستخدمه للصحة العامة. جودة ممتازة.',
                'rating' => 4,
                'location' => 'المنستير',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'customer_name' => 'نورا السالم',
                'review_text_ar' => 'كريم مزيل العرق طبيعي وفعال. رائحته جميلة وحماية تدوم طوال اليوم. سعيدة بالنتيجة.',
                'rating' => 5,
                'location' => 'قابس',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'customer_name' => 'عبد الرحمن منصور',
                'review_text_ar' => 'بخاخ الفطريات ساعدني في علاج فطريات القدم بشكل طبيعي. النتائج ظهرت خلال أسبوع.',
                'rating' => 4,
                'location' => 'بنزرت',
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($reviews as $reviewData) {
            Review::create($reviewData);
        }
    }
}
