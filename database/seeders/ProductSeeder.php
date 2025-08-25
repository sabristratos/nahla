<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name_ar' => 'كريم Hydra Plus',
                'description_ar' => 'كريم للبشرة العادية إلى الجافة. يحتوي على زيت السمسم، فيتامين E، سيلينيوم، ليسيثين، ماء الورد.',
                'ingredients_ar' => 'زيت السمسم، فيتامين E، سيلينيوم، ليسيثين، ماء الورد',
                'usage_ar' => 'توضع كمية صغيرة على وجه نظيف صباحًا ومساءً',
                'benefits_ar' => 'ترطيب وتغذية البشرة العادية إلى الجافة. 0% سيليكون، بارابين، وسلفات. منتج طبيعي 100%',
                'price' => 25.00,
                'size' => '100 مل',
                'image_path' => 'products/creme-hydra-plus.png',
                'additional_images' => [
                    '/nahla-images/Étiquette/Créme Hydra plus/Design 1.png',
                    '/nahla-images/Étiquette/Créme Hydra plus/mockup  (2).png'
                ],
                'sort_order' => 1,
            ],
            [
                'name_ar' => 'Spray pour Champignons de la Peau',
                'description_ar' => 'منتج طبيعي بدون مواد حافظة يعالج الفطريات بين أصابع القدمين، اليدين، أو على الجلد.',
                'ingredients_ar' => 'ماء، حمض الخليك، مستخلص العنب، زيت المستكة، زيت السمسم، زيت حبة البركة',
                'usage_ar' => 'يُرج جيداً قبل الاستخدام ويوضع على الجلد ليلاً. لا يُشطف',
                'benefits_ar' => 'يعالج الفطريات طبيعياً. يحتوي على مركبات طبيعية قد تسبب حساسية لدى بعض الأشخاص',
                'price' => 20.00,
                'size' => '100 مل',
                'image_path' => 'products/spray-naturel.jpg',
                'additional_images' => [
                    '/nahla-images/Étiquette/Spray naturel/Spray-naturel.jpg'
                ],
                'sort_order' => 2,
            ],
            [
                'name_ar' => 'كريم مزيل العرق',
                'description_ar' => 'يزيل الروائح، يمتص العرق، ويوفر حماية طويلة الأمد بتركيبة من مكونات طبيعية وزيوت نقية. رائحة ورد مسكي.',
                'ingredients_ar' => 'ماء، مستحلب طبيعي، زبدة الشيا، زيت جوز الهند، نشا الذرة، زيت الورد، بيكربونات الصوديوم، مادة حافظة طبيعية',
                'usage_ar' => 'يوضع على إبط نظيف وجاف مع تدليك لطيف',
                'benefits_ar' => 'حماية طويلة الأمد. 0% سيليكون، بارابين، وسلفات. منتج طبيعي 100%',
                'price' => 15.00,
                'size' => '50 جرام',
                'image_path' => 'products/creme-deodorant.jpg',
                'additional_images' => [
                    '/nahla-images/Étiquette/Crème déodorant/Design 1.png'
                ],
                'sort_order' => 3,
            ],
            [
                'name_ar' => 'جل مضاد للألم',
                'description_ar' => 'يُستخدم لآلام المفاصل والآلام الالتهابية والعضلية. يوفر تأثيرًا باردًا لتهدئة آلام العضلات بسرعة.',
                'ingredients_ar' => 'ماء النعناع المقطر، ماء القرنفل المقطر، زيت النعناع الأساسي، زيت القرنفل الأساسي، مينثول، كحول، زيت إكليل الجبل الأساسي، مادة هلامية طبيعية، مادة حافظة عضوية',
                'usage_ar' => 'يوضع فقط على المنطقة المصابة. توضع كمية صغيرة مرتين يوميًا مع التدليك. يجب غسل اليدين بعد الاستخدام',
                'benefits_ar' => 'تأثير بارد سريع لتهدئة الألم. قوام غير دهني وغير لزج. للاستخدام الخارجي فقط',
                'price' => 30.00,
                'size' => '200 مل',
                'image_path' => 'products/gel-anti-douleurs.jpg',
                'additional_images' => [
                    '/nahla-images/Étiquette/Gel anti douleurs/Gel-anti-douleurs.jpg'
                ],
                'sort_order' => 4,
            ],
            [
                'name_ar' => 'خل التفاح',
                'description_ar' => 'خل تفاح طبيعي 100% غير مبستر. تكوّن الرواسب ظاهرة طبيعية.',
                'ingredients_ar' => 'خل تفاح طبيعي 100% غير مبستر',
                'usage_ar' => 'يُحفظ بعيدًا عن الضوء والحرارة',
                'benefits_ar' => 'منتج طبيعي 100% ومصنوع في تونس',
                'price' => 12.00,
                'size' => '500 مل',
                'image_path' => 'products/vinaigre-cidre.jpg',
                'additional_images' => [],
                'sort_order' => 5,
            ],
            [
                'name_ar' => 'زبدة المانجو',
                'description_ar' => 'زبدة مانجو طبيعية مع زيت السمسم وفيتامين E لتغذية البشرة.',
                'ingredients_ar' => 'زبدة المانجو، زيت السمسم، فيتامين E، سيلينيوم، ليسيثين، ماء الورد',
                'usage_ar' => 'توضع كمية صغيرة على وجه نظيف صباحًا ومساءً',
                'benefits_ar' => '0% سيليكون، بارابين، وسلفات. منتج طبيعي 100%',
                'price' => 18.00,
                'size' => '50 جرام',
                'image_path' => 'products/beurre-mangue.jpg',
                'additional_images' => [
                    '/nahla-images/Étiquette/Beurre de mangue/Design 1.png'
                ],
                'sort_order' => 6,
            ],
            [
                'name_ar' => 'زبدة الشيا الخام',
                'description_ar' => 'زبدة شيا نقية وطبيعية 100%. غنية بفيتامينات A, D, E, F. ترطب وتغذي البشرة والشعر وتحمي من العوامل الخارجية.',
                'ingredients_ar' => 'زبدة شيا نقية 100%',
                'usage_ar' => 'للوجه والجسم: تُدفأ بين اليدين وتوضع على المناطق الجافة. للشعر: كقناع قبل الشامبو أو تضاف لمستحضرات العناية',
                'benefits_ar' => 'غنية بالفيتامينات. تحمي من العوامل الخارجية. مفيدة لتشققات الحمل. 0% سيليكون، بارابين، وسلفات',
                'price' => 22.00,
                'size' => '150 جرام',
                'image_path' => 'products/beurre-karite.png',
                'additional_images' => [
                    '/nahla-images/Étiquette/Beurre de Kartité/Design 1.png',
                    '/nahla-images/Étiquette/Beurre de Kartité/mockup  (2).png'
                ],
                'sort_order' => 7,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
