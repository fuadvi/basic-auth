<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Faker::create('id_ID');
        $categoris = ['pakaian', 'gadget', 'digital'];
        $title = [
            'pakaian' => [
                'material' => ['kaos', 'kemeja', 'celana', 'jas'],
                'jenis' => ['besar', 'kecil', 'anak', 'laki-laki', 'perempuan'],
                'warna' => ['puthi', 'merah', 'hijau', 'biru', 'kuning'],
            ],
            'gadget' => [
                'material' => ['HP', 'table', 'leptop'],
                'jenis' => ['asus', 'xiomi', 'acer'],
                'warna' => ['silver', 'gold', 'hitam'],
            ],
            'digital' => [
                'material' => ['pulsa', 'kouta', 'perdana'],
                'jenis' => ['teklomsel', 'xl', 'tri'],
                'warna' => ['100', '50', '10'],
            ]
        ];

        for ($i = 0; $i < 100; $i++) {
            $categori = $fake->randomElement($categoris);
            $titleStr = $fake->randomElement($title[$categori]['material']);
            $titleStr .= ' ' . $fake->randomElement($title[$categori]['jenis']);
            $titleStr .= ' ' . $fake->randomElement($title[$categori]['warna']);

            $data[] = [
                'category' => $categori,
                'title' => $titleStr,
                'price' => $fake->numberBetween(1, 100) * 1000,
                'descriptions' => $fake->text(),
                'stock' => $fake->numberBetween(1, 200),
                'free_shipping' => $fake->numberBetween(0, 1),
                'rate' => $fake->randomFloat(2, 1, 5),
            ];
        }
        (new Product())->insert($data);
    }
}
