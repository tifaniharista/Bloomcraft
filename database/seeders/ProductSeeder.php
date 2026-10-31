<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
class ProductSeeder extends Seeder {
    public function run(): void {
        $buket=Category::where('slug','buket-bunga')->firstOrFail();
        $bunga=Category::where('slug','bunga-segar')->firstOrFail();
        $hadiah=Category::where('slug','hadiah')->firstOrFail();
        foreach ([
            ['name'=>'Buket Mawar Pink','slug'=>'buket-mawar-pink','category_id'=>$buket->id,'description'=>'Buket mawar pink untuk menyampaikan perhatian dan kasih sayang.','price'=>250000,'stock'=>10],
            ['name'=>'Buket Baby Breath','slug'=>'buket-baby-breath','category_id'=>$buket->id,'description'=>'Buket baby breath dengan tampilan lembut dan elegan.','price'=>180000,'stock'=>12],
            ['name'=>'Bunga Lily Segar','slug'=>'bunga-lily-segar','category_id'=>$bunga->id,'description'=>'Bunga lily segar untuk mempercantik ruangan dan momen spesial.','price'=>220000,'stock'=>8],
            ['name'=>'Gift Box Bloomcraft','slug'=>'gift-box-bloomcraft','category_id'=>$hadiah->id,'description'=>'Gift box sederhana untuk melengkapi hadiah spesial.','price'=>150000,'stock'=>15],
        ] as $product) Product::updateOrCreate(['slug'=>$product['slug']],$product+['sale_price'=>null,'status'=>'active','image'=>[]]);
    }
}
