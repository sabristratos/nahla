<?php

namespace Database\Seeders;

use App\Models\Review;
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
                'customer_name' => 'Lovely lmt',
                'review_text_ar' => 'شريت منكم شهادة حق والله نفعني وخام باللحق وربي يباركلكم وحتى البنية الى تخدم معاكم',
                'rating' => 5,
                'location' => '',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'customer_name' => 'mariam8',
                'review_text_ar' => 'شهادة من الدين و طالبة الشفاء تعاملت معكم قداه من مرة زيت الخروع ذات جودة عالية و نافع الحمد لله. الله يرحم والديكم',
                'rating' => 5,
                'location' => '',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'customer_name' => 'Mizouri Naziha',
                'review_text_ar' => 'ربي يباركلكم بالحق أخلاق عالية وخدمة بسم الله ماشاء الله ربي يباركلكم ثقة',
                'rating' => 5,
                'location' => '',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'customer_name' => 'jalilaaissani',
                'review_text_ar' => 'انا خذيت ونصحت بيه برشا ناس وحتى من بلدان اخرى وعطيتهم رقمكم ونحب نعدي كومند مرة أخرى اختي نهلة افرحك واباركلك في صحتك لو ممكن طبعاً',
                'rating' => 5,
                'location' => '',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($reviews as $reviewData) {
            Review::create($reviewData);
        }
    }
}
