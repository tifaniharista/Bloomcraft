<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;
class CategorySeeder extends Seeder {
    public function run(): void {
        foreach ([
            ['name'=>'Buket Bunga','slug'=>'buket-bunga','description'=>'Rangkaian buket untuk momen spesial.'],
            ['name'=>'Bunga Segar','slug'=>'bunga-segar','description'=>'Pilihan bunga segar pilihan.'],
            ['name'=>'Hadiah','slug'=>'hadiah','description'=>'Hadiah dan pelengkap untuk orang tersayang.'],
            ['name'=>'Dekorasi','slug'=>'dekorasi','description'=>'Dekorasi bunga dan ruangan.'],
        ] as $category) Category::updateOrCreate(['slug'=>$category['slug']],$category);
    }
}
